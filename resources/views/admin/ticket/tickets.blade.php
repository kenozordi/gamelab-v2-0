@extends('admin.layout.default')


@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/selects/select2.min.css">
@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Tickets</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin">Admin</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Tickets</a>
              </li>
              <li class="breadcrumb-item active">All
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-4 col-12">
        <div class="btn-group float-md-right">
          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="icon-settings"></i>
          </button>
          <div class="dropdown-menu arrow">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addTicket"><i class="fa fa-plus mr-1"></i> Add</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/admin/games/settings"><i class="fa fa-cog mr-1"></i> Settings</a>
          </div>
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

        <!-- List of tickets -->
        <div class="col-xl-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Tickets</h4>
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
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Ticket Type</th>
                      <th>Booking</th>
                      <th>Order</th>
                      <th>Game Pass Issued</th>
                      <th>Created At</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                      <td>{{$ticket->ticket_type->type}}</td>
                      <td>{{$ticket->booking->reference}}</td>
                      <td>{{$ticket->order->order_no}}</td>
                      <td>
                        @if($ticket->game_pass_issued == 1)
                        <span class="badge light badge-success"><i class="fa fa-check"></i></span>
                        @else
                        <span class="badge light badge-danger"><i class="fa fa-times"></i></span>
                        @endif
                      </td>
                      <td>{{date('D jS M Y, h:i:sa', strtotime($ticket->created_at))}}</td>
                      <td>
                        @if($ticket->status == 1)
                        <span class="badge light badge-success">Active</span>
                        @else
                        <span class="badge light badge-danger">Inactive</span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- End List of tickets -->
        </div>
      </div>

      <!--Begin modals-->

      <!-- Add ticket Modal -->
      <div class="modal fade text-left" id="addTicket" tabindex="-1" role="dialog" aria-labelledby="addTicketLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success white">
              <label class="modal-title text-text-bold-600" id="addTicketLabel">Add new ticket</label>
              <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/')}}/admin/ticket/store" method="post">
              @csrf
              <div class="modal-body">
                <label>Gamer: </label>
                <div class="form-group">
                  <input name="gamer" type="text" placeholder="192.168.1.30" class="form-control">
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