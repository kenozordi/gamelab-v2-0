<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientApi extends Controller
{
    public function all()
    {
        try {
            $client = Client::all();
            return ResponseFormat::returnSuccess($client);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $client = Client::find($id);
            if ($client) {
                return ResponseFormat::returnSuccess($client);
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
                'machinename' => ['required', 'string'],
                'ipaddress' => ['required', 'string'],
                'dashboardmoduleip' => ['string'],
                'tileconfigsetid' => ['integer'],
                'isdeleted' => ['boolean'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $client = $validator->validated();
            Client::create($client);
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $client = Client::find($id);
            if ($client) {
                Client::destroy($id);
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($client);
        }
    }
}
