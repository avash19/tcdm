<?php

namespace App\Http\Controllers;

use App\Models\OfficeHour;
use Illuminate\Http\Request;

class OfficeHourController extends Controller
{
  // TO DISPLAY OFFICE HOUR IN DISPALY PAGE
  public function index(){
    $officeHours=OfficeHour::all();
    return view('admin.officehour.display',compact(['officeHours']));
  }

  //TO RETURN OFFICE HOUR CREATE PAGE
  public function create(){
    return view('admin.officehour.add');
  }

  // TO STORE NEWELY CREATED OFFICE HOUR
  public function store(Request $request){
    $this->validate($request,[
      'startTime'=>'date_format:H:i|required',
      'endTime'=>'required|date_format:H:i',
    ]);
    $checkOfficeHour=OfficeHour::count();
    $officeTimeData=$request->only('startTime','endTime');
    OfficeHour::create($officeTimeData);
    return redirect('officehours')->with('msg','Office Time Created Successfully');
  }

  // TO RETURN EDIT OFFICE HOUR PAGE ACCORDING TO OFFICEHOURID
  public function edit(OfficeHour $officehour){
    $officeHour=$officehour;
    return view('admin.officehour.edit',compact(['officeHour']));
  }

  // TO UPDATE THE OFFICE HOUR DATA
  public function update(Request $request, OfficeHour $officehour){
    $this->validate($request,[
      'startTime'=>'required',
      'endTime'=>'required',
    ]);

    $officeTimeData=$request->only('startDate','endDate','startTime','endTime');

    $officehour->update($officeTimeData);
    return redirect('officehours')->with('msg','Office Time updated Successfully');
  }

  // TO DELETE THE OFFICE HOUR DATA
  public function destroy(OfficeHour $officeHour){
      //
  }
}
