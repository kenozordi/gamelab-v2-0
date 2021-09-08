<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\GameMode;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GameModeApi extends Controller
{
    public function all()
    {
        try {
            $game_mode = GameMode::all();
            return ResponseFormat::returnSuccess($game_mode);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $game_mode = GameMode::find($id);
            if ($game_mode) {
                return ResponseFormat::returnSuccess($game_mode);
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
                'mode' => ['required', 'string'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $game_mode = $validator->validated();
            GameMode::create($game_mode);
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function delete($id)
    {
        try {
            $game_mode = GameMode::find($id);
            if ($game_mode) {
                GameMode::destroy($id);
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($game_mode);
        }
    }
}
