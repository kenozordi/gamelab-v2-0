<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\GameClient;
use Illuminate\Support\Facades\Validator;

class OrderApi extends Controller
{
    public function all()
    {
        try {
            $orders = Order::orderBy('created_at', 'DESC')->get();
            return ResponseFormat::returnSuccess($orders);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                return ResponseFormat::returnSuccess($order);
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
                'gamer_id' => ['integer'],
                'bookings' => ['required', 'array'],
                'additional_info' => ['string'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }
            $request = $validator->validated();

            $order_no = 'IGL' . time() . rand(100, 1000);
            $total_amount = 0;

            //validate all bookings in the order to be created
            foreach ($request['bookings'] as $booking_id) {
                $booking = Booking::find($booking_id);

                //check if booking exists and is active
                if (!$booking || $booking->status == 0) return ResponseFormat::returnFailed('Booking ' . $booking_id . ' does not exist');

                //check if booking has been paid for
                if ($booking->order_no) {
                    $order = Order::where('order_no', $booking->order_no)->first();
                    if ($order && $order->status == 2) {
                        return ResponseFormat::returnFailed('Booking ' . $booking_id . ' has been paid for already');
                    }
                }

                //check if booking has expired
                if (strtotime($booking->expires_at) <= strtotime('now')) return ResponseFormat::returnFailed('Booking ' . $booking_id . ' has expired');

                //check if booking game and client exist.
                $gameClient = GameClient::where('game_id', $booking->game_id)
                    ->where('client_id', $booking->client_id)
                    ->first();
                if (!$gameClient) return ResponseFormat::returnFailed('Invalid game or client selected for booking ' . $booking_id);

                //update booking with order_id
                $booking->order_no = $order_no;
                $booking->save();
                $total_amount += $gameClient->amount;
            }

            $order = [
                'order_no'          => $order_no,
                'gamer_id'          => isset($request['gamer_id']) ? $request['gamer_id'] : null,
                'total'             => $total_amount,
                'status'            => 1,
                'additional_info'   => isset($request['additional_info']) ? $request['additional_info'] : null,
            ];
            Order::create($order);

            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function delete($id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                // an order shouldn't be deleted??
                // $order->status = 0;
                // $order->save();
                return ResponseFormat::returnSuccess();
            }
        } catch (Exception $e) {
            return ResponseFormat::returnFailed($order);
        }
        return ResponseFormat::returnFailed($order);
    }
}
