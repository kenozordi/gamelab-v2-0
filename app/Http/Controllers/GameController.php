<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\GameApi;
use App\Http\Controllers\API\GenreApi;

class GameController extends Controller
{
    protected $gameApi, $genreApi;

    public function __construct(GameApi $gameApi, GenreApi $genreApi)
    {
        $this->gameApi = $gameApi;
        $this->genreApi = $genreApi;
    }

    public function games()
    {
        $games = $this->gameApi->all()->getData();
        $games = $games->status ? $games->data : null;
        $genres = $this->genreApi->all()->getData();
        $genres = $genres->status ? $genres->data : null;

        $page_title = 'Games';
        $page_description = 'games on gamelab';
        $action = 'games';

        return view('admin.games.games', compact('page_title', 'page_description', 'action', 'games', 'genres'));
    }

    public function get($id)
    {
        $game = $this->gameApi->get($id)->getData();
        $game = $game->status ? $game->data : null;

        $page_title = $game->title;
        $page_description = $game->description;
        $action = 'games';

        return view('admin.games.games', compact('page_title', 'page_description', 'action', 'games', 'genres'));
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
            return back()->withErrors('Oops! Something went wrong, try again later');
        }

        return redirect()->route('admin.games');
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
            return redirect()->route('admin.games');
        } else {
            return back()->withErrors('Oops! Something went wrong, try again later');
        }
    }

    public function deleteGenre($id)
    {
        $genre = $this->genreApi->delete($id)->getData();

        if ($genre->status) {
            return redirect()->route('admin.games');
        } else {
            return back()->withErrors('Oops! Something went wrong, try again later');
        }
    }
}
