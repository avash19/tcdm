@extends('include.layout')
@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Event Tasks</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a>{{$title}}</a></li>
              </ol>
            </nav>
          </div>
          @if(!isset($todayAttendance))
            <div class="col-lg-6 col-5 text-right">
              <form action="{{url('attendances')}}" method='POST'>
                {{csrf_field()}}
                <input type="hidden" name='attendanceValue' value='1'>
                <button type='submit' class="btn btn-sm btn-neutral">Check In
                  <i class='fas fa-bell'></i>
                </button>
              </form>
            </div>
          @endif
        </div>
        <!-- Card stats -->
        <div class="row">
        <div class='col-md-12 success alert-success' style='width:90%;margin:10px auto;text-align:center;'>
            <!-- @if($msg=Session::get('msg'))
            <p  style='padding:5px;color:#F5593D;font-size:25px;font-weight:bold'>
              {{$msg}}
            </p>
            @endif -->
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body"  style='min-height:118px;'>
                <a href="{{url('employee/events/tasks/message')}}">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Messaging Task</h5>
                      <span class="h2 font-weight-bold mb-0">{{$totalMessageTask}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <span class="text-nowrap"></span>
                  </p>
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body" style='min-height:118px;'>
                <a href="{{url('employee/events/tasks/comment')}}">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Comment Task</h5>
                      <span class="h2 font-weight-bold mb-0">{{$totalCommentTask}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <span class="text-nowrap"></span>
                  </p>
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <a href="{{url('employee/events/tasks/calendar and spreadsheet')}}">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Calendar Spreadsheet Task</h5>
                      <span class="h2 font-weight-bold mb-0">{{$totalCalendarSpread}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <span class="text-nowrap"></span>
                  </p>
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body"  style='min-height:118px;'>
                <a href="{{url('employee/events/tasks/follow up')}}">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Follow Up Task</h5>
                      <span class="h2 font-weight-bold mb-0">{{$totalfollowUp}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <span class="text-nowrap"></span>
                  </p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class='col-md-12 danger alert-danger'>
        @if($error=Session::get('error'))
        <p  style='padding:10px'>
          {{$error}}
        </p>
        @endif
      </div>      
      <div class='col-md-12 success alert-success'>
        @if($msg=Session::get('msg'))
        <p  style='padding:10px'>
          {{$msg}}
        </p>
        @endif
      </div>      
      <!-- Dark table -->
      <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">
                Event Tasks for {{ucfirst($title)}}
              </h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">#</th>
                    <th scope="col" class="sort" data-sort="name">Event Id</th>
                    <th scope="col" class="sort" data-sort="name">Event Name</th>
                    <th scope="col" class="sort" data-sort="name">Start Date</th>
                    <th scope="col" class="sort" data-sort="name">End Date</th>
                    <th scope="col" class="sort" data-sort="status">Actions</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @if(isset($tasks))
                    @foreach($tasks as $index=>$task)
                      <tr>
                        <td class="budget">
                          {{$index+1}}
                        </td>
                        <td class="budget">
                          {{$task->id}}
                        </td>
                        <th scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <span class="name mb-0 text-sm">{{$task->name}}</span>
                            </div>
                          </div>
                        </th>
                        <td class="budget">
                          {{$task->startDate}}
                        </td>
                        <td class="budget">
                          {{$task->endDate}}
                        </td>
                        <th scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                                <a href="{{url('employee/events/'.$id.'/'.$task->id.'/edit')}}" style='color:blue;'>
                                  <i class="fas fa-edit"></i>
                                </a>
                            </div>  
                            <div class="media-body">
                              <a href="{{url('employee/events/rejects/'.$id.'/'.$task->id)}}" style='color:blue;'>
                                <button class="btn btn-danger">Unassign</button>
                              </a>
                            </div>  
                          </div>
                        </th>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      @if(isset($unAssignedTasks) && count($unAssignedTasks)>0)
          <div class="col">
            <div class="card bg-default shadow">
              <div class="card-header bg-transparent border-0">
                <h3 class="text-white mb-0">
                  Unassigned Task
                </h3>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-light table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" class="sort" data-sort="name">#</th>
                      <th scope="col" class="sort" data-sort="name">Event Id</th>
                      <th scope="col" class="sort" data-sort="name">Event Name</th>
                      <th scope="col" class="sort" data-sort="name">Start Date</th>
                      <th scope="col" class="sort" data-sort="name">End Date</th>
                      <th scope="col" class="sort" data-sort="status">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                      @foreach($unAssignedTasks as $index=>$event)
                        <tr>
                          <td class="budget">
                            {{$index+1}}
                          </td>
                          <td class="budget">
                            {{$event->id}}
                          </td>
                          <th scope="row">
                            <div class="media align-items-center">
                              <div class="media-body">
                                <span class="name mb-0 text-sm">{{$event->name}}</span>
                              </div>
                            </div>
                          </th>
                          <td class="budget">
                            {{$event->startDate}}
                          </td>
                          <td class="budget">
                            {{$event->endDate}}
                          </td>
                          <th scope="row">
                            <div class="media align-items-center">
                              <div class="media-body">
                                @if(!$event->commentId)
                                  <a href="{{url('employee/events/0/'.$event->id.'/add')}}" style='color:#fff;margin-right:10px;'>
                                    <button class='btn btn-success'> <i class="fas fa-plus"></i> Comment</button>
                                  </a>
                                @endif
                                @if(!$event->messageId)
                                  <a href="{{url('employee/events/1/'.$event->id.'/add')}}" style='color:#fff;;margin-right:10px;'>
                                  <button class='btn btn-info'> <i class="fas fa-plus"></i> Message</button>
                                  </a>
                                @endif
                                @if(!$event->calendarSpreadId)
                                  <a href="{{url('employee/events/2/'.$event->id.'/add')}}" style='color:#fff;;margin-right:10px;'>
                                  <button class='btn btn-primary'> <i class="fas fa-plus"></i> Calender-Spread</button>
                                  </a>
                                @endif
                                @if(!$event->followUpId)
                                  <a href="{{url('employee/events/3/'.$event->id.'/add')}}" style='color:#fff;;margin-right:10px;'>
                                  <button class='btn btn-secondary'> <i class="fas fa-plus"></i> FollowUp</button>
                                  </a>
                                @endif
                              </div>  
                            </div>
                          </th>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif
      </div>
     @include('include.footer')
    </div>
  </div>
@endsection