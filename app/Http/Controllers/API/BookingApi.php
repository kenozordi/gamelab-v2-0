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
use App\Models\Gamer;
use App\Models\Order;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingApi extends Controller
{
    public function all()
    {
        try {
            $bookings = Booking::with('game')->with('client')->with('gamer')->orderBy('created_at', 'DESC')->get();
            return ResponseFormat::returnSuccess($bookings);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $booking = Booking::where('id', $id)->with('game')->with('client')->with('gamer')->first();
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
                'gamer_id' => ['integer'],
                'status' => ['boolean'],
                'duration' => ['integer', 'max:30'],
                'start_time' => ['required', 'date', 'after:' . date('Y-m-d H:i', strtotime('now + 11 minute'))],
                'client_id' => ['required', 'integer', 'exists:clients,id'],
                'game_id' => ['required', 'integer', 'exists:games,id'],
                'order_no' => ['string'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $game = Game::find($request->game_id);
            if ($game && $game->status == 0) {
                return ResponseFormat::returnFailed("The selected game cannot be booked because it is inactive");
            }

            $client = Client::find($request->client_id);
            if ($client && $client->status == 0) {
                return ResponseFormat::returnFailed("The selected client cannot be booked because it is inactive");
            }

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

            //check if selected game exists on selected client.
            $gameClient = GameClient::where('game_id', $request->game_id)
                ->where('client_id', $request->client_id)
                ->first();
            if (!$gameClient) return ResponseFormat::returnFailed("The selected game is not available on the selected client");

            $reference = time() . rand(100, 1000);

            //time buffers- timing between booking sessions, to facilitate logistics and handovers of client to gamers
            $time_buffer = 4; //minutes
            $duration = 30; //minutes. This is the constant duration a game would last
            $start_time_buffer = date('Y-m-d H:i:s', strtotime($request->start_time . ' - ' . $time_buffer . ' minutes'));
            $end_time_buffer = date('Y-m-d H:i:s', strtotime($request->start_time . ' + ' . $duration . ' minutes' . ' + ' . $time_buffer . ' minutes'));

            // check if any existing booking between start time and end time for particular client
            $bookings_exists = Booking::whereBetween('start_time', [$start_time_buffer, $end_time_buffer])
                ->orWhereBetween('end_time', [$start_time_buffer, $end_time_buffer])
                ->get();

            if (count($bookings_exists) > 0) {
                foreach ($bookings_exists as $booking) {
                    if ($booking->client_id == $request->client_id && $booking->status == 1) {
                        if ($booking->expires_at > date('Y-m-d H:i:s')) {
                            return ResponseFormat::returnFailed('Sorry, the selected client is unavailable for the selected duration of time');
                        }
                    }
                }
            }

            $expires_at = date('Y-m-d H:i:s', strtotime($request->start_time . ' - 12 hours'));
            //if start_date is less than 12 hours away from current_date set expiry date to 10 minutes after current time
            if (strtotime('now + 11 hours 30 minutes') >= strtotime($request->start_time)) {
                $expires_at = date('Y-m-d H:i:s', strtotime('now + 15 minutes'));
            }

            $booking = $validator->validated();
            $booking["duration"] = $duration;
            $booking["reference"] = $reference;
            $booking["start_time"] = $request->start_time;
            $booking["end_time"] = date('Y-m-d H:i:s', strtotime($request->start_time . ' + ' . $duration . ' minutes'));
            $booking["expires_at"] = $expires_at;
            $booking["amount"] = $gameClient->amount;
            $booking = Booking::create($booking);

            //if booking is tied to an order, update the order amount
            if (isset($order)) {
                $order->total += $booking["amount"];
                $order->save();
            }


            $booking = Booking::where('id', $booking->id)->with('game')->with('client')->with('gamer')->first();
            return ResponseFormat::returnSuccess($booking);
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
                // $booking_amount = GameClient::where('client_id', $booking->client_id)->where('game_id', $booking->game_id)->first()->amount;
                if ($booking->order_no) {
                    $order = Order::where('order_no', $booking->order_no)->first();

                    //checks if booking has been paid for already
                    if ($order->status != 2) {
                        $booking_amount = $booking->amount;
                        Booking::destroy($booking->id);
                        $order->total -= $booking_amount;
                        $order->save();
                    } else {
                        return ResponseFormat::returnFailed('Booking cannot be deleted, it has been paid for already');
                    }
                }
                Booking::destroy($booking->id);
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return ResponseFormat::returnFailed();
        }
    }

    // write a function to return the time/durations available to be booked
}
