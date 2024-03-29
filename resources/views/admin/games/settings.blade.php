@extends('admin.layout.default')


@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/toggle/bootstrap-switch.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/toggle/switchery.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/plugins/forms/switch.css">
@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Settings</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin">Admin</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Games</a>
              </li>
              <li class="breadcrumb-item active">Settings
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-4 col-12">
        <div class="btn-group float-md-right">
          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ft-plus"></i> Add
          </button>
          <div class="dropdown-menu arrow">
            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#addGenre"><i class="ft-anchor mr-1"></i>Genre</a>
            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#addGameMode"><i class="ft-users mr-1"></i>Mode</a>
            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#addPlayerPerspective"><i class="ft-camera mr-1"></i>Perspective</a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">

      <div class="row match-height">

        <!-- Errors -->
        @if ($errors->any())
        <div class="col-12">
          <div class="alert bg-danger alert-icon-left alert-dismissible mb-2 pt-2" role="alert">
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

        <!-- List of genres -->
        <div class="col-xl-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Genres</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a id="refreshGenre" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">

              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($genres as $genre)
                    <tr>
                      <td>{{$genre->name}}</td>
                      <td>
                        <form action="{{url('/')}}/admin/genre/toggle/{{$genre->id}}" method="post">
                          @csrf
                          <div class="float-left">
                            @if($genre->status == 1)
                            <input type="checkbox" checked="checked" class="switch" data-on-label="Active" data-off-label="Inactive" id="switch1" data-group-cls="btn-group-sm" onchange="$(this).closest('form').submit(); $('#refreshGenre').click(); return false;" />
                            @else
                            <input type="checkbox" class="switch" data-on-label="Active" data-off-label="Inactive" id="switch1" data-group-cls="btn-group-sm" onchange="$(this).closest('form').submit(); $('#refreshGenre').click(); return false;" />
                            @endif
                          </div>
                        </form>
                      </td>
                      <td>{{$genre->created_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!--End List of genres -->

        <!-- List of modes -->
        <div class="col-xl-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Game Modes</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a id="refreshMode" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">

              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Mode</th>
                      <th>Status</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($modes as $mode)
                    <tr>
                      <td>{{$mode->mode}}</td>
                      <td>
                        <form action="{{url('/')}}/admin/gameMode/toggle/{{$mode->id}}" method="post">
                          @csrf
                          <div class="float-left">
                            @if($mode->status == 1)
                            <input type="checkbox" checked="checked" class="switch" data-on-label="Active" data-off-label="Inactive" id="switch1" data-group-cls="btn-group-sm" onchange="$(this).closest('form').submit(); $('#refreshMode').click(); return false;" />
                            @else
                            <input type="checkbox" class="switch" data-on-label="Active" data-off-label="Inactive" id="switch1" data-group-cls="btn-group-sm" onchange="$(this).closest('form').submit(); $('#refreshMode').click(); return false;" />
                            @endif
                          </div>
                        </form>
                      </td>
                      <td>{{$mode->created_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!--End List of modes -->

        <!-- List of player perspective -->
        <div class="col-xl-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Player Perspectives</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a id="refreshPerspective" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">

              <div class="table-responsive">
                <table class="table dtable table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Perspective</th>
                      <th>Status</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($perspectives as $perspective)
                    <tr>
                      <td>{{$perspective->perspective}}</td>
                      <td>
                        <form action="{{url('/')}}/admin/playerPerspective/toggle/{{$perspective->id}}" method="post">
                          @csrf
                          <div class="float-left">
                            @if($perspective->status == 1)
                            <input type="checkbox" checked="checked" class="switch" data-on-label="Active" data-off-label="Inactive" id="switch1" data-group-cls="btn-group-sm" onchange="$(this).closest('form').submit(); $('#refreshPerspective').click(); return false;" />
                            @else
                            <input type="checkbox" class="switch" data-on-label="Active" data-off-label="Inactive" id="switch1" data-group-cls="btn-group-sm" onchange="$(this).closest('form').submit(); $('#refreshPerspective').click(); return false;" />
                            @endif
                          </div>
                        </form>
                      </td>
                      <td>{{$perspective->created_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!--End List of perspectives -->

      </div>
    </div>

    <!--Begin modals-->

    <!-- Genre Modal -->
    <div class="modal fade text-left" id="addGenre" tabindex="-1" role="dialog" aria-labelledby="addGenreLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success white">
            <label class="modal-title text-text-bold-600" id="addGenreLabel">Add new Genre</label>
            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{url('/')}}/admin/genre/store" method="post">
            @csrf
            <div class="modal-body">
              <label>Name: </label>
              <div class="form-group">
                <input name="name" type="text" placeholder="Action" class="form-control">
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
    <!--End Genre modals-->

    <!-- Game Mode Modal -->
    <div class="modal fade text-left" id="addGameMode" tabindex="-1" role="dialog" aria-labelledby="addGameModeModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success white">
            <label class="modal-title text-text-bold-600" id="addGameModeModal">Add new Game Mode</label>
            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{url('/')}}/admin/gameMode/store" method="post">
            @csrf
            <div class="modal-body">
              <label>Game Mode: </label>
              <div class="form-group">
                <input name="mode" type="text" placeholder="Single Player" class="form-control">
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
    <!--End Game Mode modal-->

    <!-- Player Perspective Modal -->
    <div class="modal fade text-left" id="addPlayerPerspective" tabindex="-1" role="dialog" aria-labelledby="addPlayerPerspectiveModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success white">
            <label class="modal-title text-text-bold-600" id="addPlayerPerspectiveModal">Add new Player Perspective</label>
            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{url('/')}}/admin/playerPerspective/store" method="post">
            @csrf
            <div class="modal-body">
              <label>Player Perspective: </label>
              <div class="form-group">
                <input name="perspective" type="text" placeholder="First Person" class="form-control">
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
    <!--End Player Perspective modal-->

    <!--End modals-->

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

@section('js')
<script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{asset('/admin-assets/app-assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/toggle/bootstrap-switch.min.js"></script>
<script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>
<script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/toggle/switchery.min.js"></script>
<script src="{{asset('/admin-assets/app-assets')}}/js/scripts/forms/switch.js"></script>
@endsection