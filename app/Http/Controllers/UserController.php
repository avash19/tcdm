<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HelperController;
use App\Models\User;
use App\Models\Event;
use App\Models\Attendance;
use DateTime;
use App\Notifications\Tasks;

class UserController extends Controller
{
  //===================== LOGIN USER =====================
  public function getLoginPage(){
    //TO STORE DEFAULT USER IF NOT EXISITS
    $checkUser=User::find(1);
    if(!$checkUser){
      User::create([
        'name'=>'Avash',
        'email'=>'avash@admin.com',
        'phoneNumber'=>'9861973307',
        'password'=>bcrypt('Avash@46'),
        'role'=>'admin',
        'status'=>'active',
      ]);
    }
    
    if(Auth::check()){
      if(Auth::user()->role=='admin')
        return redirect('admin/dashboard')->with('msg','Welcome Back '.Auth()->user()->name); 
      else
        return redirect('employee/dashboard')->with('msg','Welcome Back '.Auth()->user()->name); 
    }
    else
      return view('login');
  }

  //===================== LOGIN USER =====================
	public function login(Request $request){
    $this->validate($request,[
      'email'=>'required|email',
      'password'=>'required',
    ]);
    $loginData = $request->only('email', 'password');

    if(Auth::attempt($loginData)){
      if(Auth::user()->role=='admin')
        return redirect('admin/dashboard');
      else if(Auth::user()->role=='employee')
        return redirect('employee/dashboard');
    }
    else
      return back()->with('error','Email/Password Not valid');
	}

  //===================== TO GET ADMIN DASHBOARD =========
  public function getAdminDashboard(){
    date_default_timezone_set('Asia/Kathmandu');
    // date_default_timezone_set('America/New_York');

    //------------------------------
    // TO RETURN TOTAL ACTIVE EVENTS
    //------------------------------
    $totalAssignComment=$totalAssignMessage=$totalAssignFollowUp=$totalAssignCalendarSpread=0;
    $totalUnassignComment=$totalUnassignMessage=$totalUnassignFollowUp=$totalUnassignCalendarSpread=0;
    $checkEvents=Event::where([
      ['startDate','<=',date('Y-m-d')],
      ['endDate','>=',date('Y-m-d')]
    ])->get();
    $totalEvent=count($checkEvents);
    foreach($checkEvents as $event){
      if($event->messageId) $totalAssignMessage++;
      else $totalUnassignMessage++;

      if($event->commentId) $totalAssignComment++;
      else $totalUnassignComment++;

      if($event->calendarSpreadId) $totalAssignCalendarSpread++;
      else $totalUnassignCalendarSpread++;

      if($event->followUpId) $totalAssignFollowUp++;
      else $totalUnassignFollowUp++;
    } 
    //------------------------------
    // TO RETURN TOTAL ACTIVE EVENTS
    //------------------------------
    $totalActiveEvent=count($checkEvents);

    //--------------------------------
    //FOR EMPLOYEE ABSENT-ACTIVE-BREAK
    //-------------------------------
     $yesterday=new DateTime('-1day');
 
     if('12:00:00'<=date('H:i:s'))
       $condition=[['role','employee'],['offDay','!=',strtolower(date('l'))]];
     else
      $condition=[['role','employee'],['offDay','!=',strtolower($yesterday->format('l'))]];

    $checkEmployees=User::where($condition)->get();
    $absentEmployees=$latePresents=[];
    $totalBreakEmployee=$totalActiveEmployee=$totalPresentEmployee=0;
    $requiredTotalEmployee=0;
    if(count($checkEmployees)>0){
      $attendances=HelperController::getTodayAttendanceForAdmin();
      foreach($checkEmployees as $employee){
          $nxtFifteen=date('H:i',strtotime("+15 minutes", strtotime($employee->startTime)));
          if('12:00:00'<=date('H:i:s'))
            $fifteenMinCheck=date('Y-m-d H:i:s',strtotime(date('Y-m-d ').$nxtFifteen));
          else
            $fifteenMinCheck=date('Y-m-d H:i:s',strtotime($yesterday->format('Y-m-d ').$nxtFifteen));
          $countLate=0;
          $count=0;
          if(count($attendances)>0){
            foreach($attendances as $attendance){
              if($attendance->userId==$employee->id){
                if($employee->status=='active')
                  $totalActiveEmployee++;
                elseif($attendance->breakStart && !$attendance->breakEnd)
                  $totalBreakEmployee++;  
                if($attendance->checkIn>$fifteenMinCheck)
                  $countLate++;
    
                $totalPresentEmployee++;
                $requiredTotalEmployee++;
                $count++;
              }
            }
          }
          if($count==0){
            $getEmpTime=HelperController::getUserStartEndTime($employee);
            if($getEmpTime['startTime']<=$getEmpTime['currentTime'] && $getEmpTime['endTime']>=$getEmpTime['currentTime']){
              array_push($absentEmployees,$employee);
              $requiredTotalEmployee++;
            }
          }
         
          if($countLate>0)
            array_push($latePresents,$employee);
      }
    }

    return view('admin.dashboard',compact('absentEmployees','latePresents','totalBreakEmployee','totalActiveEmployee','totalPresentEmployee','requiredTotalEmployee','totalActiveEvent',
    'totalAssignComment','totalAssignMessage','totalAssignFollowUp','totalAssignCalendarSpread',
    'totalUnassignComment','totalUnassignMessage','totalUnassignFollowUp','totalUnassignCalendarSpread','totalEvent'));
  }
  
