<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ClientApi;
use Illuminate\Http\Request;
use App\Http\Controllers\API\GameApi;
use App\Http\Controllers\API\GameModeApi;
use App\Http\Controllers\API\GamerApi;
use App\Http\Controllers\API\GenreApi;
use App\Http\Controllers\API\PlayerPerspectiveApi;

class GameController extends Controller
{
    protected $gameApi, $genreApi, $gameModeApi, $perspectiveApi, $clientApi, $gamerApi;

    public function __construct(GameApi $gameApi, GenreApi $genreApi, GameModeApi $gameModeApi, PlayerPerspectiveApi $perspectiveApi, ClientApi $clientApi, GamerApi $gamerApi)
    {
        $this->gameApi = $gameApi;
        $this->genreApi = $genreApi;
        $this->gameModeApi = $gameModeApi;
        $this->perspectiveApi = $perspectiveApi;
        $this->clientApi = $clientApi;
        $this->gamerApi = $gamerApi;
    }

    public function games()
    {
        $games = $this->gameApi->all()->getData();
        $games = $games->status ? $games->data : null;

        $genres = $this->genreApi->all()->getData();
        $genres = $genres->status ? $genres->data : null;

        $modes = $this->gameModeApi->all()->getData();
        $modes = $modes->status ? $modes->data : null;

        $perspectives = $this->perspectiveApi->all()->getData();
        $perspectives = $perspectives->status ? $perspectives->data : null;

        $page_title = 'Games';
        $page_description = 'games on gamelab';
        $action = 'games';

        return view('admin.games.games', compact('page_title', 'page_description', 'action', 'games', 'genres', 'modes', 'perspectives'));
    }

    public function get($id)
    {
        $game = $this->gameApi->get($id)->getData();
        $game = $game->status ? $game->data : null;
        $gameRevenue = $this->gameApi->totalRevenue($id);

        $clients = $this->clientApi->all()->getData();
        $clients = $clients->status ? $clients->data : null;

        $genres = $this->genreApi->all()->getData();
        $genres = $genres->status ? $genres->data : null;

        $modes = $this->gameModeApi->all()->getData();
        $modes = $modes->status ? $modes->data : null;

        $perspectives = $this->perspectiveApi->all()->getData();
        $perspectives = $perspectives->status ? $perspectives->data : null;

        $gamers = $this->gamerApi->all()->getData();
        $gamers = $gamers->status ? $gamers->data : null;

        $page_title = $game->title;
        $page_description = $game->description;
        $action = 'games';

        return view('admin.games.game', compact('page_title', 'page_description', 'action', 'game', 'gameRevenue', 'clients', 'genres', 'modes', 'perspectives', 'gamers'));
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
        $game = $this->gameApi->store($request)->getData();

        if (!$game->status) {
            return back()->withErrors($game->data);
        }

        return redirect()->route('admin.games');
    }

    public function update(Request $request)
    {
        $game = $this->gameApi->update($request)->getData();

        if (!$game->status) {
            return back()->withErrors($game->data);
        }

        return redirect()->route('admin.games.game', [$game->data->id]);
    }

    public function settings()
    {
        $genres = $this->genreApi->all()->getData();
        $genres = $genres->status ? $genres->data : null;
        $modes = $this->gameModeApi->all()->getData();
        $modes = $modes->status ? $modes->data : null;
        $perspectives = $this->perspectiveApi->all()->getData();
        $perspectives = $perspectives->status ? $perspectives->data : null;

        $page_title = 'Game Settings';

        return view('admin.games.settings', compact('page_title', 'genres', 'modes', 'perspectives'));
    }


    /**
     * **toggle game to active or inactive**
     * @param Request $request containing game id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle($gameId)
    {
        $game = $this->gameApi->toggle($gameId)->getData();

        if (!$game->status) {
            return back()->withErrors($game->data);
        }

        return back();
    }

    /**
     * **save a new genre**
     * @param Request $request containing new genre details
     * @return mixed 
     */
    public function storeGenre(Request $request)
    {
        $genre = $this->genreApi->store($request)->getData();

        if ($genre->status) {
            return redirect()->route('admin.games.settings');
        } else {
            return back()->withErrors($genre->data);
        }
    }

    //deprecated??
    public function deleteGenre($id)
    {
        $genre = $this->genreApi->delete($id)->getData();

        if ($genre->status) {
            return redirect()->route('admin.games.settings');
        } else {
            return back()->withErrors('Oops! Something went wrong, try again later');
        }
    }


    /**
     * **toggle genre to active or inactive**
     * @param Request $request containing Genre id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleGenre($genreId)
    {
        $genre = $this->genreApi->toggle($genreId)->getData();

        if (!$genre->status) {
            return back()->withErrors($genre->data);
        }

        return back();
    }


    /**
     * **save a new Game Mode**
     * @param Request $request containing new Game Mode details
     * @return mixed 
     */
    public function storeGameMode(Request $request)
    {
        $gameMode = $this->gameModeApi->store($request)->getData();

        if ($gameMode->status) {
            return redirect()->route('admin.games.settings');
        } else {
            return back()->withErrors($gameMode->data);
        }
    }


    //deprecated??
    public function deleteGameMode($id)
    {
        $gameMode = $this->gameModeApi->delete($id)->getData();

        if ($gameMode->status) {
            return redirect()->route('admin.games.settings');
        } else {
            return back()->withErrors('Oops! Something went wrong, try again later');
        }
    }


    /**
     * **toggle game mode to active or inactive**
     * @param Request $request containing new Game Mode id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleGameMode($gameModeId)
    {
        $gameMode = $this->gameModeApi->toggle($gameModeId)->getData();

        if (!$gameMode->status) {
            return back()->withErrors($gameMode->data);
        }

        return back();
    }


    /**
     * **save a new Player Perspective**
     * @param Request $request containing new Player Perspective details
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePlayerPerspective(Request $request)
    {
        $playerPerspective = $this->perspectiveApi->store($request)->getData();

        if ($playerPerspective->status) {
            return back();
        } else {
            return back()->withErrors($playerPerspective->data);
        }
    }


    //deprecated??
    public function deletePlayerPerspective($id)
    {
        $playerPerspective = $this->perspectiveApi->toggle($id)->getData();

        if ($playerPerspective->status) {
            return redirect()->route('admin.games.settings');
        } else {
            return back()->withErrors('Oops! Something went wrong, try again later');
        }
    }


    /**
     * **toggle player Perspective to active or inactive**
     * @param Request $request containing playerPerspective id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function togglePlayerPerspective($perspectiveId)
    {
        $perspective = $this->perspectiveApi->toggle($perspectiveId)->getData();

        if (!$perspective->status) {
            return back()->withErrors($perspective->data);
        }

        return back();
    }


    /**
     * **add a Game to a Client**
     * @param Request $request containing client id and game id and amount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addGameToClient(Request $request)
    {
        $gameClient = $this->gameApi->addGameToClient($request)->getData();

        if ($gameClient->status) {
            return back();
        } else {
            return back()->withErrors($gameClient->data);
        }
    }


    /**
     * **delete a Game Client pricing**
     * @param Request $request containing gameClient id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGameClient($gameClientId)
    {
        $gameClient = $this->gameApi->deleteGameClient($gameClientId)->getData();

        if (!$gameClient->status) {
            return back()->withErrors($gameClient->data);
        }

        return back();
    }
}
