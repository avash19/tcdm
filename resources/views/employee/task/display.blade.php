@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tasks</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-light">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('employee/tasks')}}">Tasks</a></li>
                </ol>
              </nav>
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
      <!-- light table -->
      <div class="row">
        @if(isset($todaysEvents) && count($todaysEvents)>0)
          <div class="col">
            <div class="card bg-default shadow">
              <div class="card-header bg-transparent border-0">
                <h3 class="text-white mb-0">
                  Today's Task
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
                      @foreach($todaysEvents as $index=>$event)
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
                                <form action="{{url('employee/events/'.$event->id)}}" method='POST'>
                                  <a href="{{url('employee/events/'.$event->id.'/edit')}}" style='color:blue;'>
                                    <i class="fas fa-edit"></i>
                                  </a>
                                </form>
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
        @if(isset($events) && count($events)>0)
          @for($i=0;$i<=3;$i++)
            @if($i==0)
            <p style='display:none'> {{$title='Comment Task'}} </p>
            @elseif($i==1)
            <p style='display:none'> {{$title='Message Task'}} </p>
            @elseif($i==2)
            <p style='display:none'>  {{$title='Calender and SpreadSheet Task'}} </p>
            @else
            <p style='display:none'> {{$title='FollowUp Task'}} </p>
            @endif
            <div class="col">
              <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                  <h3 class="text-white mb-0">
                    {{$title}}
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
                        @foreach($events as $index=>$event)
                          @if($i==0 && $event->commentId==auth()->user()->id)
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
                                    <a href="{{url('employee/events/0/'.$event->id.'/edit')}}" style='color:blue;'>
                                      <i class="fas fa-edit"></i>
                                    </a>
                                  </div>  
                                  <div class="media-body">
                                    <a href="{{url('employee/events/rejects/0/'.$event->id)}}" style='color:blue;'>
                                      <button class="btn btn-danger">Unassign</button>
                                    </a>
                                </div>  
                                </div>
                              </th>
                            </tr>
                          @endif

                          @if($i==1 && $event->messageId==auth()->user()->id)
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
                                      <a href="{{url('employee/events/1/'.$event->id.'/edit')}}" style='color:blue;'>
                                        <i class="fas fa-edit"></i>
                                      </a>
                                  </div>  
                                  <div class="media-body">
                                    <a href="{{url('employee/events/rejects/1/'.$event->id)}}" style='color:blue;'>
                                      <button class="btn btn-danger">Unassign</button>
                                      <!-- <i class="fas fa-reject"></i> -->
                                    </a>
                                </div>  
                                </div>
                              </th>
                            </tr>
                          @endif
                        
                          @if($i==2 && $event->calendarSpreadId==auth()->user()->id)
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
                                      <a href="{{url('employee/events/2/'.$event->id.'/edit')}}" style='color:blue;'>
                                        <i class="fas fa-edit"></i>
                                      </a>
                                  </div>  
                                  <div class="media-body">
                                    <a href="{{url('employee/events/rejects/2/'.$event->id)}}" style='color:blue;'>
                                      <button class="btn btn-danger">Unassign</button>
                                      <!-- <i class="fas fa-reject"></i> -->
                                    </a>
                                </div>  
                                </div>
                              </th>
                            </tr>
                          @endif

                          @if($i==3 && $event->followUpId==auth()->user()->id)
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
                                      <a href="{{url('employee/events/3/'.$event->id.'/edit')}}" style='color:blue;'>
                                        <i class="fas fa-edit"></i>
                                      </a>
                                  </div>  
                                  <div class="media-body">
                                    <a href="{{url('employee/events/rejects/3/'.$event->id)}}" style='color:blue;'>
                                      <button class="btn btn-danger">Unassign</button>
                                    </a>
                                </div>  
                                </div>
                              </th>
                            </tr>
                          @endif
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endfor
        @endif
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