  //===================== TO GET EMPLOYEE DASHBOARD ======
  public function getEmployeeDashboard(){
    $todayAttendance=HelperController::getTodayAttendance();
    $user=Auth::user();
    $totalCommentTask=$user->comments->where('commentId',$user->id)->count();
    $totalMessageTask=$user->messages->where('messageId',$user->id)->count();
    $totalCalendarSpread=$user->calenderSpreads->where('calendarSpreadId',$user->id)->count();
    $totalfollowUp=$user->followUps->where('followUpId',$user->id)->count();
		$unAssignedTasks=HelperController::getUnassignedEvents();
    return view('employee.dashboard',compact('todayAttendance','totalCommentTask','totalMessageTask','totalCalendarSpread','totalfollowUp','unAssignedTasks'));
  }

  //===================== LOGOUT USER ====================
	public function logout(){
    Auth::logout();
    return redirect('/')->with('msg','Logout Successfull');
	}

  //===================== GET PROFILE DATA ===============
  public function profile(){
    return view('profile');  
  }

  //===================== TO UPDATE PROFILE DATA =========
  public function updateProfile(Request $request){
    $id=Auth::user()->id;
    $this->validate($request,[
      'email'=>"unique:users,email,$id",
      'phoneNumber'=>"min:10|unique:users,phoneNumber,$id",
      'name'=>'min:3',
    ]);
    
    $profileData=$request->only('name','email','phoneNumber');

    User::where('id',$id)->update($profileData);

    return redirect('profile')->with('msg','Profile Updated successfully :)');
  }

  public function checkActive(){
    date_default_timezone_set('Asia/Kathmandu');
    // date_default_timezone_set('America/New_York');
    $users=User::where('role','employee')->get();
    $attendances=HelperController::getTodayAttendanceForAdmin();
    foreach($users as $user){
      $userTime=HelperController::getUserStartEndTime($user);
      $endTime=date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($userTime['endTime'])));
      if($endTime<date('Y-m-d H:i:s')){
        // check whether user has already checkout or not present
        // here the status must be inactive
        if($user->status=='active'){
          $events=Event::all();
          foreach($attendances as $attendance){
            if($attendance->userId==$user->id){
              $attendance->checkOut=date('Y-m-d H:i:s');
              $attendance->save();
            }
          }
          $user->status='inactive';
          $user->save();

          // TO UNASSIGN ASSIGN TASK
          $userId=$user->id;
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
      }
    }
    return true;
  }

  // TO GET THE EMP NAME ONLY
  public function getEmpName(User $user){
    return $user->name;
  }

  // public funtion Tasks(User $user){
  //   $user = User::find(1); // Assuming you have a user with ID 1
  //   $taskName = 'Prepare Monthly Report';
  //   $dueDate = '2024-03-15';

  //   // Trigger the notification
  //   $user->notify(new Tasks($taskName, $dueDate));
  // }
}