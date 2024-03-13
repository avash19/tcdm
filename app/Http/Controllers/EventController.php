<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Client;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Auth;

class EventController extends Controller
{
  // TO GET ALL EVENT LIST PAGE ALONG WITH EVENTS
  public function index(){
    $month=EventController::getStartEndDate();
    $monthStart=$month['monthStart'];
    $monthEnd=$month['monthEnd'];
    $thisMonthEvents=Event::where('startDate','>=',$monthStart)->where('startDate','<=',$monthEnd)->count();
    $activeEvents=Event::where([['startDate','<=',date('Y-m-d')],['endDate','>=',date('Y-m-d')]])->get();
    $totalEvents=Event::where([['startDate','<=',date('Y-m-d')],['endDate','>=',date('Y-m-d')]])->orWhere('startDate','>',date('Y-m-d'))->count();
    $totalActiveEvents=count($activeEvents);
    return view('admin.event.display',compact('totalActiveEvents','activeEvents','thisMonthEvents','totalEvents'));
  }

  //TO GET EVENT FOR CURRENT MONTH
  public function getEvents($filter){
    $month=EventController::getStartEndDate();
    $monthStart=$month['monthStart'];
    $monthEnd=$month['monthEnd'];
    $events=[];
    if($filter=='thismonth')
     $events=Event::where('startDate','>=',$monthStart)->where('startDate','<=',$monthEnd)->get();
    elseif($filter=='active')
      $events=Event::where([['startDate','<=',date('Y-m-d')],['endDate','>=',date('Y-m-d')]])->get();
    elseif($filter=='current-upcoming')
      $events=Event::where([['startDate','<=',date('Y-m-d')],['endDate','>=',date('Y-m-d')]])->orWhere('startDate','>',date('Y-m-d'))->get();
    elseif($filter=='previous')
      $events=Event::where([['endDate','<',date('Y-m-d')]])->get(); 
     return response()->json(['events'=>$events,'role'=>Auth::user()->role]);
  }

