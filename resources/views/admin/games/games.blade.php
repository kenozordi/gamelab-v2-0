@extends('admin.layout.default')


@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/selects/select2.min.css">
@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">Games</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin">Admin</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Games</a>
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
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addGame"><i class="fa fa-plus mr-1"></i> Add</a>
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

        <!-- List of games -->
        <div class="col-xl-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Games</h4>
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
                      <th>Title</th>
                      <th>Description</th>
                      <th>Genre</th>
                      <th>Mode</th>
                      <th>Max Players</th>
                      <th>Perspective</th>
                      <th>Rating</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($games as $game)
                    <tr>
                      <td>{{$game->title}}</td>
                      <td>{{substr($game->description, 0, 20)}} ...</td>
                      <td>{{$game->genre->name}}</td>
                      <td>{{$game->game_mode->mode}}</td>
                      <td>{{$game->max_players}}</td>
                      <td>{{$game->player_perspective->perspective}}</td>
                      <td>{{$game->rating}}</td>
                      <td>
                        @if($game->status == 1)
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
      <!--End List of games -->

      <!--Begin modals-->

      <!-- Add Game Modal -->
      <div class="modal fade text-left" id="addGame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success white">
              <label class="modal-title text-text-bold-600" id="myModalLabel33">Add new Game</label>
              <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/')}}/admin/games/store" method="post">
              @csrf
              <div class="modal-body">
                <label>Title: </label>
                <div class="form-group">
                  <input name="title" type="text" placeholder="Fifa 20" class="form-control">
                </div>

                <label>Description: </label>
                <div class="form-group">
                  <textarea name="description" type="text" placeholder="Play unlimited matches" class="form-control"></textarea>
                </div>

                <label>Genre: </label>
                <div class="form-group">
                  <select name="genre_id" class="hide-search form-control" style="width: 100%">
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                  </select>
                </div>

                <label>Mode: </label>
                <div class="form-group">
                  <select name="game_mode_id" class="hide-search form-control" style="width: 100%">
                    @foreach($modes as $mode)
                    <option value="{{$mode->id}}">{{$mode->mode}}</option>
                    @endforeach
                  </select>
                </div>

                <label>Max Players: </label>
                <div class="form-group">
                  <input name="max_plyers" type="text" placeholder="2" class="form-control">
                </div>

                <label>Perspective: </label>
                <div class="form-group">
                  <select name="player_perspective_id" class="hide-search form-control" style="width: 100%">
                    @foreach($perspectives as $perspective)
                    <option value="{{$perspective->id}}">{{$perspective->perspective}}</option>
                    @endforeach
                  </select>
                </div>

                <label>Rating: </label>
                <div class="form-group">
                  <input name="rating" type="number" placeholder="5" class="form-control">
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
@endsection