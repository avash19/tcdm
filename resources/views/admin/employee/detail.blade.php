@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Employee</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a>{{$title}}</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <!-- <a href="{{url('admin/employee/create')}}" class="btn btn-sm btn-neutral">New</a> -->
              <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
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
            <div class="card-header border-0">
              <h3 class="text-black mb-0">Employee Attendance</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">#</th>
                    <th scope="col" class="sort" data-sort="name">Employee Name</th>
                    <th scope="col" class="sort" data-sort="budget">Check In</th>
                    <th scope="col" class="sort" data-sort="budget">Break Start</th>
                    <th scope="col" class="sort" data-sort="budget">Break End</th>
                    <th scope="col" class="sort" data-sort="budget">Check Out</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @if(isset($activeEmployees) || isset($breakEmployees))
                    <?php
                      if($activeEmployees)
                        $employees=$activeEmployees;
                      else
                        $employees=$breakEmployees;
                    ?>
                    @foreach($employees as $index=>$attendance)
                      <tr>
                        <td class="budget">
                          {{$index+1}}
                        </td>
                        <th scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <span class="name mb-0 text-sm">{{$attendance->user->name}}</span>
                            </div>
                          </div>
                        </th>
                        <td class="budget">
                          {{$attendance->checkIn}}
                        </td>
                        <td class="budget">
                          {{$attendance->breakStart?$attendance->breakStart:'N/A'}}
                        </td>
                        <td class="budget">
                          {{$attendance->breakEnd?$attendance->breakEnd:'N/A'}}
                        </td>
                        <td class="budget">
                          {{$attendance->checkOut?$attendance->checkOut:'N/A'}}
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