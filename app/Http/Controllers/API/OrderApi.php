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
use App\Models\Gamer;
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
            $order = Order::where('id', $id)->with('bookings', 'gamer', 'bookings.game', 'bookings.client')->first();
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
                'order_no' => ['string'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $order = null;
            //validate order
            if (isset($request->order_no)) {
                if ($request->order_no != '0') {

                    $order = Order::where('order_no', $request->order_no)->first();

                    if (!$order) {
                        return ResponseFormat::returnFailed(["order_no" => [
                            "The selected order is invalid."
                        ]]);
                    }

                    //if order has been paid for, return failed
                    if ($order->status == 2) {
                        return ResponseFormat::returnFailed("Cannot add new booking to order. Order has been paid for already");
                    }
                    if ($order->status != 1) {
                        return ResponseFormat::returnFailed("Invalid order");
                    }
                } else {
                    $request->order_no = null;
                }
            }

            //validate gamer
            $gamer = null;
            if (isset($request->gamer_id)) {
                if ($request->gamer_id != 0) {
                    $gamer = Gamer::find($request->gamer_id);
                    if (!$gamer) {
                        return ResponseFormat::returnFailed(["gamer_id" => [
                            "The selected gamer is invalid."
                        ]]);
                    }
                } else {
                    $request->gamer_id = null;
                }
            }


            $order_no = 'IGL' . time() . rand(100, 1000);
            $total_amount = (float)0;
            if ($order) {
                $order_no = $order->order_no;
                $total_amount = $order->amount;
            }

            $validated = $validator->validated();

            //validate all bookings in the order
            foreach ($validated['bookings'] as $booking_id) {
                $booking = Booking::find($booking_id);

                //check if booking exists and is active
                if (!$booking || $booking->status == 0) return ResponseFormat::returnFailed('Booking ' . $booking_id . ' does not exist');

                //check if booking has been ordered for
                if ($booking->order_no) {
                    $order = Order::where('order_no', $booking->order_no)->first();
                    if ($order && $order->status == 2) {
                        return ResponseFormat::returnFailed('Booking ' . $booking_id . ' has been paid for already');
                    }
                }

                //check if booking has expired
                if (strtotime($booking->expires_at) <= strtotime('now')) return ResponseFormat::returnFailed('Booking ' . $booking_id . ' has expired');

                //check if selected game exists on selected client.
                $gameClient = GameClient::where('game_id', $booking->game_id)
                    ->where('client_id', $booking->client_id)
                    ->first();
                if (!$gameClient) return ResponseFormat::returnFailed("The selected game doesn't exist on the selected client" . $booking_id);

                //update booking with order_no
                $booking->order_no = $order_no;
                $booking->save();

                $total_amount += $booking->amount;
            }

            if (!isset($order)) {
                $order = [
                    'order_no'          => $order_no,
                    'gamer_id'          => isset($gamer) ? $gamer->id : null,
                    'total'             => $total_amount,
                    'status'            => 1,
                    'additional_info'   => isset($validated['additional_info']) ? $validated['additional_info'] : null,
                ];
                Order::create($order);
            } else {
                $order->total = $total_amount;
                $order->update(["total" => $total_amount]);
            }

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

    public function addGamerToOrder(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'gamer_id' => ['required', 'integer', 'exists:users,id'],
                'order_id' => ['required', 'integer', 'exists:orders,id'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $validated = $validator->validated();

            $order = Order::find($validated['order_id']);
            if ($order) {
                $order->gamer_id = $validated['gamer_id'];
                $order->save();
            }

            return ResponseFormat::returnSuccess($order);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed($e->getMessage());
        }
    }
}
