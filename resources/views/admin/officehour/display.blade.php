@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Office Hours</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('officehours')}}">Office Hours</a></li>
                </ol>
              </nav>
            </div>
            
            <div class="col-lg-6 col-5 text-right">
              @if(isset($officeHours) && count($officeHours)==0)
                <a href="{{url('officehours/create')}}" class="btn btn-sm btn-neutral">New</a>
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
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">Events Table</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Office Time Id</th>
                    <th scope="col" class="sort" data-sort="name">Start Time</th>
                    <th scope="col" class="sort" data-sort="status">End Time</th>
                    <th scope="col" class="sort" data-sort="status">Actions</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @if(isset($officeHours))
                    @foreach($officeHours as $officeHour)
                      <tr>
                        <td class="budget">
                          {{$officeHour->id}}
                        </td>
                        <td scope="row">
                          {{$officeHour->startTime}}
                        </td>
                        <td class="budget">
                          {{$officeHour->endTime}}
                        </td>
                        <th scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <a href="{{url('officehours/'.$officeHour->id.'/edit')}}" style='color:blue;'>
                                <i class="fas fa-edit text-dark"></i>
                              </a>
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
