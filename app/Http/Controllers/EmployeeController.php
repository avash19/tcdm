<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HelperController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Log;
use DateTime;

class EmployeeController extends Controller{

  // TO RETURN EMPLOYEE TASK DISPLAY PAGE WITH LIST OF TASKS
  public function index(){
		$id=Auth::user()->id;
		$theDayAfterTomorrow = new DateTime('+2day');
		$theDayAfterTomorrow = $theDayAfterTomorrow->format('Y-m-d').' 00:00:00';
		$todayEvents=Event::where([
			['endDate','>=', date('Y-m-d')],['endDate','<',$theDayAfterTomorrow]])->get();
		$todaysEvents=[];
		if(count($todayEvents)>0){
			foreach($todayEvents as $todayEvent){
				if($todayEvent->commentId==$id || $todayEvent->messageId==$id || $todayEvent->calendarSpreadId==$id || $todayEvent->followUpId==$id)
					array_push($todaysEvents,$todayEvent);
			}
		}
		//TO GET UNASSIGNED TASK
		$unAssignedTasks=HelperController::getUnassignedEvents();
		
		$events=Event::where('commentId',$id)->orWhere('messageId',$id)->orWhere('calendarSpreadId',$id)->orWhere('followUpId',$id)->get();
    return view('employee.task.display',compact(['events','todaysEvents','unAssignedTasks']));
  }

  // RETURN ONE TASK FOR EDIT
  public function edit($id,Event $event){
    return view('employee.task.edit',compact(['id','event']));
  }

  // TO UPDATE THE EMPLOYEE TASK
  public function update(Request $request,Event $task){
    $this->validate($request,[
      'id'=>'required',
      'remark'=>"min:3|required"
    ]);
		$event=$task;

		$id=$request->get('id');
		$remarks=[];
		if($id==0){
			if($event->commentRemark)
				$remarks=json_decode($event->commentRemark);
			array_push($remarks,$request->get('remark'));
			$updateData['commentRemark']=json_encode($remarks);
		}
		elseif($id==1){
			if($event->messageRemark)
				$remarks=json_decode($event->messageRemark);
			array_push($remarks,$request->get('remark'));
			$updateData['messageRemark']=json_encode($remarks);
		}
		elseif($id==2){
			if($event->calendarSpreadRemark)
				$remarks=json_decode($event->calendarSpreadRemark);
			array_push($remarks,$request->get('remark'));
			$updateData['calendarSpreadRemark']=json_encode($remarks);
		}
		else{
			if($event->followUpRemark)
				$remarks=json_decode($event->followUpRemark);
			array_push($remarks,$request->get('remark'));
			$updateData['followUpRemark']=json_encode($remarks);
		}

    $event->update($updateData);
    return back()->with('msg','Task Updated Successfully');;
  }

	// TO REJECT TASK
	public function rejectTask($id,Event $event){
		if($id==0){
			Log::create(['detail'=>json_encode([$event->userComment->name.' '.$event->commentId.' unassigned comment task'])]);	
			$event->update(['commentId'=>null,'commentStatus'=>'unassigned']);
		}
		elseif($id==1){
			Log::create(['detail'=>json_encode([$event->userMessage->name.' '.$event->messageId.' unassigned message task'])]);	
			$event->update(['messageId'=>null,'messageStatus'=>'unassigned']);
		}
		elseif($id==2){
			Log::create(['detail'=>json_encode([$event->userCalendarSpread->name.' '.$event->calendarSpreadId.' unassigned calendar and spreadsheet task'])]);	
			$event->update(['calendarSpreadId'=>null,'calendarSpreadStatus'=>'unassigned']);
		}
		else{
			Log::create(['detail'=>json_encode([$event->userFollowUp->name.' '.$event->followUpId.' unassigned follow up task'])]);	
			$event->update(['followUpId'=>null,'followUpStatus'=>'unassigned']);
		}
		
		return redirect('/employee/tasks')->with('msg','Event Task Unassigned Successfully :)');
	}

	// TO ADD TASK OF GIVEN EVENT
	public function add($id,Event $event){
		$todayAttendance=HelperController::getTodayAttendance();
		if($todayAttendance){
			if($todayAttendance->breakStart && !$todayAttendance->breakEnd)
					return back()->with('msg','Please stop your break time first!');
			if($todayAttendance->checkOut)
				return back()->with('msg','You have already checkout!');

			$updateData=[];
			if($id==0){
				$updateData['commentId']=Auth::user()->id;
				$updateData['commentStatus']='assigned';
			}
			elseif($id==1){
				$updateData['messageId']=Auth::user()->id;
				$updateData['messageStatus']='assigned';
			}
			elseif($id==2){
				$updateData['calendarSpreadId']=Auth::user()->id;
				$updateData['calendarSpreadStatus']='assigned';
			}
			else{
				$updateData['followUpId']=Auth::user()->id;
				$updateData['followUpStatus']='assigned';
			}
	
			$event->update($updateData);
			return back()->with('msg','New Task Added Successfully');
		}
		else
			return back()->with('msg','You must checkin before adding task');
	}

	// TO VIEW EVENT TASK ACCORDING TO TASK
	public function getEventTasks($by){
		$todayAttendance=HelperController::getTodayAttendance();
    $user=Auth::user();
    $totalCommentTask=$user->comments->where('commentId',$user->id)->count();
    $totalMessageTask=$user->messages->where('messageId',$user->id)->count();
    $totalCalendarSpread=$user->calenderSpreads->where('calendarSpreadId',$user->id)->count();
    $totalfollowUp=$user->followUps->where('followUpId',$user->id)->count();
		// TO GET ALL UNASSIGNED TASKS
		$unAssignedTasks=HelperController::getUnassignedEvents();

		$user=Auth::user();
		$tasks=[];
		$id=0;
		$title=ucfirst($by);
		if($by=='message'){
			$tasks=$user->messages()->get();
			$id=1;
		}
		elseif($by=='comment')
			$tasks=$user->comments()->get();
		elseif($by=='calendar and spreadsheet'){
			$id=2;
			$tasks=$user->calenderSpreads()->get();
		}
		elseif($by=='follow up'){
			$id=3;	
			$tasks=$user->followUps()->get();
		}
		else
			abort(404);
		return view('employee.task.detail',compact(['tasks','title','id','totalCommentTask','totalMessageTask','totalCalendarSpread','totalfollowUp','unAssignedTasks','todayAttendance']));
	}
}
