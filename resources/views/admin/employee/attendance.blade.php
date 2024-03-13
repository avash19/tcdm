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
                  <li class="breadcrumb-item"><a ><i class="fas fa-home"></i></a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              @if(isset($attendances) && count($attendances)>0)
                <select name="selectedUser" id="selectedUser" onchange='getEmpAttendances({{$attendances}})'>
                  <option disabled selected>Choose Employee</option>
                  @if(isset($users) && count($users)>0)
                    @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  @endif
                </select>
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
            <div class="card-header bg-transparent border-0" style='display:flex;justify-content:space-between;align-items:center;'>
              <h3 class="text-white mb-0">Attendance Details</h3>
              <!-- <form id='attendance-by-date' style='display:flex;justify-ocntent:space-between;align-items:center;'>
                <input type="date" name='date' id='date' class="form-control">
                @if(isset($attendances) && count($attendances)>0)
                  <input type='hidden' id='attendanceDatas' value="{{$attendances}}">
                @endif
                <button type="submit" class="btn btn-primary pull-right">Check</button>
              </form> -->
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Employee Id</th>
                    <th scope="col" class="sort" data-sort="name">Employee Name</th>
                    <th scope="col" class="sort" data-sort="name">Check-In</th>
                    <th scope="col" class="sort" data-sort="name">Break Start</th>
                    <th scope="col" class="sort" data-sort="name">Break End</th>
                    <th scope="col" class="sort" data-sort="name">Check-Out</th>
                  </tr>
                </thead>
                <tbody class="list" id='attendanceLists'>
                  @if(isset($attendances))
                    @foreach($attendances as $index=>$attendance)
                      <tr>
                        <td class="budget">
                          {{$attendance->user->id}}
                        </td>
                        <td class="budget">
                          {{$attendance->user->name}}
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