<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\GameClient;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class GameApi extends Controller
{
    public function all()
    {
        try {
            $games = Game::with('genre')->with('game_mode')->with('player_perspective')->orderBy('status', 'DESC')->orderBy('updated_at', 'DESC')->get();
            return ResponseFormat::returnSuccess($games);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $game = Game::where('id', $id)->with('genre', 'game_mode', 'player_perspective', 'game_clients', 'game_clients.client', 'bookings.gamer', 'bookings.client')->first();
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
                'cover_image' => ['required', 'mimes:jpeg,png,jpg', 'max:5000']
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }
            $game = $validator->validated();

            // $game = Game::create($game);
            // $path = $request->file('cover_image')->storeAs('avatars', $game->id, 'public');
            $path = $request->file('cover_image')->storeAs('games', 'hello.' . $request->file('cover_image')->extension(), 'public');
            dd($path);

            $game = Game::where('id', $game->id)->with('genre')->with('game_mode')->with('player_perspective')->first();
            return ResponseFormat::returnSuccess($game);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function toggle($id)
    {
        try {
            $game = Game::find($id);
            if ($game) {
                $game->status = $game->status == 1 ? 0 : 1;
                $game->save();
                return ResponseFormat::returnSuccess();
            }
        } catch (Exception $e) {
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnFailed();
    }

    public function update(Request $request)
    {
        try {
            $gameInDB = Game::where('id', $request->id)->with('genre')->with('game_mode')->with('player_perspective')->first();
            if (!$gameInDB) {
                return ResponseFormat::returnNotFound();
            }
            $validator = Validator::make($request->all(), [
                'title' => ['string'],
                'description' => ['string'],
                'max_players' => ['integer'],
                'genre_id' => ['integer', 'exists:genres,id'],
                'game_mode_id' => ['integer', 'exists:game_modes,id'],
                'player_perspective_id' => ['integer', 'exists:player_perspectives,id'],
                'rating' => ['integer', 'max:5'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }
            $game = $validator->validated();
            Game::where('id', $request->id)->update($game);
            $gameInDB = $gameInDB->refresh();
            return ResponseFormat::returnSuccess($gameInDB);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
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

            //if game and client has existing record, update the amount instead
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

    public function deleteGameClient($id)
    {
        try {
            $gameClient = GameClient::find($id);
            if ($gameClient) {
                GameClient::destroy($id);
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed();
        }
    }

    public function totalRevenue($id)
    {
        $revenue = 0;
        $game = Game::find($id);
        if ($game) {
            foreach ($game->bookings as $booking) {
                if ($booking->order_no) {
                    //check if order exists
                    $order = Order::where('order_no', $booking->order_no)->first();

                    //check if order has been paid for
                    if ($order && $order->status = 2) {
                        $revenue += $booking->amount;
                    }
                }
            }
        }
        return $revenue;
    }
}
