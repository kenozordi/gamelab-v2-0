<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ClientApi;
use App\Http\Controllers\API\GameApi;
use App\Http\Controllers\API\GamerApi;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientApi, $genreApi, $gameModeApi, $perspectiveApi, $gameApi, $gamerApi;

    public function __construct(ClientApi $clientApi, GameApi $gameApi, GamerApi $gamerApi)
    {
        $this->clientApi = $clientApi;
        $this->gameApi = $gameApi;
        $this->gamerApi = $gamerApi;
    }

    public function clients()
    {
        $clients = $this->clientApi->all()->getData();
        $clients = $clients->status ? $clients->data : null;

        $page_title = 'Clients';
        $page_description = 'clients on gamelab';

        return view('admin.client.clients', compact('page_title', 'page_description', 'clients'));
    }

    public function get($id)
    {
        $client = $this->clientApi->get($id)->getData();
        $client = $client->status ? $client->data : null;
        $clientRevenue = $this->clientApi->totalRevenue($id);

        $games = $this->gameApi->all()->getData();
        $games = $games->status ? $games->data : null;

        $gamers = $this->gamerApi->all()->getData();
        $gamers = $gamers->status ? $gamers->data : null;

        $page_title = $client->machinename;
        $page_description = $client->machinename;

        return view('admin.client.client', compact('page_title', 'page_description', 'client', 'clientRevenue', 'games', 'gamers'));
    }

    public function create()
    {
        $page_title = 'Create game';
        $page_description = 'create a new game';
        $action = 'create';

        return view('admin.games.create', compact('page_title', 'page_description', 'action'));
    }

    public function store(Request $request)
    {
        $clients = $this->clientApi->store($request)->getData();

        if (!$clients->status) {
            return back()->withErrors($clients->data);
        }

        return redirect()->route('admin.clients');
    }

    public function update(Request $request)
    {
        $client = $this->clientApi->update($request)->getData();

        if (!$client->status) {
            return back()->withErrors($client->data);
        }

        return redirect()->route('admin.client.client', [$client->data->id]);
    }

    public function toggle($clientId)
    {
        $clients = $this->clientApi->toggle($clientId)->getData();

        if (!$clients->status) {
            return back()->withErrors($clients->data);
        }

        return back();
    }
}
