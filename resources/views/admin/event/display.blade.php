@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Events</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('events')}}">Events</a></li>
                </ol>
              </nav>
              @if(auth()->user()->role=='admin')
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class='breadcrumb'>
                    <li class="breadcrumb-item"><a onclick="getEvents('thismonth');" style='cursor:pointer;'>Event Of This Month</a></li>
                  </ol>
                </nav>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class='breadcrumb'>
                    <li class="breadcrumb-item"><a onclick="getEvents('previous');" style='cursor:pointer;'>Previous Events</a></li>
                  </ol>
                </nav>
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
        <div class="col-md-12 row">
          <div class="col-xl-3 col-md-4">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <a onclick="getEvents('active');" style='cursor:pointer;'>
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Active Event</h5>
                      <span class="h2 font-weight-bold mb-0">{{$totalActiveEvents}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-check-bold"></i>
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
          @if(auth()->user()->role=='admin')
            <div class="col-xl-1"></div>
            <div class="col-xl-3 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <a onclick="getEvents('current-upcoming');" style='cursor:pointer;'>
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Events</h5>
                        <span class="h2 font-weight-bold mb-0">{{$totalEvents}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
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
            <div class="col-xl-1"></div>
            <div class="col-xl-3 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <a href="{{url('events/create')}}" style='cursor:pointer;'>
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Create New Event</h5>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-fat-add"></i>
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
          @endif
        </div>
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0" id='event-title-name'>Active Events Table</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Event Id</th>
                    <th scope="col" class="sort" data-sort="name">Event Name</th>
                    <th scope="col" class="sort" data-sort="status">Start Date</th>
                    <th scope="col" class="sort" data-sort="status">End Date</th>
                    @if(auth()->user()->role=='admin')
                      <th scope="col" class="sort" data-sort="status">Actions</th>
                    @endif
                  </tr>
                </thead>
                <tbody class="list" id='events-lists'>
                  @if(isset($activeEvents))
                    @foreach($activeEvents as $event)
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
                        <td class="budget">
                          {{$event->startDate}}
                        </td>
                        <td class="budget">
                          {{$event->endDate}}
                        </td>
                        @if(auth()->user()->role=='admin')
                          <th scope="row">
                            <div class="media align-items-center">
                              <div class="media-body">
                                <a href="{{url('events/'.$event->id.'/edit')}}" style='color:blue;'>
                                  <i class="fas fa-edit text-dark"></i>
                                </a>
                              </div>  
                              <div class="media-body">
                                <button type="button"  style='color:white;border:none;background-color:transparent;' data-toggle="modal" data-target="#event-{{$event->id}}">
                                  <i class="fas fa-trash text-warning"></i>
                                </button>
                                <div class="modal fade" id="event-{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="event-{{$event->id}}Label" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Event of Id {{$event->id}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-footer">
                                        <form action="{{url('events/'.$event->id)}}" method='POST'>
                                          {{method_field('DELETE')}}
                                          {{ csrf_field() }}
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-primary">Delete Now</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </th>
                        @endif
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
