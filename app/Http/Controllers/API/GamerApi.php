<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gamer;
use App\Services\ResponseFormat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GamerApi extends Controller
{
    public function all()
    {
        try {
            $gamers = Gamer::orderBy('created_at', 'DESC')->get();
            return ResponseFormat::returnSuccess($gamers);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $gamer = Gamer::find($id);
            if ($gamer) {
                return ResponseFormat::returnSuccess($gamer);
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
                'email' => ['required', 'email', 'unique:users,email'],
                'fullname' => ['required', 'string'],
                'phone' => ['string', 'unique:users,phone'],
                'username' => ['alpha_dash', 'unique:users,username'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $gamer = $validator->validated();

            $gamer['password'] = 'gamelab1234'; //defaultPassword
            if (!isset($gamer['username'])) {
                $gamer['username'] = $gamer['email'];
            }
            $gamer = Gamer::create($gamer);
            return ResponseFormat::returnSuccess($gamer);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed($e->getMessage());
        }
    }

    public function toggle($id)
    {
        try {
            $gamer = Gamer::find($id);
            if ($gamer) {
                $gamer->status = $gamer->status == 1 ? 0 : 1;
                $gamer->save();
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($gamer);
        }
    }

    public function update(Request $request)
    {
        try {
            $gamerInDB = Gamer::where('id', $request->id);
            if (!$gamerInDB) {
                return ResponseFormat::returnNotFound();
            }

            $validator = Validator::make($request->all(), [
                'email' => ['email'],
                'fullname' => ['string'],
                'phone' => ['string', 'unique:users,phone'],
                'username' => ['string', 'unique:users,username'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }
            $gamer = $validator->validated();

            Gamer::where('id', $request->id)->update($gamer);
            $gamerInDB = $gamerInDB->refresh();

            return ResponseFormat::returnSuccess($gamerInDB);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }
}