  // TO GET EVENT ACCORDING TO TASK
  public function getEventAccordingToTask($id,$by){
    $employees=User::where([['role','employee'],['status','active']])->get();
    $events=[];
    $eventTitle=$eventTask='';
    $eventTask=ucfirst($by);
    if($id==1){
      $eventTitle='Assigned Task';
      if($by=='followup')
        $events=Event::select(DB::raw('followUpId as employeeId,id,name,clientId'))->where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['followUpId','!=',null]
        ])->get();
      elseif($by=='comment')
        $events=Event::select(DB::raw('commentId as employeeId,id,name,clientId'))->where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['commentId','!=',null]
        ])->get();
      elseif($by=='calendar and spreadsheet')
        $events=Event::select(DB::raw('calendarSpreadId as employeeId,id,name,clientId'))->where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['calendarSpreadId','!=',null]
        ])->get();
      elseif($by=='message')
        $events=Event::select(DB::raw('messageId as employeeId,id,name,clientId'))->where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['messageId','!=',null]
        ])->get();
      else
        abort(404);
    }
    elseif($id==2){
      $eventTitle='Unassigned Task';
      if($by=='followup')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['followUpId',null]
        ])->get();
      elseif($by=='comment')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['commentId',null]
        ])->get();
      elseif($by=='calendar and spreadsheet')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['calendarSpreadId',null]
        ])->get();
      elseif($by=='message')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['messageId',null]
        ])->get();
      else
        abort(404);
    }
    elseif($id==3){
      if($by=='active event')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>',date('Y-m-d')],
        ])->get();
      else
        abort(404);
    }
    else
      abort(404);

    return view('admin.event.detail',compact(['events','eventTitle','eventTask','employees']));
  }

  // TO GET EVENT ACCORDING TO TASK USING AJAX
  public function getTask($by){
    if($by=='followup')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['followUpId',null]
        ])->get();
      elseif($by=='comment')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['commentId',null]
        ])->get();
      elseif($by=='calendar and spreadsheet')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['calendarSpreadId',null]
        ])->get();
      elseif($by=='message')
        $events=Event::where([
          ['startDate','<=',date('Y-m-d')],
          ['endDate','>=',date('Y-m-d')],
          ['messageId',null]
        ])->get();
      else
        abort(404);
    return response()->json($events);
  }

  // TO UPDATE EVENT ACCORING TO TASK
  public function updateEventAccordingToTask(Request $request, Event $event,$by){
    $this->validate($request,[
      'userId'=>'required|exists:users,id'
    ]);
    $userId=$request->get('userId');
    if($by=='message'){
      $event->messageId=$userId;
      $event->messageStatus='assigned';
      $detail=json_encode(['User of Id '.$userId.' is assigned for message']);
    }
    elseif($by=='comment'){
      $event->commentId=$userId;
      $event->commentStatus='assigned';
      $detail=json_encode(['User of Id '.$userId.' is assigned for comment']);
    }
    elseif($by=='calendar and spreadsheet'){
      $event->calendarSpreadId=$userId;
      $event->calendarSpreadStatus='assigned';
      $detail=json_encode(['User of Id '.$userId.' is assigned for comment']);
    }
    elseif($by=='followup'){
      $event->followUpId=$userId;
      $event->followUpStatus='assigned';
      $detail=json_encode(['User of Id '.$userId.' is assigned for comment']);
    }
    else
      abort(404);
    
    Log::create(['detail'=>$detail]);
    $event->save();

    return back()->with('msg','Task assigned Successfully!');
  }

  // TO UNASSGIN TASK TO USER
  public function unassignTask(Event $event,User $user,Request $request){
    $eventTask=$request->get('eventTask');
    $eventTitle=$request->get('eventTitle');
    if($eventTask && $eventTitle){
      if(strtolower($eventTask)=='message'){
        $event->messageId=null;
        $event->messageStatus='unassigned';
      }
      elseif(strtolower($eventTask)=='comment'){
        $event->commentId=null;
        $event->commentStatus='unassigned';
      }
      elseif(strtolower($eventTask)=='calendar and spreadsheet'){
        $event->calendarSpreadId=null;
        $event->calendarSpreadStatus='unassigned';
      }
      elseif(strtolower($eventTask)=='followup'){
        $event->followUpId=null;
        $event->followUpStatus='unassigned';
      }
      else
        abort(403);

      $event->save();
      return back()->with('msg','Task unassigned successfully');
    }
    else
      abort(403);
  }

  //TO ASSIGN TASK TO ACITVE USER BY ADMIN 
  public function assignTasks(){
    $employees=User::where([['role','employee'],['status','active']])->get();
    
    return view('admin.event.assigntask',compact(['employees']));
  }

  // TO RETURN CREATE PAGE FOR EVENT
  public function create(){
    if(Auth::user()->role=='admin'){
      $clients=Client::where('status','active')->get();
      return view('admin.event.add',compact('clients'));
    }
    else
      abort(401);
  }

  // TO STORE EVENT
  public function store(Request $request){
    if(Auth::user()->role=='admin'){
      $this->validate($request,[
        'startDate'=> 'required|date|date_format:Y-m-d|after:yesterday',
        'startDate'=> 'required|date|date_format:Y-m-d',
        'clientId'=> 'required|exists:clients,id',
      ]);
      $checkClient=Client::find($request->get('clientId'));
      if($checkClient){
        $eventData=$request->only('startDate','endDate','clientId');
        $eventData['name']=$checkClient->name;
        Event::create($eventData);
        Log::create(['detail'=>json_encode($eventData)]);
        return redirect('events/create')->with('msg','Event Created Successfully');
      }
      else
        return redirect('events/create')->with('msg','Client Not found');
    }
    else abort(401);
  }
  
  //TO SHOW SINGLE EVENT
  public function show(Event $event){
      //
  }

 // TO GET EVENT BY ID TO EDIT
  public function edit(Event $event){
    if(Auth::user()->role=='admin'){
      $employees=User::where('status','active')->where('role','employee')->get();
      return view('admin.event.edit',compact('employees','event'));
    }
    else abort(401);
  }

  // TO UPDATE EVENT DATA BY EVENT ID
  public function update(Request $request, Event $event){
    if(Auth::user()->role=='admin'){
      $this->validate($request,[
        'startDate'=> 'required|date|date_format:Y-m-d|after:yesterday',
        'startDate'=> 'required|date|date_format:Y-m-d',
        // 'messageId'=>'exists:users,id',
        // 'commentId'=>'exists:users,id',
        // 'calendarSpreadId'=>'exists:users,id',
        // 'followUpId'=>'exists:users,id',
      ]);
      if($request->get('messageId')){
        $eventData=$request->only('startDate','endDate','clientId','messageId','commentId','calendarSpreadId','followUpId');
        $details=[];
        if(isset($eventData['messageId'])){
          if($eventData['messageId']!=$event->messageId)
            array_push($details,'Employee of Id '.$eventData['messageId'].' is assigned for handling message');
          $eventData['messageStatus']='assigned';
        }
        else{
          $eventData['messageId']=null;
          $eventData['messageStatus']='unassigned';
        }
    
        if(isset($eventData['commentId'])){
          if($eventData['commentId']!=$event->commentId)
            array_push($details,'Employee of Id '.$eventData['commentId'].' is assigned for handling comment');
          $eventData['commentStatus']='assigned';
        }
        else{
          $eventData['commentId']=null;
          $eventData['commentStatus']='unassigned';
        }
    
        if(isset($eventData['calendarSpreadId'])){
          if($eventData['calendarSpreadId']!=$event->calendarSpreadId)
            array_push($details,'Employee of Id '.$eventData['calendarSpreadId'].' is assigned for handling calendar and spreadsheet');
          $eventData['calendarSpreadStatus']='assigned';
          }
        else{
          $eventData['calendarSpreadId']=null;
          $eventData['calendarSpreadStatus']='unassigned';
        }
    
        if(isset($eventData['followUpId'])){
          if($eventData['followUpId']!=$event->followUpId)
            array_push($details,'Employee of Id '.$eventData['followUpId'].' is assigned for handling followup');
          $eventData['followUpStatus']='assigned';
          }

        else{
          $eventData['followUpId']=null;
          $eventData['followUpStatus']='unassigned';
        }

        if(count($details)>0)
        Log::create(['detail'=>json_encode($details)]);
      }

      else
        $eventData=$request->only('startDate','endDate');

      Event::where('id',$event->id)->update($eventData);
      
      return back()->with('msg','Event Updated Successfully');
    }
    else abort(401);
  } 

  // ASSIGN BULK EVENT TO USER 
  public function bulkAssignEvents(Request $request){
    if(Auth::user()){
      if(Auth::user()->role=='admin'){
        $userId=$request->get('userId');
        $taskName=$request->get('taskName');
        $events=$request->get('events');
        foreach($events as $event){
            $event=Event::find($event);
            if($taskName=='message'){
              $event->messageId=$userId;
              $event->messageStatus='assigned';
              $detail=[$userId.' is assigned for message'];
            }
            elseif($taskName=='comment'){
              $event->commentId=$userId;
              $event->commentStatus='assigned';
              $detail=[$userId.' is assigned for comment'];
            }
            elseif($taskName=='calendar and spreadsheet'){
              $event->calendarSpreadId=$userId;
              $event->calendarSpreadStatus='assigned';
              $detail=[$userId.' is assigned for Calendar Spreadsheet task'];
            }
            elseif($taskName=='followup'){
              $event->followUpId=$userId;
              $event->followUpStatus='assigned';
              $detail=[$userId.' is assigned for Follow Up'];
            }
            else
              abort(403);

            $event->save();
            Log::create(['detail'=>json_encode($detail)]);
          }
          return response()->json(['status'=>true]);
      }
      else 
        abort('401');
    }
    else
      abort(403);
  }
 
  // TO DELETE EVENT BY ID
  public function destroy(Event $event){
    if(Auth::user()->role=='admin'){
      $event->delete();
      return back()->with('msg','Event Deleted Successfully');
    }
    else abort(401);
  }
  

  // TO FILTER EVENT BY MONTH
  public function filterEvent($date){
    $year=date('Y',strtotime($date));
    $month=date('m',strtotime($date));
    $nextDate = null;
    if($month==12)
      $nextDate=($year+1).'-1-1 00:00:00';
    else{
      $nextDate=$year.'-'.($month+1).'-1 00:00:00';
    }
    $date=$date.' 00:00:00';
    $events=Event::where('created_at','>=',$date)->where('created_at','<',$nextDate)->get();
    return $events;
  }

  //TO GET CURRENT MONTH START-DATE AND END-DATE
  public static function getStartEndDate(){
    $date = new DateTime('now');
    $date->modify('first day of this month');
    $monthStart=$date->format('Y-m-d');
    $date->modify('last day of this month');
    $monthEnd=$date->format('Y-m-d');

    return [
      'monthStart'=>$monthStart,
      'monthEnd'=>$monthEnd
    ];
  }
}
