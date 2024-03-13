<?php

namespace App\Http\Controllers;

use App\Models\ClientCustomer;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientCustomerController extends Controller
{
    // TO RETURN CLIENT-CUSTOMER DISPLAY PAGE WITH LIST OF CLIENT-CUSTOMER
  public function index(){
    // $customers=ClientCustomer::all();
    // return view('admin.customer.display',compact(['customers']));
  }

  // TO RETURN CLIENT-CUSTOMER ADD PAGE 
  public function create(Client $client){
    return view('admin.customer.add',compact('client'));
  }

  // TO STORE NEWLY CREATED CLIENT-CUSTOMER 
  public function store(Request $request){
    $this->validate($request,[
      'email'=>"unique:client_customers|required",
      'phoneNumber'=>"min:10|unique:client_customers|required",
      'address'=>'min:3|required',
      'name'=>'min:3|required',
      'clientId'=>'required',
    ]);
    $newData = $request->only('email','phoneNumber','address','name','clientId');
    ClientCustomer::create($newData);
    return redirect('clients/'.$request->get('clientId'))->with('msg','New Customer Added Successfully');
  }

  // RETURN ONE CLIENT-CUSTOMER FOR EDIT
  public function edit(ClientCustomer $customer){
    return view('admin.customer.edit',compact(['customer']));
  }

  // TO UPDATE THE CLIENT-CUSTOMER DATA
  public function update(Request $request,ClientCustomer $customer){
    $this->validate($request,[
      'email'=>"unique:client_customers,email,$customer->id",
      'phoneNumber'=>"min:10|unique:client_customers,phoneNumber,$customer->id",
      'address'=>'min:3',
      'name'=>'min:3',
    ]);

    $updateData = $request->only('email','phoneNumber','address','name');
    ClientCustomer::where('id',$customer->id)->update($updateData);
    return redirect('clients/'.$customer->clientId)->with('msg',"Client Customer's Data Updated Successfully");
  }

  // DELETE ONE CLIENT-CUSTOMER
  public function destroy(ClientCustomer $customer){
    $customer->delete();
    return redirect('clients/'.$customer->clientId)->with('msg','Customer deleted successully');
  }
}
