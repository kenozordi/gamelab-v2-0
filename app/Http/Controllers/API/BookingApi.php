<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Game;
use App\Models\GameClient;
use App\Models\Order;
use DateTime;
use Illuminate\Support\Facades\Validator;

class BookingApi extends Controller
{
    public function all()
    {
        try {
            $bookings = Booking::with('game')->with('client')->orderBy('created_at', 'DESC')->get();
            return ResponseFormat::returnSuccess($bookings);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $booking = Booking::where('id', $id)->where('status', 1)->first();
            if ($booking) {
                return ResponseFormat::returnSuccess($booking);
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
                'gamer' => ['integer'],
                'status' => ['boolean'],
                'duration' => ['integer', 'max:30'],
                'start_time' => ['required', 'date', 'after:' . date('Y-m-d H:i', strtotime('now + 11 minute'))],
                // 'start_time' => ['required', 'date'],
                'client_id' => ['required', 'integer', 'exists:clients,id'],
                'game_id' => ['required', 'integer', 'exists:games,id'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $reference = time() . rand(100, 1000);

            //format dates
            $start_time = date('D jS M Y, h:i:sa', strtotime($request->start_time));
            $end_time = date('D jS M Y, h:i:sa', strtotime($request->start_time . ' + 30 minutes'));
            $expires_at = date('D jS M Y, h:i:sa', strtotime($request->start_time . ' - 12 hours'));

            //time buffers- timing between booking sessions, to facilitate logistics and handovers of client to gamers
            $time_buffer = 4; //minutes
            $start_time_buffer = date('D jS M Y, h:i:sa', strtotime($start_time . ' - ' . $time_buffer . ' minutes'));
            $end_time_buffer = date('D jS M Y, h:i:sa', strtotime($end_time . ' + ' . $time_buffer . ' minutes'));

            //check if any existing booking between start time and end time for particular client
            $bookings_exists = Booking::whereBetween('start_time', [$start_time_buffer, $end_time_buffer])
                ->orWhereBetween('end_time', [$start_time_buffer, $end_time_buffer])
                ->get();
            if (count($bookings_exists) > 0) {
                foreach ($bookings_exists as $booking) {
                    if ($booking->client_id == $request->client_id && $booking->status == 1) {
                        if ($booking->expires_at > date('D jS M Y, h:i:sa')) {
                            return ResponseFormat::returnFailed('Sorry, the selected client is unavailable for the selected duration of time');
                        }
                    }
                }
            }

            //if start_date is less than 12 hours away from current_date set expiry date to 10 minutes after current time
            if (strtotime('now + 12 hours') >= strtotime($start_time)) {
                $expires_at = date('D jS M Y, h:i:sa', strtotime('now + 10 minutes'));
            }

            $booking = $validator->validated();
            $booking["reference"] = $reference;
            $booking["start_time"] = $start_time;
            $booking["end_time"] = $end_time;
            $booking["expires_at"] = $expires_at;
            Booking::create($booking);
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $values = $request->getContent();
            $booking = Booking::find($id);
            collect($values)->each(function ($value, $key) use ($booking) {
                $booking->$key = $value;
            });

            $booking->update();
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormat::returnFailed();
        }
    }

    //maybe make booking inactive instead of deleting it?
    public function delete($id)
    {
        try {
            $booking = Booking::find($id);
            if ($booking && $booking->status == 1) {
                $booking_amount = GameClient::where('client_id', $booking->client_id)->where('game_id', $booking->game_id)->first()->amount;
                if ($booking->order_no) {
                    $order = Order::where('order_no', $booking->order_no)->first();
                    if ($order->status != 2) {
                        $booking->status = 0;
                        $booking->save();
                        $order->total -= $booking_amount;
                        $order->save();
                    } else {
                        $booking->status = 0;
                        $booking->save();
                    }
                } else {
                    return ResponseFormat::returnFailed('Boooking cannot be deleted, it has been paid for already');
                }

                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return ResponseFormat::returnFailed();
        }
    }
}
