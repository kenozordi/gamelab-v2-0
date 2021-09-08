<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\GameClient;
use Illuminate\Support\Facades\Validator;

class GameApi extends Controller
{
    public function all()
    {
        try {
            $game = Game::all();
            return ResponseFormat::returnSuccess($game);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $game = Game::find($id);
            if ($game) {
                return ResponseFormat::returnSuccess($game);
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnNotFound();
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'max_players' => ['integer'],
                'genre_id' => ['required', 'integer', 'exists:genres,id'],
                'game_mode_id' => ['integer', 'exists:game_modes,id'],
                'player_perspective_id' => ['integer', 'exists:player_perspectives,id'],
                'rating' => ['integer', 'max:5'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }
            $game = $validator->validated();

            $game = new Game([
                'title'                 => $game['title'],
                'description'           => $game['description'],
                'genre_id'              => $game['genre_id'],
                'game_mode_id'          => $game['game_mode_id'],
                'player_perspective_id' => $game['player_perspective_id'],
                'rating'                => $game['rating'],
                'status'                => $game['status'],
            ]);
            $game->save();

            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function delete($id)
    {
        try {
            $game = Game::find($id);
            if ($game) {
                Game::destroy($id);
                return ResponseFormat::returnSuccess();
            }
        } catch (Exception $e) {
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnFailed();
    }

    public function addGameToClient(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'client_id' => ['required', 'integer', 'exists:clients,id'],
                'game_id' => ['required', 'integer', 'exists:games,id'],
                'amount' => ['required', 'integer'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }
            $game_client = $validator->validated();
            $gc = GameClient::where('client_id', $game_client['client_id'])->where('game_id', $game_client['game_id'])->first();
            if ($gc) {
                $gc->amount = $game_client['amount'];
                $gc->save();
                return ResponseFormat::returnSuccess();
            }
            GameClient::create($game_client);
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnFailed();
    }
}
