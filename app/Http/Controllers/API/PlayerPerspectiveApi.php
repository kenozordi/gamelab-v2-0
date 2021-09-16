<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\PlayerPerspective;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlayerPerspectiveApi extends Controller
{
    public function all()
    {
        try {
            $player_perspectives = PlayerPerspective::all();
            return ResponseFormat::returnSuccess($player_perspectives);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $player_perspective = PlayerPerspective::find($id);
            if ($player_perspective) {
                return ResponseFormat::returnSuccess($player_perspective);
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
                'perspective' => ['required', 'string'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $player_perspective = $validator->validated();
            PlayerPerspective::create($player_perspective);
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function toggle($id)
    {
        try {
            $player_perspective = PlayerPerspective::find($id);
            if ($player_perspective) {
                $player_perspective->status = $player_perspective->status == 1 ? 0 : 1;
                $player_perspective->save();
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($player_perspective);
        }
    }
}
