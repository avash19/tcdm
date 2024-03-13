@extends('include.layout')
@section('content') 
  <div class="main-content" id="panel">
    
    <!-- Header -->
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello {{auth()->user()->name}}</h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your profile information.</p>
          </div>
          @if($msg=Session::get('msg'))
            <div class='col-md-12 success alert-success' style='width:90%;margin:0 auto;'>
              <p  style='padding:10px'>
                {{$msg}}
              </p>
            </div> 
          @endif
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
      </div>
    </div>
    
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    @if(auth()->user()->role=='admin')
                      <img src="../assets/img/theme/admin.png" class="rounded-circle">
                    @else
                      <img src="../assets/img/theme/employee.png" class="rounded-circle">
                    @endif
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  {{auth()->user()->name}}<span class="font-weight-light"></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>{{auth()->user()->address}}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Role- {{ucfirst(auth()->user()->role)}}
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>{{auth()->user()->email}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
                <div class="col-4 text-right">
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="{{url('profile')}}" method="POST">
                {{method_field('PUT')}}
                {{@csrf_field()}}
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Name</label>
                        <input type="text" id="input-username" class="form-control" placeholder="Name" name="name" value="{{auth()->user()->name}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" name='email' class="form-control" value="{{auth()->user()->email}}">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-phone">Phone Number</label>
                        <input id="input-phone" class="form-control" name="phoneNumber" placeholder="Phone Number" value="{{auth()->user()->phoneNumber}}" type="number">
                      </div>
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
      <!-- Footer -->
      @include('include.footer')
    </div>
  </div>
  @endsection