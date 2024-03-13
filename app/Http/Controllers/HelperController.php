<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\OfficeHour;
use App\Models\Attendance;
use Auth;
use DateTime;
use App\Notifications\Tasks;

class HelperController extends Controller
{
	// TO GET ALL THE ACITVE UNASSIGNED EVENT LISTS
	public static function getUnassignedEvents(){
		$unAssignedTasks=[];
		$checkUnassignEvents=Event::where([
			['startDate','<=',date('Y-m-d')],
			['endDate','>=',date('Y-m-d')],
		])->get();
		foreach($checkUnassignEvents as $u){
			if(!$u->messageId ||!$u->commentId || !$u->calendarSpreadId || !$u->followUpId )
				array_push($unAssignedTasks,$u);
		}
		return $unAssignedTasks;
	}

	// TO GET TODAY ATTENDANCE BY USER
	public static function getTodayAttendance(){
		$todayAttendance=[];
		$user=Auth::user()->id;
		$condition = [];
	
		$userTime=HelperController::getUserStartEndTime();
		$endTime=$userTime['endTime'];
		$oneHourBack=$userTime['oneHourBack'];

		$condition=[['checkIn','>=',$oneHourBack],['checkIn','<',$endTime],['userId',$user]];
		$todayAttendance=Attendance::where($condition)->first();
        // dd(Attendance::where($condition)->getBindings());

		return $todayAttendance;
	}

	 // TO GET TODAYS ATTENDANCE
	public static function getTodayAttendanceForAdmin(){
    // date_default_timezone_set('America/New_York');

		date_default_timezone_set('Asia/Kathmandu');

    $todayAttendances=[];
		// TO CHECK BEFORE OR AFTER MIDNIGHT
		$tomorrow = new DateTime('+1day');
		$yesterday=new DateTime('-1day');

		if('12:00:00'<=date('H:i:s'))
			$conditon=[['checkIn','>=',date('Y-m-d 12:00:00')],['checkIn','<',$tomorrow->format('Y-m-d 12:00:00')]];
		else
			$conditon=[['checkIn','>=',$yesterday->format('Y-m-d 12:00:00')],['checkIn','<',date('Y-m-d 12:00:00')]];

			// dd(Attendance::where($conditon)->toSql());
			// dd(Attendance::where($conditon)->getBindings());
		$todayAttendances=Attendance::where($conditon)->get();
		return $todayAttendances;
	}

	// TO GET USER STARTTIME AND END-TIME
	public static function getUserStartEndTime($user=null){
		date_default_timezone_set('Asia/Kathmandu');
    // date_default_timezone_set('America/New_York');

		if(!$user)
			$user=User::find(auth()->user()->id);
		$userStartAMPM=date('A',strtotime($user->startTime));
		$userEndAMPM=date('A',strtotime($user->endTime));
		$tomorrow = new DateTime('+1day');
		$yesterday=new DateTime('-1day');
		$currentTime=date('Y-m-d H:i:s');

		if('12:00:00'<=date('H:i:s')){
			if($userStartAMPM=='PM'){
				$startTime=date('Y-m-d H:i:s',strtotime($user->startTime));
				$oneHourBack=date('Y-m-d H:i:s',strtotime("-60 minutes", strtotime($user->startTime)));
			}
			else{
				$startTime=date('Y-m-d '.$user->startTime, strtotime($tomorrow->format('Y-m-d')));
				$oneHourBack1=date('Y-m-d '.$user->startTime,strtotime($tomorrow->format('Y-m-d')));
				$oneHourBack=date('Y-m-d H:i:s',strtotime("-60 minutes", strtotime($oneHourBack1)));
			}
			
			if($userEndAMPM=='PM')
				$endTime=date('Y-m-d H:i:s',strtotime($user->endTime));
			else
				$endTime=date('Y-m-d '.$user->endTime, strtotime($tomorrow->format('Y-m-d')));
		}
		else{
			if($userStartAMPM=='PM'){
				$startTime=date('Y-m-d '.$user->startTime,strtotime($yesterday->format('Y-m-d')));
				$oneHourBack1=date('Y-m-d'.$user->startTime,strtotime($yesterday->format('Y-m-d')));
				$oneHourBack=date('Y-m-d H:i:s',strtotime("-60 minutes", strtotime($oneHourBack1)));
			}
			
			else{
				$startTime=date('Y-m-d H:i:S', strtotime($user->startTime));
				$oneHourBack=date('Y-m-d H:i:s',strtotime("-60 minutes", strtotime($user->startTime)));
			}

			if($userEndAMPM=='PM')
				$endTime=date('Y-m-d '.$user->endTime,strtotime($yesterday->format('Y-m-d')));
			else
				$endTime=date('Y-m-d H:i:s', strtotime($user->endTime));
		}
		
		$oneHourFast=date('Y-m-d H:i:s',strtotime("+60 minutes",strtotime($endTime)));

		return ['startTime'=>$startTime,'endTime'=>$endTime,'oneHourBack'=>$oneHourBack,'oneHourFast'=>$oneHourFast,'currentTime'=>$currentTime];
	}

}

