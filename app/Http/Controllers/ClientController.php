<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ClientApi;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientApi, $genreApi, $gameModeApi, $perspectiveApi;

    public function __construct(ClientApi $clientApi)
    {
        $this->clientApi = $clientApi;
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

        $page_title = $client->machinename;
        $page_description = $client->machinename;

        return view('admin.clients.clients', compact('page_title', 'page_description', 'client'));
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
}
