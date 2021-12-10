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
    private function verifyOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order && $order->status != 0) {
            //verify order status
            if ($order->status == 2) {
                return ResponseFormat::returnFailed("Order has been paid for already");
            }

            //verify booking status
            $bookings = Booking::where('order_no', $order->order_no)->get();
            if (count($bookings) > 0) {
                $totalAmount = 0;
                foreach ($bookings as $booking) {
                    if ($booking->status == 0) return ResponseFormat::returnFailed('Booking ' . $booking->id . ' does not exist');
                    if (strtotime($booking->expires_at) <= strtotime('now')) return ResponseFormat::returnFailed('Booking ' . $booking->id . ' has expired');

                    //verify if gaming pricing has been set
                    $gameClient = GameClient::where('game_id', $booking->game_id)
                        ->where('client_id', $booking->client_id)
                        ->first();
                    if (!$gameClient) return ResponseFormat::returnFailed('Invalid game or client selected for booking ' . $booking->id);

                    //verify if booking has been paid for
                    if ($booking->order_no) {
                        $order = Order::where('order_no', $booking->order_no)->first();
                        if ($order && $order->status == 2) {
                            return ResponseFormat::returnFailed('Booking ' . $booking->id . ' has been paid for already');
                        }
                    }

                    $totalAmount += $booking->amount;
                }

                // verify amount of bookings agains order
                if ($order->total != $totalAmount) {
                    $order->total = $totalAmount;
                    $order->save();
                }
            }
            return ResponseFormat::returnSuccess($order);
        }
        return ResponseFormat::returnFailed();
    }

    public function pay($order_id)
    {
        try {
            $apiResponse = $this->verifyOrder($order_id);
            $result = $this->verifyOrder($order_id)->getData();

            if ($result->status) {
                $order = Order::find($order_id);
                $order->status = 2;
                $order->order_date = date('Y-m-d H:i:s');
                $order->save();
                $order = $order->refresh();
                return ResponseFormat::returnSuccess($order);
            }
            return $apiResponse;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return ResponseFormat::returnFailed($e->getMessage());
        }
    }
}
