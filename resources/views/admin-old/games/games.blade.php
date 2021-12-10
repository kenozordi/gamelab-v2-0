{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
<div class="container-fluid">

    <!-- breadcrumb -->
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Games</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Games</a></li>
            </ol>
        </div>
    </div>

    <div class="row">

        <!-- error message for validation error -->
        @if ($errors->any())
        <div class="col-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif


        <!-- games table -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Games</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Genre</th>
                                    <th>Mode</th>
                                    <th>Perspective</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($games as $game)
                                <tr>
                                    <td>{{$game->title}}</td>
                                    <td>{{substr($game->description, 0, 20)}} ...</td>
                                    <td>{{$game->genre}}</td>
                                    <td>{{$game->game_mode}}</td>
                                    <td>{{$game->player_perspective}}</td>
                                    <td>{{$game->rating}}</td>
                                    <td>
                                        @if($game->status == 0)
                                        <span class="badge light badge-success">Active</span>
                                        @else
                                        <span class="badge light badge-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td><strong>120$</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- genre section -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Genre</h4>
                    <button class="btn btn-success ml-auto" data-toggle="modal" data-target="#createGenreModal">
                        <i class="fa fa-plus"></i>
                    </button>
                    <!-- create genre Modal -->
                    <div class="modal fade" id="createGenreModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Create Genre</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('admin.genre.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group col-md-12">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Action">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Status</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="" selected>Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- genre table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($genres as $genre)
                                <tr>
                                    <td>{{$genre->name}}</td>
                                    <td>
                                        @if($game->status == 0)
                                        <span class="badge light badge-success">Active</span>
                                        @else
                                        <span class="badge light badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <form action="{{route('admin.genre.delete', ['id' =>$genre->id])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
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
</div>
@endsection