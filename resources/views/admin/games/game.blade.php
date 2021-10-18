@extends('admin.layout.default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/forms/selects/select2.min.css">
@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">{{$game->title}}</h3>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/admin">Admin</a>
              </li>
              <li class="breadcrumb-item"><a href="/admin/games">Games</a>
              </li>
              <li class="breadcrumb-item active">{{$game->title}}
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-4 col-12">
        <div class="btn-group float-md-right">
          <button type="button" class="btn btn-danger btn-glow mr-1 mb-1" data-toggle="modal" title="add booking" data-target="#addBooking">
            <i class="ft-plus"></i> Book
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
                  <div class="modal-body">
                    <input hidden name="game_id" value="{{$game->id}}">
                    <label>Game: </label>
                    <div class="form-group">
                      <input disabled type="text" value="{{$game->title}}" class="form-control">
                    </div>
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
        </div>
      </div>
    </div>
    <div class="content-body">

      <!-- Recent Orders -->
      <div class="row">
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

        <div class="col-xl-4 col-lg-12">
          <div class="card">
            <div class="card-content">
              <div class="media align-items-stretch">
                <div class="p-2 text-center bg-success bg-darken-2 rounded-left">
                  <i class="icon-notebook font-large-2 text-white"></i>
                </div>
                <div class="p-2 bg-success text-white media-body rounded-right">
                  <h5 class="text-white">Total Bookings</h5>
                  <h5 class="text-white text-bold-400 mb-0">{{count($game->bookings)}}</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="media align-items-stretch">
                <div class="p-2 text-center bg-success bg-darken-2 rounded-left">
                  <i class="icon-basket-loaded font-large-2 text-white"></i>
                </div>
                <div class="p-2 bg-success text-white media-body rounded-right">
                  <h5 class="text-white">Total Revenue</h5>
                  <h5 class="text-white text-bold-400 mb-0">₦{{$gameRevenue}}</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Clients</h4>
              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="modal" title="add '{{$game->title}}' to a client" data-target="#addGameToClient">
                      <i class="ft-plus white"></i>
                    </button>
                    <!-- Add  Game to Client Modal -->
                    <div class="modal fade text-left" id="addGameToClient" tabindex="-1" role="dialog" aria-labelledby="addGameToClientLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-success white">
                            <label class="modal-title text-text-bold-600" id="addGameToClientLabel">Add Game to Client</label>
                            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('/')}}/admin/gameClient/store" method="post">
                            @csrf
                            <div class="modal-body">
                              <label>Game: </label>
                              <input hidden name="game_id" value="{{$game->id}}" class="form-control">
                              <div class="form-group">
                                <input diabled type="text" disabled value="{{$game->title}}" class="form-control">
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

                              <label>Amount: </label>
                              <div class="form-group">
                                <input required name="amount" type="number" placeholder="3000" class="form-control">
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
                    <!-- End Add Game to Client Modal -->
                  </li>
                  <li><a id="refreshGameClients" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>

            <!-- Clients -->
            <div class="card-content">
              <div class="card-body">
                <p class="card-text">This game is available on:</p>
              </div>
              <div class="table-responsive">
                <table id="clients" class="table table-hover mb-0">
                  <tbody>
                    @foreach($game->game_clients as $game_client)
                    <tr>
                      <td>{{$game_client->client->machinename}}</td>
                      <td>₦{{$game_client->amount}}</td>
                      <td>
                        <form action="{{url('/')}}/admin/gameClient/delete/{{$game_client->id}}" method="post">
                          @csrf
                          <div class="float-left">
                            <button type="submit" class="btn btn-sm btn-danger" type="submit" value="Submit"><i class="fa fa-trash"></i></button>
                          </div>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 col-lg-12">
          <!-- game details -->
          <div class="card">
            <div class="card-content">
              <!-- <img class="card-img-top img-fluid" src="{{asset('/images')}}/product/madden.jpg" alt="Card image cap" /> -->
              <img class="card-img-top img-fluid" src="{{asset('storage')}}/games/{{$game->cover_image}}" alt="{{$game->title}}" />
              <div class="card-body">
                <h4 class="card-title">{{$game->title}}</h4>
                <p class="card-text">{{$game->description}}</p>
                <p class="card-text">
                  <small class="text-muted">Last updated
                    <span class="badge badge-secondary">{{$game->updated_at}}</span>
                  </small>
                  <button type="button" class=" float-right btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#editGame"><i class="ft-edit-3"></i> Edit</button>
                </p>
              </div>
            </div>
          </div>
          <!-- recent bookings -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Recent Bookings</h4>
              <a class="heading-elements-toggle"><i class="ft-more-horizontal font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content">
              <div class="table-responsive">
                <table id="recent-orders" class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Gamer</th>
                      <th>Client</th>
                      <th>Start time</th>
                      <th>End time</th>
                      <th>Expire at</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(array_slice($game->bookings, 0, 5) as $booking)
                    <tr>
                      @if($booking->gamer_id != null)
                      <td>{{$booking->gamer->username}}</td>
                      @else
                      <td></td>
                      @endif
                      <td>{{$booking->client->machinename}}</td>
                      <td>{{$booking->start_time}}</td>
                      <td>{{$booking->end_time}}</td>
                      <td>{{$booking->expires_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Recent Orders -->

      <!-- Edit Game Modal -->
      <div class="modal fade text-left" id="editGame" tabindex="-1" role="dialog" aria-labelledby="editGameLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success white">
              <label class="modal-title text-text-bold-600" id="editGameLabel">Edit Game</label>
              <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/')}}/admin/games/update/{{$game->id}}" method="post">
              @csrf
              <input name="id" value="{{$game->id}}" hidden>
              <div class="modal-body">
                <label>Title: </label>
                <div class="form-group">
                  <input name="title" type="text" value="{{$game->title}}" class="form-control">
                </div>

                <label>Description: </label>
                <div class="form-group">
                  <textarea name="description" type="text" value="{{$game->description}}" class="form-control">{{$game->description}}</textarea>
                </div>

                <label>Genre: </label>
                <div class="form-group">
                  <select name="genre_id" class="hide-search form-control" style="width: 100%">
                    @foreach($genres as $genre)
                    @if($game->genre_id == $genre->id)
                    <option selected value="{{$genre->id}}">{{$genre->name}}</option>
                    @else
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>

                <label>Mode: </label>
                <div class="form-group">
                  <select name="game_mode_id" class="hide-search form-control" style="width: 100%">
                    @foreach($modes as $mode)
                    @if($game->game_mode_id == $mode->id)
                    <option selected value="{{$mode->id}}">{{$mode->mode}}</option>
                    @else
                    <option value="{{$mode->id}}">{{$mode->mode}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>

                <label>Max Players: </label>
                <div class="form-group">
                  <input name="max_players" type="text" value="{{$game->max_players}}" class="form-control">
                </div>

                <label>Perspective: </label>
                <div class="form-group">
                  <select name="player_perspective_id" class="hide-search form-control" style="width: 100%">
                    @foreach($perspectives as $perspective)
                    @if($game->player_perspective_id == $perspective->id)
                    <option selected value="{{$perspective->id}}">{{$perspective->perspective}}</option>
                    @else
                    <option value="{{$perspective->id}}">{{$perspective->perspective}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>

                <label>Rating: </label>
                <div class="form-group">
                  <input name="rating" type="number" value="{{$game->rating}}" class="form-control">
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