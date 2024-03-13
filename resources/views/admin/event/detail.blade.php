@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Events</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item">{{$eventTitle}}-{{$eventTask}}</li>
                </ol>
              </nav>
            </div>
            
            <div class="col-lg-6 col-5 text-right">
              <!-- <a href="{{url('events/create')}}" class="btn btn-sm btn-neutral">New</a> -->
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
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Events Table</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Event Id</th>
                    <th scope="col" class="sort" data-sort="name">Event Name</th>
                    <th scope="col" class="sort" data-sort="status" style='text-align:center;'>Assign Employee</th>
                  </tr>
                </thead>
                <tbody class="list" id='events-lists'>
                  @if(isset($events))
                    @foreach($events as $event)
                      <tr>
                        <td class="budget">
                          {{$event->id}}
                        </td>
                        <th scope="row">
                          <div class="media align-items-center">
                          <?php
                            if($event->client->facebookPageLink){
                          ?>
                            <a href="<?php echo $event->client->facebookPageLink?>" target="_blank">
                              <?php echo $event->name?>
                            </a>
                          <?php
                            }
                            else{
                              echo $event->name;
                            }
                          ?>
                          </div>
                        </th>
                        <td class="budget" style='display:flex;justify-content:space-evenly;'>
                          <form action="{{url('events/'.$event->id.'/'.strtolower($eventTask))}}" method='POST' style='display:flex;justify-content:space-between;'>
                           {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <select name="userId" id="userId" class='form-control'>
                              <option  value="" disabled selected>Select User</option>
                              @if(isset($employees))
                                @foreach($employees as $employee)
                                  @if($employee->id==$event->employeeId)
                                    <option value="{{$employee->id}}" selected>{{$employee->name}}</option>
                                  @else
                                   <option value="{{$employee->id}}">{{$employee->name}}</option>
                                  @endif
                                @endforeach
                              @endif
                            </select>
                            <button type='submit' style='margin-left:10px;' class='btn btn-large btn-light'>Assign</button>
                          </form>
                          @if($eventTitle =='Assigned Task')
                            <form action="{{url('events/unassign/'.$event->id.'/'.$event->employeeId)}}" method='POST'>
                              {{method_field('PUT')}}
                              <input type="hidden" value='{{$eventTitle}}' name='eventTitle'>
                              <input type="hidden" value='{{$eventTask}}' name='eventTask'>
                              {{csrf_field()}}
                              <button class='btn btn-danger'>Unassign</button>
                            </form>
                          @endif
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
