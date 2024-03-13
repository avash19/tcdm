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
                  <li class="breadcrumb-item"><a href="{{url('events')}}">Events</a></li>
                  <li class="breadcrumb-item"><a>Assign Task</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <!-- <a href="{{url('events/create')}}" class="btn btn-sm btn-neutral">New</a> -->
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
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Assign Event</h4>
                </div>
                <div class="card-body">
                  <form id='formDatas'>
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Event Employee</label>
                          <select name="userId" id="userId" class='form-control'>
                            <option disabled selected>Choose Employee</option>
                            @if(isset($employees))
                              @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                              @endforeach
                            @endif                          
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Choose Task</label>
                          <select name="taskName" id="taskName" class='form-control' onchange='getTaskForEvent(this.value)'>
                            <option disabled selected>Choose Task</option>
                              <option value="comment">Commenting</option>
                              <option value="message">Messaging</option>
                              <option value="calendar and spreadsheet">Calendar and Spreadsheet</option>
                              <option value="followup">Follow Up</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Choose Event</label>
                          <select name="" id="eventLists" multiple class='form-control' onchange='handleClick(this)'>
                            <option disabled selected>Choose Event</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Selected Event</label>
                          <select name="events[]" id="selectedEvents" multiple class='form-control' onchange='returnEvent(this)'>
                            <option value='' selected disabled>Selected Events</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" onclick='submitTasks();'>Assign Event Tasks</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('include.footer')
    </div>
@endsection