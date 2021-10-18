@extends('admin.layout.default')


@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/selects/select2.min.css">
@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">#{{$order->order_no}}</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin">Admin</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Orders</a>
              </li>
              <li class="breadcrumb-item active">{{$order->order_no}}
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-4 col-12">
        <div class="btn-group float-md-right">
          <button class="btn btn-success" data-toggle="modal" data-target="#payOrder">
            <i class="ft-plus"></i> Pay
          </button>
        </div>
      </div>
    </div>
    <div class="content-body">

      <div class="row match-height">

        <!-- Errors -->
        @if ($errors->any())
        <div class="col-12">
          <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="fa fa-thumbs-o-down"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <ul>
              @foreach ($errors->all() as $error)
              <li><strong>{{ $error }}</strong></li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
        <!-- End Errors -->

        <!-- List of bookings -->
        <div class="col-md-8 order-md-2 mb-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Bookings</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><span class="badge badge-danger badge-pill mr-1">Total: <b>{{count($order->bookings)}}</b></span></li>
                  <li>
                    <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="modal" title="add booking" data-target="#addBooking">
                      <i class="ft-plus white"></i>
                    </button>
                    <!-- Add booking Modal -->
                    <div class="modal fade text-left" id="addBooking" tabindex="-1" role="dialog" aria-labelledby="addBookingLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-success white">
                            <label class="modal-title text-text-bold-600" id="addBookingLabel">Add new booking</label>
                            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('/')}}/admin/booking/store" method="post">
                            @csrf
                            <input hidden name="order_no" value="{{$order->order_no}}">
                            <div class="modal-body">
                              <label>Gamer: </label>
                              <div class="form-group">
                                <select name="gamer_id" class="hide-search form-control" style="width: 100%">
                                  <option value="0">None</option>
                                  @foreach($gamers as $gamer)
                                  @if($gamer->status == 1)
                                  <option value="{{$gamer->id}}">{{$gamer->username}}</option>
                                  @endif
                                  @endforeach
                                </select>
                              </div>

                              <label>Duration: </label>
                              <div class="form-group">
                                <input name="duration" disabled type="text" placeholder="30 mins" class="form-control">
                              </div>

                              <label>Start time: </label>
                              <div class="form-group">
                                <input name="start_time" type="datetime-local" class="form-control">
                              </div>

                              <label>Client: </label>
                              <div class="form-group">
                                <select name="client_id" class="hide-search form-control" style="width: 100%">
                                  @foreach($clients as $client)
                                  @if($client->status == 1)
                                  <option value="{{$client->id}}">{{$client->machinename}}</option>
                                  @endif
                                  @endforeach
                                </select>
                              </div>

                              <label>Game: </label>
                              <div class="form-group">
                                <select name="game_id" class="hide-search form-control" style="width: 100%">
                                  @foreach($games as $game)
                                  @if($game->status == 1)
                                  <option value="{{$game->id}}">{{$game->title}}</option>
                                  @endif
                                  @endforeach
                                </select>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <input type="reset" class="btn btn-secondary btn-lg" data-dismiss="modal" value="close">
                              <input type="submit" class="btn btn-success btn-lg" value="Submit">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Add Booking Modal -->
                  </li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>

            <!-- Add Existing Booking:  -->
            <div class="card-body">
              <form action="{{url('/')}}/admin/order/store" method="post">
                @csrf
                <input hidden name="order_no" value="{{$order->order_no}}">

                <div class="input-group justify-content-center">
                  <select name="bookings[]" class="hide-search form-control" style="width: 80%">
                    <option>Add existing booking</option>
                    @foreach($bookings as $booking)
                    @if($booking->status == 1)
                    <option value="{{$booking->id}}">{{$booking->game->title}} on {{$booking->client->machinename}} at {{$booking->start_time}}</option>
                    @endif
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-success" type="submit"><i class="fa fa-arrow-right"></i></button>
                  </div>
                </div>
              </form>
            </div>

            <hr />

            <div class="card-content collapse show">
              <div class="list-group list-group-flush mb-2">
                @foreach($order->bookings as $booking)
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="text-bold-600">{{$booking->game->title}}</h5>
                    <div>
                      <form action="{{url('/')}}/admin/booking/delete/{{$booking->id}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" type="submit" value="Submit"><i class="fa fa-trash"></i></button>
                      </form>
                    </div>
                  </div>
                  <p>{{$booking->client->machinename}}</p>
                  <div class="d-flex justify-content-between">
                    <small class="">Start: {{$booking->start_time}}</small>
                    <small class="h5 text-bold-600">₦{{$booking->amount}}</small>
                  </div>
                  <div class="d-block">
                    <small>Expires: {{$booking->expires_at}}</small>
                  </div>
                </a>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                  <span>Total (NGN)</span>
                  <!-- <strong class="text-success">₦{{$order->total}}</strong> -->
                  <strong class="text-success">₦{{$order->total}}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-end">
                  <form action="{{url('/')}}/admin/order/pay/{{$order->id}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success">
                      <i class="ft-credit-card"></i> Pay
                    </button>
                  </form>
                </li>
              </div>
            </div>
          </div>

          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4 order-md-1">
          <!-- order details -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Order Info.</h4>
            </div>
            <div class="card-content">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <span class="float-right">{{$order->additional_info}}</span>
                  Additional Info:
                </li>
                <li class="list-group-item">
                  <span class="float-right">{{$order->order_date}}</span>
                  Payment Date:
                </li>
                <li class="list-group-item">
                  @if($order->status == 1)
                  <span class="badge badge-default bg-warning float-right">Pending</span>
                  @elseif($order->status == 2)
                  <span class="badge badge-default bg-success float-right">Paid</span>
                  @elseif($order->status == 3)
                  <span class="badge badge-default bg-danger float-right">Failed</span>
                  @else
                  <span class="badge badge-default bg-danger float-right">Inactive</span>
                  @endif
                  Status:
                </li>
              </ul>
            </div>
          </div>

          <!-- Gamer details -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Gamer Info.</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              @if($order->gamer)
              <div class="text-center">
                <div class="card-body">
                  <img src="{{asset('/admin-assets/app-assets')}}/images/portrait/medium/avatar-m-4.png" class="rounded-circle  height-150" alt="Card image">
                </div>
                <div class="card-body">
                  <h4 class="card-title">{{$order->gamer->email}}</h4>
                  <h6 class="card-subtitle text-muted">{{$order->gamer->phone}}</h6>
                </div>
                <div class="text-center">
                  <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="fa fa-facebook"></span></a>
                  <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="fa fa-twitter"></span></a>
                  <a href="#" class="btn btn-social-icon mb-1 btn-outline-linkedin"><span class="fa fa-linkedin font-medium-4"></span></a>
                </div>
              </div>
              @else
              <div class="card-body">
                <form action="{{url('/')}}/admin/gamer/store" method="post">
                  @csrf
                  <label>Email: </label>
                  <div class="form-group">
                    <input type="email" name="email" class="form-control">
                  </div>

                  <label>Fullname: </label>
                  <div class="form-group mb-0">
                    <input type="text" name="fullname" class="form-control">
                  </div>
                  <small>Create new gamer</small>

                  <div class="d-flex justify-content-end">
                    <input type="submit" class="btn btn-success" value="Submit">
                  </div>
                </form>
              </div>
              @endif
              <hr />

              <div class="card-body">
                <form action="{{url('/')}}/admin/order/addGamerToOrder" method="post">
                  @csrf
                  <input hidden name="order_id" value="{{$order->id}}">

                  <label>Change Gamer: </label>
                  <div class="input-group">
                    <select name="gamer_id" class="hide-search form-control" style="width: 80%">
                      @foreach($gamers as $gamer)
                      @if($gamer->status == 1)
                      <option value="{{$gamer->id}}">{{$gamer->email}}</option>
                      @endif
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-success" type="submit"><i class="fa fa-arrow-right"></i></button>
                    </div>
                  </div>
                  <small class="d-block">Choose existing gamer</small>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Begin modals-->

      <!-- Make Payment Modal -->
      <div class="modal fade text-left" id="payOrder" tabindex="-1" role="dialog" aria-labelledby="payOrderLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success white">
              <label class="modal-title text-text-bold-600" id="payOrderLabel">Pay for order</label>
              <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/')}}/admin/order/pay/{{$order->id}}" method="post">
              @csrf
              <div class="modal-body">
                <label>Add. Info: </label>
                <div class="form-group">
                  <input name="additional_info" type="text" class="form-control" value="No info">
                </div>
              </div>

              <div class="modal-footer">
                <input type="reset" class="btn btn-secondary btn-lg" data-dismiss="modal" value="close">
                <input type="submit" class="btn btn-success btn-lg" value="Submit">
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Make payment Modal -->

      <!--End modals-->

    </div>
  </div>
</div>

@endsection

@section('js')
<script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{asset('/admin-assets/app-assets')}}/js/scripts/forms/select/form-select2.js"></script>
@endsection