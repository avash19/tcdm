<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HelperController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;

class AdminController extends Controller
{
  // TO RETURN EMPLOYEE DISPLAY PAGE WITH LIST OF EMPLOYEE
  public function index(){
    $employees=User::where('role','employee')->get();
    return view('admin.employee.display',compact(['employees']));
  }

  // TO GET TOTAL ACTIVE EMPLOYEE+ EMPLOYEE IN BRREAK
  public function activeBreakEmployee($by){
    // date_default_timezone_set('America/New_York');
    date_default_timezone_set('Asia/Kathmandu');
    $activeEmployees=$breakEmployees=[];
    $title='';
    if($by!=='active' && $by!=='break')
      abort(404);
    $todayAttendances=HelperController::getTodayAttendanceForAdmin();
    if($todayAttendances && count($todayAttendances)>0){
      foreach($todayAttendances as $attendance){
        if($by=='active'){
          $employee=$attendance->user;
          if($employee->status=='active')
              array_push($activeEmployees,$attendance);
        }
        else{
          if($attendance->breakStart && !$attendance->breakEnd)
            array_push($breakEmployees,$attendance);
        }
      }
    }
    if($by=='active')
      $title='Active Employee Details';
    else
      $title='Break Employee Details';
    return view('admin.employee.detail',compact(['title','activeEmployees','breakEmployees']));
  }

  // TO RETURN EMPLOYEE ADD PAGE 
  public function create(){
    return view('admin.employee.add');
  }

  // TO STORE NEWLY CREATED USER/EMPLOYEE 
  public function store(Request $request){
    $this->validate($request,[
      'email'=>"unique:users|required",
      'password'=>'min:4|required',
      'name'=>'min:3|required',
      'role'=>'min:4|required',
    ]);
    $newData = $request->only('email', 'password','phoneNumber','name','role','offDay','payDay','startTime','endTime');
    $newData['password']=bcrypt($newData['password']);
    User::create($newData);
    return redirect('admin/employee')->with('msg','Employee Added Successfully');
  }

  // RETURN ONE EMPLOYEE FOR EDIT
  public function edit(User $employee){
    if($employee->role=='employee'){
      return view('admin.employee.edit',compact(['employee']));
    }
    else
    return redirect('admin/employee')->with('msg','You Cannot Edit Admin Data');;
  }

  // TO UPDATE THE EMPLOYEE DATA
  public function update(Request $request,User $employee){
    $this->validate($request,[
      'email'=>"unique:users,email,$employee->id",
      'phoneNumber'=>"unique:users,phoneNumber,$employee->id",
      'name'=>'min:3',
    ]);
    $updateData = $request->only('email','phoneNumber','password','name','role','offDay','payDay','startTime','endTime');
    if(!$updateData['password']){
      $updateData['password']=$employee->password;
    }else{
      if(strlen($updateData['password'])<=4)
        return redirect('admin/employee')->with('msg','Password must be of length 4 or more');
      $updateData['password']=bcrypt($updateData['password']);
    }

    User::where('id',$employee->id)->update($updateData);
    return redirect('admin/employee')->with('msg','Employee Data Updated Successfully');;
  }

  // DELETE ONE EMPLOYEE
  public function destroy(User $employee){
    $employee->delete();
    return redirect('admin/employee')->with('msg','Employee deleted successully');
  }
  
  // TO GET TOTAL ATTENDANCE
  public function show(){
    $users=User::where('role','employee')->get();
    $attendances=Attendance::all();
    return view('admin.employee.attendance',compact(['attendances','users']));
  }

  // TO GET TOTAL ATTENDANCE OF ONE EMPLOYEE
  public function showOne(User $employee){
    $attendances=Attendance::where('userId',$employee->id)->get();
    return view('admin.employee.attendance',compact(['attendances','employee']));
  }
}