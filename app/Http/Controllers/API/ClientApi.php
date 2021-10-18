<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class ClientApi extends Controller
{
    public function all()
    {
        try {
            $clients = Client::orderBy('created_at', 'DESC')->get();
            return ResponseFormat::returnSuccess($clients);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $client = Client::where('id', $id)->with('bookings', 'game_clients', 'game_clients.game', 'bookings.gamer', 'bookings.game')->first();
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
                'ipaddress' => ['required', 'string', 'unique:clients,ipaddress'],
                'dashboardmoduleip' => ['string', 'unique:clients,dashboardmoduleip'],
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

    public function toggle($id)
    {
        try {
            $client = Client::find($id);
            if ($client) {
                $client->status = $client->status == 1 ? 0 : 1;
                $client->save();
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($client);
        }
    }

    public function update(Request $request)
    {
        try {
            $clientInDB = Client::where('id', $request->id)->first();
            if (!$clientInDB) {
                return ResponseFormat::returnNotFound();
            }

            $validator = Validator::make($request->all(), [
                'machinename' => ['string'],
                'ipaddress' => ['string', 'unique:clients,ipaddress,' . $request->id],
                'dashboardmoduleip' => ['string', 'unique:clients,dashboardmoduleip,' . $request->id],
                'tileconfigsetid' => ['integer'],
                'isdeleted' => ['boolean'],
                'status' => ['boolean'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }
            $client = $validator->validated();

            Client::where('id', $request->id)->update($client);
            $clientInDB = $clientInDB->refresh();

            return ResponseFormat::returnSuccess($clientInDB);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function totalRevenue($id)
    {
        $revenue = 0;
        $client = Client::find($id);
        if ($client) {
            foreach ($client->bookings as $booking) {
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
