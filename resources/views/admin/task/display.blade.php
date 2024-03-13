@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tasks</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('tasks')}}">Tasks</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{url('tasks/create')}}" class="btn btn-sm btn-neutral">New</a>
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
              <h3 class="text-white mb-0">Task Table</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">#</th>
                    <th scope="col" class="sort" data-sort="name">Task Id</th>
                    <th scope="col" class="sort" data-sort="name">Task Name</th>
                    <th scope="col" class="sort" data-sort="name">Task Status</th>
                    <th scope="col" class="sort" data-sort="name">Event Name</th>
                    <th scope="col" class="sort" data-sort="name">Employee Name</th>
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
                          {{$task->status}}
                        </td>
                        <td class="budget">
                          {{$task->event->name}}
                        </td>
                        <td class="budget">
                          {{$task->user->name}}
                        </td>
                        <th scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <a href="{{url('tasks/'.$task->id.'/edit')}}" style='color:blue;'>
                                <i class="fas fa-edit"></i>
                              </a>
                            </div>  
                            <div class="media-body">
                            <form action="{{url('tasks/'.$task->id)}}" method='POST'>
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <button type='submit' style='color:white;border:none;background-color:transparent;'>
                                  <i class="fas fa-trash"></i>
                                </button>
                              </form>  
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
     @include('include.footer')
    </div>
  </div>
@endsection