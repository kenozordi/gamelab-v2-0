<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GenreApi extends Controller
{
    public function all()
    {
        try {
            $genre = Genre::all();
            return ResponseFormat::returnSuccess($genre);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $genre = Genre::find($id);
            if ($genre) {
                return ResponseFormat::returnSuccess($genre);
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
                'name' => ['required', 'string'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $genre = $validator->validated();
            Genre::create($genre);
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function delete($id)
    {
        try {
            $genre = Genre::find($id);
            if ($genre) {
                Genre::destroy($id);
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($genre);
        }
    }
}
