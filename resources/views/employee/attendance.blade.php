@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Attendance</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('attendances')}}">Attendance</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              @if(isset($todayAttendance))
                @if(!$todayAttendance->checkIn)
                  <form action="{{url('attendances')}}" method='POST'>
                    {{csrf_field()}}
                    <input type="hidden" name='attendanceValue' value='1'>
                    <button class="btn btn-sm btn-neutral">Check In
                      <i class='fas fa-bell'></i>
                    </button>
                  </form>
                @elseif(!$todayAttendance->checkOut && !$todayAttendance->breakStart)
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-3 text-right">
                    <form action="{{url('attendances')}}" method='POST'>
                      {{csrf_field()}}
                      <input type="hidden" name='attendanceValue' value='2'>
                      <button class="btn btn-sm btn-neutral">Break Start
                        <i class='fas fa-bell'></i>
                      </button>
                    </form>
                  </div>
                  <div class="col-md-3">
                    <form action="{{url('attendances')}}" method='POST'>
                      {{csrf_field()}}
                      <input type="hidden" name='attendanceValue' value='4'>
                      <button class="btn btn-sm btn-neutral">Check Out
                        <i class='fas fa-bell'></i>
                      </button>
                    </form>
                  </div>
                </div>
                @elseif($todayAttendance->breakStart && !$todayAttendance->breakEnd)
                <form action="{{url('attendances')}}" method='POST'>
                  {{csrf_field()}}
                  <input type="hidden" name='attendanceValue' value='3'>
                  <button class="btn btn-sm btn-neutral">Break End
                    <i class='fas fa-bell'></i>
                  </button>
                </form>
                @elseif(!$todayAttendance->checkOut)
                  <form action="{{url('attendances')}}" method='POST'>
                    {{csrf_field()}}
                    <input type="hidden" name='attendanceValue' value='4'>
                    <button class="btn btn-sm btn-neutral">Check Out
                      <i class='fas fa-bell'></i>
                    </button>
                  </form>
                @endif
              @else
                <form action="{{url('attendances')}}" method='POST'>
                  {{csrf_field()}}
                  <input type="hidden" name='attendanceValue' value='1'>
                  <button type='submit' class="btn btn-sm btn-neutral">Check In
                    <i class='fas fa-bell'></i>
                  </button>
                </form>
              @endif
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
              <h3 class="text-white mb-0">Attendance Details</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">#</th>
                    <th scope="col" class="sort" data-sort="name">Check-In</th>
                    <th scope="col" class="sort" data-sort="name">Break Start</th>
                    <th scope="col" class="sort" data-sort="name">Break End</th>
                    <th scope="col" class="sort" data-sort="name">Check-Out</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @if(isset($attendances))
                    @foreach($attendances as $index=>$attendance)
                      <tr>
                        <td class="budget">
                          {{$index+1}}
                        </td>
                        <td class="budget">
                          {{$attendance->checkIn}}
                        </td>
                        <td class="budget">
                          {{$attendance->breakStart}}
                        </td>
                        <td class="budget">
                          {{$attendance->breakEnd}}
                        </td>
                        <td class="budget">
                          {{$attendance->checkOut}}
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     @include('include.footer')
    </div>
  </div>
@endsection