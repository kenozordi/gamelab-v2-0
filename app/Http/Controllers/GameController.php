<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\GameApi;
use App\Http\Controllers\API\GameModeApi;
use App\Http\Controllers\API\GenreApi;
use App\Http\Controllers\API\PlayerPerspectiveApi;

class GameController extends Controller
{
    protected $gameApi, $genreApi, $gameModeApi, $perspectiveApi;

    public function __construct(GameApi $gameApi, GenreApi $genreApi, GameModeApi $gameModeApi, PlayerPerspectiveApi $perspectiveApi)
    {
        $this->gameApi = $gameApi;
        $this->genreApi = $genreApi;
        $this->gameModeApi = $gameModeApi;
        $this->perspectiveApi = $perspectiveApi;
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

        $page_title = $game->title;
        $page_description = $game->description;
        $action = 'games';

        return view('admin.games.games', compact('page_title', 'page_description', 'action', 'game', 'genres'));
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

        if ($game->status) {
            return redirect()->route('admin.games');
        } else {
            return back()->withErrors($game->data);
        }

        return redirect()->route('admin.games');
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
     * **save a new Player Perspective**
     * @param Request $request containing new Player Perspective details
     * @return mixed 
     */
    public function storePlayerPerspective(Request $request)
    {
        $playerPerspective = $this->perspectiveApi->store($request)->getData();

        if ($playerPerspective->status) {
            return redirect()->route('admin.games.settings');
        } else {
            return back()->withErrors($playerPerspective->data);
        }
    }

    public function deletePlayerPerspective($id)
    {
        $playerPerspective = $this->perspectiveApi->delete($id)->getData();

        if ($playerPerspective->status) {
            return redirect()->route('admin.games.settings');
        } else {
            return back()->withErrors('Oops! Something went wrong, try again later');
        }
    }
}
