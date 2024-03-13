<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
	// TO DISPLAY CLIENT LISTS
	public function index(){
		$clients=Client::all();
		return view('admin.client.display',compact('clients'));
	}

	// TO RETURN CREATE PAGE 
	public function create(){
		return view('admin.client.add');
	}

	// TO STORE CREATE PAGE 
  public function store(Request $request){
    $validatedData =$request->validate([
      'name'=>'required',
		]);
		$clientData=$request->only('email','name','facebookPageLink');

		Client::create($clientData);

		return redirect('clients')->with('msg',"Client Created Sucessfully");
  }
 
	// TO GET ONE CLIENT BY ID 
	public function show(Client $client){
		$customers=$client->customers;
		$events=$client->events;
		return view('admin.client.show',compact('client','customers','events'));
	}

	// TO GET ONE CLIENT BY ID TO EDIT
  public function edit(Client $client){
		return view('admin.client.edit',compact('client'));
  }

	// TO UPDATE ONE CLIENT BY ID TO EDIT
	public function update(Request $request, Client $client){
		$this->validate($request,[
      'name'=>'required',
		]);

		$updateData=$request->only('email','name','status','facebookPageLink');
		Client::where('id',$client->id)->update($updateData);
		$client=Client::find($client->id);
		$client->events()->update(['name'=>$client->name]);
		return redirect('/clients')->with('msg','Client updated successfully');
	}

	// TO DELTE ONE CLIENT BY ID
	public function destroy(Client $client)	{
		$client->delete();
		return redirect('/clients')->with('msg','Client Removed Successfully :)');
	}

	// TO GET CSV FILE FOR EACH CUSTOMER
	public function getCsv(Client $client){
		$events=$client->events;
		$customers=$client->customers;
		
		$fileName='assets/client-data/'.$client->name.date('Y-m-d').'.csv';

		$headers = array(
			"Content-type"        => "text/csv",
			"Content-Disposition" => "attachment; filename=$fileName",
			"Pragma"              => "no-cache",
			"Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
			"Expires"             => "0"
		);
		$fp=fopen($fileName,'w');

		$columns = array('Client Id', 'Client Name', 'Email', 'Address', 'Phone Number');

		fputcsv($fp, $columns);
		$row['Client Id']  = $client->id;
		$row['Client Name']    = $client->name;
		$row['Email']    = $client->email;
		$row['Address']  = $client->address;
		$row['Phone Number']  = $client->phoneNumber;

		fputcsv($fp, array($row['Client Id'], $row['Client Name'], $row['Email'], $row['Address'], $row['Phone Number']));
		fputcsv($fp, array("", "", "", "", ""));
		fputcsv($fp, array("", "", "", "", ""));
		
		if(count($events)>0){
			fputcsv($fp, array('Event Id', 'Event Name', 'Start Date', 'End Date','Message Handler','Comment Handler','Calendar SpreadSheet Handler','Followup Handler'));
			foreach($events as $event){

				$row['Event Id']  = $event->id;
				$row['Event Name']    = $event->name;
				$row['Start Date']  = $event->startDate;
				$row['End Date']  = $event->endDate;
				$row['Message Handler']  = $event->userMessage?$event->userMessage->name:'N/A';
				$row['Comment Handler']  = $event->userComment?$event->userComment->name:'N/A';
				$row['Calendar SpreadSheet Handler']  = $event->userCalendarSpread?$event->userCalendarSpread->name:'N/A';
				$row['Followup Handler']  = $event->userFollowUp?$event->userFollowUp->name:'N/A';
				fputcsv($fp, array($row['Event Id'], $row['Event Name'], $row['Start Date'], $row['End Date'],$row['Message Handler'],$row['Comment Handler'],$row['Calendar SpreadSheet Handler'],$row['Followup Handler']));
			}
			fputcsv($fp, array("", "", "", "", ""));
			fputcsv($fp, array("", "", "", "", ""));
		}

		if(count($customers)>0){
			fputcsv($fp, array('Customer Id', 'Customer Name', 'Email', 'Address', 'Phone Number'));
			foreach($customers as $customer){
				$row['Customer Id']  = $customer->id;
				$row['Customer Name']    = $customer->name;
				$row['Email']    = $customer->email;
				$row['address']  = $customer->address;
				$row['Phone Number']  = $customer->phoneNumber;
				fputcsv($fp, array($row['Customer Id'], $row['Customer Name'], $row['Email'], $row['address'], $row['Phone Number']));
			}
		}
		fclose($fp);
		return response()->download(($fileName));
	}
}
