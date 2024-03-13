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
                  <li class="breadcrumb-item"><a href="{{url('admin/employee')}}">Employee</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class='col-md-12 success alert-success' style='width:90%;margin:0 auto;'>
        @if($msg=Session::get('msg'))
        <p  style='padding:10px'>
          {{$msg}}
        </p>
        @endif
      </div> 
      @if ($errors->any())
        <div class="alert alert-danger" style='width:90%;'>
          <ul>
            @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif   
 </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Employee Profile</h4>
                </div>
                <div class="card-body">
                  <form action='{{url("admin/employee/".$employee->id)}}' method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" name='name' value="{{$employee->name}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="text" name='phoneNumber' value="{{$employee->phoneNumber}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" name='email' value="{{$employee->email}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Off Day</label>
                          <select name="offDay" id="offDay" class='form-control'>
                            @if($employee->offDay=='sunday')
                              <option value="sunday" selected>Sunday</option>
                              <option value="monday" >Monday</option>
                              <option value="tuesday" >Tuesday</option>
                              <option value="wednesday" >Wednesday</option>
                              <option value="thursday" >Thursday</option>
                              <option value="friday" >Friday</option>
                              <option value="saturday" >Saturday</option>
                            @elseif ($employee->offDay=='monday')
                              <option value="sunday">Sunday</option>
                              <option value="monday">Monday</option>
                              <option value="tuesday" selected>Tuesday</option>
                              <option value="wednesday" >Wednesday</option>
                              <option value="thursday" >Thursday</option>
                              <option value="friday" >Friday</option>
                              <option value="saturday" >Saturday</option>
                            @elseif ($employee->offDay=='tuesday')
                              <option value="sunday">Sunday</option>
                              <option value="monday" >Monday</option>
                              <option value="tuesday" selected >Tuesday</option>
                              <option value="wednesday" >Wednesday</option>
                              <option value="thursday" >Thursday</option>
                              <option value="friday" >Friday</option>
                              <option value="saturday" >Saturday</option>
                            @elseif ($employee->offDay=='wednesday')
                              <option value="sunday">Sunday</option>
                              <option value="monday" >Monday</option>
                              <option value="tuesday"  >Tuesday</option>
                              <option value="wednesday" selected >Wednesday</option>
                              <option value="thursday" >Thursday</option>
                              <option value="friday" >Friday</option>
                              <option value="saturday" >Saturday</option>
                            @elseif ($employee->offDay=='thursday')
                              <option value="sunday">Sunday</option>
                              <option value="monday" >Monday</option>
                              <option value="tuesday"  >Tuesday</option>
                              <option value="wednesday">Wednesday</option>
                              <option value="thursday" selected >Thursday</option>
                              <option value="friday" >Friday</option>
                              <option value="saturday" >Saturday</option>
                            @elseif ($employee->offDay=='friday')
                              <option value="sunday">Sunday</option>
                              <option value="monday" >Monday</option>
                              <option value="tuesday"  >Tuesday</option>
                              <option value="wednesday">Wednesday</option>
                              <option value="thursday"  >Thursday</option>
                              <option value="friday" selected>Friday</option>
                              <option value="saturday" >Saturday</option>
                            @elseif ($employee->offDay=='saturday')
                              <option value="sunday">Sunday</option>
                              <option value="monday" >Monday</option>
                              <option value="tuesday"  >Tuesday</option>
                              <option value="wednesday">Wednesday</option>
                              <option value="thursday"  >Thursday</option>
                              <option value="friday" >Friday</option>
                              <option value="saturday" selected>Saturday</option>
                            @else
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Payment Day</label>
                          <input type="number" max=31 min=0 name='payDay' value="{{$employee->payDay}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Role</label>
                          <select name="role" id="role" class='form-control'>
                            <option value="admin">Admin</option>
                            <option value="employee" selected>Employee</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" name='password' class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Start Time</label>
                          <input type="time" name='startTime' value="{{$employee->startTime}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">End Time</label>
                          <input type="time" name='endTime' value="{{$employee->endTime}}" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
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
  </div>
@endsection