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
                  <li class="breadcrumb-item"><a href="{{url('clients')}}">Clients</a></li>
                  <li class="breadcrumb-item"><a>Client Details</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{url('events/create/'.$client->id)}}" class="btn btn-sm btn-neutral">New Event</a>
              <a href="{{url('customers/create/'.$client->id)}}" class="btn btn-sm btn-neutral">New Customer</a>
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
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="../assets/img/theme/employee.png" class="rounded-circle">
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
                  {{$client->name}}<span class="font-weight-light"></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>{{$client->address}}
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Status- {{$client->status}}
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>{{$client->email}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Dark table -->
        <div class="col-xl-8 order-xl-2">
          <div class="col">
            <div class="card bg-default shadow">
              <div class="card-header border-0">
                <h3 class="text-black mb-0">Customer Table</h3>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-light table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" class="sort" data-sort="name">#</th>
                      <th scope="col" class="sort" data-sort="name">Customer Id</th>
                      <th scope="col" class="sort" data-sort="name">Customer Name</th>
                      <th scope="col" class="sort" data-sort="name">Customer Phone Number</th>
                      <th scope="col" class="sort" data-sort="budget">Customer Email</th>
                      <th scope="col" class="sort" data-sort="status">Customer Address</th>
                      <th scope="col" class="sort" data-sort="status">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    @if(isset($customers))
                      @foreach($customers as $index=>$customer)
                        <tr>
                          <td class="budget">
                            {{$index+1}}
                          </td>
                          <td class="budget">
                            {{$customer->id}}
                          </td>
                          <th scope="row">
                            <div class="media align-items-center">
                              <div class="media-body">
                                <span class="name mb-0 text-sm">{{$customer->name}}</span>
                              </div>
                            </div>
                          </th>
                          <td class="budget">
                            {{$customer->phoneNumber}}
                          </td>
                          <td class="budget">
                            {{$customer->email}}
                          </td>
                          <td class="budget">
                            {{$customer->address}}
                          </td>
                          <th scope="row">
                            <div class="media align-items-center">
                              <div class="media-body">
                                <a href="{{url('customers/'.$customer->id.'/edit')}}" style='color:blue;'>
                                  <i class="fas fa-edit"></i>
                                </a>
                              </div>  
                              
                              <div class="media-body">
                                <button type="button"  style='color:white;border:none;background-color:transparent;' data-toggle="modal" data-target="#customer-{{$customer->id}}">
                                  <i class="fas fa-trash text-warning"></i>
                                </button>
                                <div class="modal fade" id="customer-{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="customer-{{$customer->id}}Label" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Customer of Id {{$customer->id}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-footer">
                                        <form action="{{url('customers/'.$customer->id)}}" method='POST'>
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
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card bg-default shadow">
              <div class="card-header border-0" style='display:flex;justify-content:space-between;'>
                <h3 class="text-black mb-0">Events Table</h3>
                <select id='set-filter-date' class="form-select form-select-sm custom-select w-auto" aria-label=".form-select-sm example" onChange='handleFilter(this.value)'>
                  <option value='0'selected>Filter By Date</option>
                </select>
              </div>
              
              <div class="table-responsive">
              <table class="table align-items-center table-light table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">#</th>
                    <th scope="col" class="sort" data-sort="name">Event Id</th>
                    <th scope="col" class="sort" data-sort="name">Event Name</th>
                    <th scope="col" class="sort" data-sort="status">Start Date</th>
                    <th scope="col" class="sort" data-sort="status">End Date</th>
                    <th scope="col" class="sort" data-sort="status">Actions</th>
                  </tr>
                </thead>
                <tbody class="list" id='event-lists'>
                  @if(isset($events))
                    @foreach($events as $index=>$event)
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
                              <a href="{{url('events/'.$event->id.'/edit')}}" style='color:blue;'>
                                <i class="fas fa-edit"></i>
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
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
     @include('include.footer')
    </div>
  </div>
@endsection