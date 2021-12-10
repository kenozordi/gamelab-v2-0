@extends('admin.layout.default')


@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/selects/select2.min.css">
@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Orders</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin">Admin</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Orders</a>
              </li>
              <li class="breadcrumb-item active">All
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-4 col-12">
        <div class="btn-group float-md-right">
          <button class="btn btn-success" data-toggle="modal" data-target="#addOrder">
            <i class="ft-plus"></i> Add
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

        <!-- List of orders -->
        <div class="col-xl-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Orders</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">

              <div class="table-responsive">
                <table class="table dtable table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Order No</th>
                      <th>Gamer</th>
                      <th>Total</th>
                      <th>Order Date</th>
                      <th>Add. Info</th>
                      <th>Reference</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                      <td><a href="{{url('/')}}/admin/order/{{$order->id}}">{{$order->order_no}}</a></td>
                      <td>{{$order->gamer_id}}</td>
                      <td>₦{{$order->total}}</td>
                      <td>{{$order->order_date}}</td>
                      <td>{{$order->additional_info}}</td>
                      <td>{{$order->system_ref}}</td>
                      <td>{{date('D jS M Y, h:i:sa', strtotime($order->created_at))}}</td>
                      <td>
                        @if($order->status == 0)
                        <span class="badge light badge-danger">Inactive</span>
                        @endif
                        @if($order->status == 1)
                        <span class="badge light badge-warning">Pending</span>
                        @endif
                        @if($order->status == 2)
                        <span class="badge light badge-success">Paid</span>
                        @endif
                        @if($order->status == 3)
                        <span class="badge light badge-danger">Failed</span>
                        @endif
                      </td>
                      <td>
                        @if($order->status == 1 || $order->status == 3)
                        <form action="{{url('/')}}/admin/order/pay/{{$order->id}}" method="post">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-success mr-1 mb-1">
                            <i class="ft-credit-card"></i> Pay
                          </button>
                        </form>
                        @else
                        <button disabled type="button" class="btn btn-sm btn-success mr-1 mb-1">
                          <i class="ft-credit-card"></i> Pay
                        </button>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- End List of orders -->
        </div>
      </div>

      <!--Begin modals-->

      <!-- Add order Modal -->
      <div class="modal fade text-left" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="addOrderLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success white">
              <label class="modal-title text-text-bold-600" id="addOrderLabel">Add new order</label>
              <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/')}}/admin/order/store" method="post">
              @csrf
              <div class="modal-body">
                <label>Gamer: </label>
                <div class="form-group">
                  <select name="gamer" class="hide-search form-control" style="width: 100%">
                    <option>None</option>
                    @foreach($gamers as $gamer)
                    <option value="{{$gamer->id}}">{{$gamer->username}}</option>
                    @endforeach
                  </select>
                </div>

                <label>Add. Info: </label>
                <div class="form-group">
                  <input name="additional_info" type="text" class="form-control" value="No info">
                </div>

                <label>Bookings: </label>
                <div class="form-group">
                  <select name="bookings[]" class="hide-search form-control" style="width: 100%" multiple="multiple">
                    @foreach($bookings as $booking)
                    <option value="{{$booking->id}}">{{$booking->game->title}} on {{$booking->client->machinename}} at {{$booking->start_time}}</option>
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
      <!-- End Add Game Modal -->

      <!--End modals-->

    </div>
  </div>
</div>

@endsection

@section('js')
<script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{asset('/admin-assets/app-assets')}}/js/scripts/forms/select/form-select2.js"></script>
@endsection