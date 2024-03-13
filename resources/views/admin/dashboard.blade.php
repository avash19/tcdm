@extends('include.layout')

@section('content')
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Admin</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
              <a href="{{url('events-assign-tasks')}}" class="btn btn-large btn-neutral">Assign Task</a>
            </div>
        </div>
        <!-- Card stats -->
        <div class="row">
        <div class='col-md-12 success alert-success' style='width:90%;margin:10px auto;text-align:center;'>
            @if($msg=Session::get('msg'))
              <p  style='padding:5px;color:black;font-size:25px;font-weight:bold'>
                {{$msg}}
              </p>
            @endif
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body" style='min-height:204px;'>
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Assigned Task</h5>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-bell-55"></i>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <a href="./events/1/message">
                      <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><b>Message: </b> <br>{{$totalAssignMessage}}/{{$totalEvent}}</span>
                        <span class="text-nowrap"></span>
                      </p>
                    </a>
                  </div>
                  <div class="col-md-6">
                  <a href="./events/1/calendar and spreadsheet">
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-success mr-2"><b>Calendar: </b> <br>{{$totalAssignCalendarSpread}}/{{$totalEvent}} </span>
                      <span class="text-nowrap"></span>
                    </p>
                  </a>
                  </div>
                  <div class="col-md-6">
                    <a href="./events/1/comment">
                      <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><b>Comment: </b> <br>{{$totalAssignComment}}/{{$totalEvent}}</span>
                        <span class="text-nowrap"></span>
                      </p>  
                    </a>
                  </div>
                  <div class="col-md-6">
                    <a href="./events/1/followup">
                      <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><b>FollowUp: </b> <br>{{$totalAssignFollowUp}}/{{$totalEvent}}</span>
                        <span class="text-nowrap"></span>
                      </p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body" style='min-height:204px;'>
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-red mb-0">Unassigned Task</h5>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-bell-55"></i>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <a href="./events/2/message">
                      <p class="mt-3 mb-0 text-sm">
                      <span class="text-red mr-2"><b>Message: </b> <br>{{$totalUnassignMessage}}</span>
                        <span class="text-nowrap"></span>
                      </p>
                    </a>
                  </div>
                  <div class="col-md-6">
                  <a href="./events/2/calendar and spreadsheet">
                    <p class="mt-3 mb-0 text-sm">
                    <span class="text-red mr-2"><b>Calendar: </b> <br> {{$totalUnassignCalendarSpread}} </span>
                      <span class="text-nowrap"></span>
                    </p>
                  </a>
                  </div>
                  <div class="col-md-6">
                    <a href="./events/2/comment">
                      <p class="mt-3 mb-0 text-sm">
                      <span class="text-red mr-2"><b>Comment: </b> <br> {{$totalUnassignComment}}</span>
                        <span class="text-nowrap"></span>
                      </p>  
                    </a>
                  </div>
                  <div class="col-md-6">
                    <a href="./events/2/followup">
                      <p class="mt-3 mb-0 text-sm">
                      <span class="text-red mr-2"><b>FollowUp:  </b> <br> {{$totalUnassignFollowUp}}</span>
                        <span class="text-nowrap"></span>
                      </p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6" >
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body" style='min-height:204px;'>
                <a href="{{url('events/3/active event')}}">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Active Events</h5>
                      <span class="h2 font-weight-bold mb-0">{{$totalActiveEvent}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-check-bold"></i>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>   
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body" style='min-height:204px;'>
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Active Employee</h5>
                    <!-- <span class="h2 font-weight-bold mb-0">4/20</span> -->
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="ni ni-check-bold"></i>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <a href="{{url('admin/employee/details/active')}}">
                      <p class="mt-3 mb-0 text-">
                        <span class="text-red mr-2"><b>Total: </b> {{$totalActiveEmployee}}/{{$requiredTotalEmployee}}</span>
                        <span class="text-nowrap"></span>
                      </p>
                    </a>
                  </div>
                  <div class="col-md-12">
                  <a href="{{url('admin/employee/details/break')}}">
                    <p class="mt-3 mb-0 text-red">
                      <span class="text-red mr-2"><b>Break: {{$totalBreakEmployee}}</b> </span>
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
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row" style='margin-top:90px'>
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header">
            <h2> Late Attendance / Absenties </h2>
          </div>
          <div class="card-body">
            @if(isset($absentEmployees))
            <ol>
              @foreach($absentEmployees as $absentEmployee)
                <li style='padding:10px'>{{$absentEmployee->name}} is absent today.</li>
              @endforeach
              @if(isset($latePresents) && count($latePresents)>0)
                @foreach($latePresents as $latePresent)
                  <li style='padding:10px'>{{$latePresent->name}} is late today.</li>
                @endforeach 
              @endif
            </ol>
            @endif
          </div>
        </div>
      </div>
    </div>
    @include('include.footer')
  </div>
@endsection