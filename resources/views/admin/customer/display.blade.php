@extends('include.layout')
@section('content')
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Client Customer</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{url('customers')}}">Client Customer</a></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{url('customers/create')}}" class="btn btn-sm btn-neutral">New</a>
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
              <h3 class="text-white mb-0">Customer Customer Table</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">#</th>
                    <th scope="col" class="sort" data-sort="name">Customer Id</th>
                    <th scope="col" class="sort" data-sort="name">Client Name</th>
                    <th scope="col" class="sort" data-sort="name">Customer Name</th>
                    <th scope="col" class="sort" data-sort="budget">Phone Number</th>
                    <th scope="col" class="sort" data-sort="budget">Email</th>
                    <th scope="col" class="sort" data-sort="status">Address</th>
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
                        <td class="budget">
                          {{$customer->client->name}}
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
      </div>
     @include('include.footer')
    </div>
  </div>
@endsection