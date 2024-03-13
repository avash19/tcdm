@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Client</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('clients')}}">Client</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Client</li>
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
              <div   class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add New Client</h4>
                </div>
                <div class="card-body">
                  <form action='{{url("clients")}}' method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" name='name' class="form-control" value="{{old('name')}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Facebook Page Link</label>
                          <input type="text" name='facebookPageLink' class="form-control"  value="{{old('facebookPageLink')}}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" name='email' class="form-control"  value="{{old('email')}}">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Add New Client</button>
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