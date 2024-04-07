<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HelperController;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Auth;
use DateTime;

class AttendanceController extends Controller
{
  // TO GET ATTENDACNE RECORD
	public function index(){
		if(Auth::user()->role=='employee'){
			$todayAttendance=[];
			$todayAttendance=HelperController::getTodayAttendance();
			$attendances=Attendance::where('userId',Auth::user()->id)->get();
			return view('employee.attendance',compact(['attendances','todayAttendance']));
		}
		else
			return abort(401);
	}

	// TO ADD NEW ATTENDANCE
	public function store(Request $request){
		if(Auth::user()->role=='employee'){
			// date_default_timezone_set('America/New_York');
			date_default_timezone_set('Asia/Kathmandu');
			$this->validate($request,[
				'attendanceValue'=>'required'
			]);
			$i=$request->get('attendanceValue');
			// TO GET LOGIN USER DATA
			$user=User::find(auth()->user()->id);
			$userTime=HelperController::getUserStartEndTime();
			$startTime=$userTime['startTime'];
			$endTime=$userTime['endTime'];
			$oneHourFast=$userTime['oneHourFast'];
			$oneHourBack=$userTime['oneHourBack'];
			$currentTime=$userTime['currentTime'];
			
			if(($currentTime>$oneHourBack ||  $currentTime>$startTime) && $currentTime<$oneHourFast){
				//$i=1(checkIn) $i=2(breakStart) $i=3(breakEnds) $i=4(checkout)
				$todayAttendance=HelperController::getTodayAttendance();
				if($todayAttendance){
					if($i==1)
						return redirect('attendances')->with('msg','Already Checked In');
					elseif($i==2){
						if($todayAttendance->checkIn){
							$user->status='inactive';
							AttendanceController::resettingAssignTask();
							$todayAttendance['breakStart']=date('Y-m-d H:i:s');
						}
						else
							return redirect('attendances')->with('msg','Check In Required');
					}
					elseif($i==3){
						if($todayAttendance->checkIn){
								if($todayAttendance->breakStart){
									$user->status='active';
									$todayAttendance['breakEnd']=date('Y-m-d H:i:s');
								}					
								else
									return redirect('attendances')->with('msg','Break Must Start To End');
						}
						else
							return redirect('attendances')->with('msg','Check In Required');
					}
					else{
						if($todayAttendance->checkIn){
							$user->status='inactive';
							AttendanceController::resettingAssignTask();
							$todayAttendance['checkOut']=date('Y-m-d H:i:s');
						}
						else
							return redirect('attendances')->with('msg','Operation not allowed');
					}
					$todayAttendance->save();
				}
				else{
					// TO CHECK USER WORKING DAY
					if($user->offDay==strtolower(date('l')))
						return back()->with('msg','Today is not your working day');
					$createdData['userId']=Auth::user()->id;
					if($i==1){
						$createdData['checkIn']=date('Y-m-d H:i:s');
						Attendance::create($createdData);
						$user->status='active';
					}
					else
						return redirect('attendances')->with('Operation Not allowed without Checkin');
				}
				$user->save();
				return redirect('attendances')->with('msg',"Today's Attendance updated");
			}
			return back()->with('msg','Must be in working hour for attendance');
		}
		else
			return abort(401);
	}

	// TO REMOVE ALL ASSIGNED TASK STATUS TO UNASSIGNED
	public static function resettingAssignTask(){
		// to resetting the field value
		$events=Event::all();
		$userId=Auth::user()->id;
		foreach($events as $event){
			if($event->messageId==$userId){
				$event->messageId=null;
				$event->messageStatus='unassigned';	
			}
			if($event->commentId==$userId){
				$event->commentId=null;
				$event->commentStatus='unassigned';	
			}
			if($event->calendarSpreadId==$userId){
				$event->calendarSpreadId=null;
				$event->calendarSpreadStatus='unassigned';	
			}
			if($event->followUpId==$userId){
				$event->followUpId=null;
				$event->followUpStatus='unassigned';	
			}
			$event->save();
		}
	}

	//==========FOR ADMIN ==============================
	/* TO GET TOTAL ATTENDANCE */
	public function show(){
		if(Auth::user()->role=='admin'){
			$users=User::where('role','employee')->get();
			$attendances=Attendance::all();
			return view('admin.employee.attendance',compact('attendances','users'));
		}
		else
			abort(401);
	}

}
