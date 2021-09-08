<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\GameClient;
use App\Models\Order;
use App\Services\ResponseFormat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentApi extends Controller
{
    public function verifyOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $bookings = Booking::where('order_no', $order->order_no)->get();
            if (count($bookings) > 0) {
                foreach ($bookings as $booking) {
                    if ($booking->status == 0) return ResponseFormat::returnFailed(null, 'Booking ' . $booking->id . ' does not exist');
                    if (strtotime($booking->expires_at) <= strtotime('now')) return ResponseFormat::returnFailed(null, 'Booking ' . $booking->id . ' has expired');
                    $gameClient = GameClient::where('game_id', $booking->game_id)
                        ->where('client_id', $booking->client_id)
                        ->first();
                    if (!$gameClient) return ResponseFormat::returnFailed(null, 'Invalid game or client selected for booking ' . $booking->id);
                }
            }
            return ResponseFormat::returnSuccess($order);
        }
        return ResponseFormat::returnFailed();
    }

    public function pay($order_id)
    {
        try {
            $order = Order::find($order_id);
            if ($order) {
                if ($order->status == 2) {
                    return ResponseFormat::returnFailed(null, "Order has been paid for already");
                }
                if ($order->status == 1) {
                    //pay through payment gateway here

                    $order->status = 2;
                    $order->order_date = date('D jS M Y, h:i:sa');
                    $order->save();

                    //create ticket here

                    return ResponseFormat::returnSuccess($order); //return ticket instead, do not return order here
                }
            }
            return ResponseFormat::returnFailed(null, "Order does not exist");
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return ResponseFormat::returnFailed();
        }
    }
}
