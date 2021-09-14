@extends('admin.layout.default')


@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Clients</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin">Admin</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Clients</a>
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
            <a class="dropdown-item" href="#"><i class="fa fa-plus mr-1"></i> Add</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fa fa-cog mr-1"></i> Settings</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">

      <!-- Recent invoice with Statistics -->
      <div class="row match-height">
        <!-- List of clients -->
        <div class="col-xl-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Clients</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>IP address</th>
                      <th>Created At</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($clients as $client)
                    <tr>
                      <td>{{$client->machinename}}</td>
                      <td>{{$client->ipaddress}}</td>
                      <td>{{$client->created_at}}</td>
                      <td>
                        @if($client->status == 1)
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
        </div>
      </div>
      <!-- Recent invoice with Statistics -->

      <!--CLNDR Wrapper-->
      <div id="clndr" class="clearfix">
        <script type="text/template" id="clndr-template">
          <div class="clndr-controls">
                <div class="clndr-previous-button">&lt;</div>
                <div class="clndr-next-button">&gt;</div>
                <div class="current-month">
                    <%= month %>
                        <%= year %>
                </div>
            </div>
            <div class="clndr-grid">
                <div class="days-of-the-week clearfix">
                    <% _.each(daysOfTheWeek, function(day) { %>
                        <div class="header-day">
                            <%= day %>
                        </div>
                        <% }); %>
                </div>
                <div class="days">
                    <% _.each(days, function(day) { %>
                        <div class="<%= day.classes %>" id="<%= day.id %>"><span class="day-number"><%= day.day %></span></div>
                        <% }); %>
                </div>
            </div>
            <div class="event-listing">
                <div class="event-listing-title">Project meetings</div>
                <% _.each(eventsThisMonth, function(event) { %>
                    <div class="event-item font-small-3">
                        <div class="event-item-day font-small-2">
                            <%= event.date %>
                        </div>
                        <div class="event-item-name text-bold-600">
                            <%= event.title %>
                        </div>
                        <div class="event-item-location">
                            <%= event.location %>
                        </div>
                    </div>
                    <% }); %>
            </div>
        </script>
      </div>
      <!--/CLNDR Wrapper -->

    </div>
  </div>
</div>

@endsection