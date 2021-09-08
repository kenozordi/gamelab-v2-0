{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')


<div class="container-fluid">

    <!-- breadcrumb -->
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Create new Game</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/games">Games</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
            </ol>
        </div>
    </div>

    <!-- error message for validation error -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- add new game form -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Game Details</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <form action="{{route('admin.games.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Call of Duty: Black Ops">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Genre</label>
                                    <select id="genre" class="form-control" name="genre">
                                        <option value="" selected>Choose...</option>
                                        <option value="1">Action</option>
                                        <option value="2">Sport</option>
                                        <option value="3">Fantasy</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea type="textarea" rows="4" name="description" class="form-control" placeholder="Explore a world in turmoil and define its fate"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Game Mode</label>
                                    <select id="game_mode" class="form-control" name="game_mode">
                                        <option value="" selected>Choose...</option>
                                        <option value="1">Single Player</option>
                                        <option value="2">Multi Player</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Player Perspective</label>
                                    <select id="player_perspective" class="form-control" name="player_perspective">
                                        <option value="" selected>Choose...</option>
                                        <option value="1">First Person Shooter</option>
                                        <option value="2">Role playing game (RPG)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Rating</label>
                                    <select id="rating" class="form-control" name="rating">
                                        <option value="" selected>Choose...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="1">3</option>
                                        <option value="2">4</option>
                                        <option value="2">5</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="" selected>Choose...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection