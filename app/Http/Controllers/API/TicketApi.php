<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Mail\TicketGenerated;
use App\Models\Booking;
use App\Models\Order;
use App\Models\TicketType;
use App\Services\HistoryService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TicketApi extends Controller
{
    public function all()
    {
        try {
            $tickets = Ticket::with('ticket_type')->with('booking')->with('order')->orderBy('created_at', 'DESC')->get();
            return ResponseFormat::returnSuccess($tickets);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function get($id)
    {
        try {
            $ticket = Ticket::where('guid', $id)->first();
            if ($ticket) {
                return ResponseFormat::returnSuccess($ticket);
            }
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
        return ResponseFormat::returnNotFound();
    }

    public function history(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "start_date"    => "date|date_format:Y-m-d|before_or_equal:today",
            "end_date"      => "date|date_format:Y-m-d|before_or_equal:today",
            "status"        => "string",
            "amount"        => "numeric"
        ]);

        if ($validator->fails()) {
            return ResponseFormat::returnFailed($validator->errors());
        }

        $historyData = HistoryService::fetchHistory(new Ticket(), $request->all(), $request->page);

        return ResponseFormat::returnSuccess($historyData);
    }

    public function getTicketByOrderNo($orderNo)
    {
        try {
            $tickets = Ticket::where('order_no', $orderNo)->with('booking')->orderBy('created_at', 'DESC')->get();
            if ($tickets) {
                return ResponseFormat::returnSuccess($tickets);
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
                'order_id' => ['required', 'integer', 'exists:orders,id'],
                'tickettype_id' => ['integer', 'exists:tickettypes,id'],
                'game_pass_issued' => ['in:on,off,true,false,1,0'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $ticket = $validator->validated();
            $tickets = [];

            $order = Order::find($ticket['order_id']);

            // verify if order has been paid for
            if ($order->status == 2) {
                $bookings = Booking::where('order_no', $order->order_no)->get();
                if ($bookings) {

                    //validate gamer's email address
                    if (!isset($order->gamer->email)) {
                        return ResponseFormat::returnFailed("Gamer's email address missing, cannot send tickets");
                    }

                    //generate tickets for each booking in the order
                    foreach ($bookings as $booking) {

                        //deactivate previously generated tickets for the booking
                        $ticket_exists = Ticket::where('booking_id', $booking->id)->get();
                        if (count($ticket_exists) > 0) {
                            Ticket::where('booking_id', $booking->id)->update(['status' => 0]);
                        }

                        $ticket['guid'] = Str::uuid();
                        $ticket['tickettype_id'] = isset($ticket['tickettype_id']) ? isset($ticket['tickettype_id']) : 1;
                        $ticket['booking_id'] = $booking->id;
                        $ticket['client_id'] = $booking->client_id;
                        $game_pass_issued = isset($ticket['game_pass_issued']) ? isset($ticket['game_pass_issued']) : 0;

                        if ($game_pass_issued) {
                            switch ($game_pass_issued) {
                                case 'on':
                                case 'true':
                                case '1':
                                case 1:
                                    $ticket['game_pass_issued'] = 1;
                                    break;

                                default:
                                    $ticket['game_pass_issued'] = 0;
                                    break;
                            }
                        }

                        $savedTicket = Ticket::create($ticket);
                        $tickets[] = $savedTicket;
                        // Mail::to($order->gamer->email)
                        //     ->send(new TicketGenerated($savedTicket));
                    }
                    $this->sendTickets($tickets, $order->gamer->email);
                    return ResponseFormat::returnSuccess($tickets);
                }
                return ResponseFormat::returnFailed("No booking exist for order " . $order->order_no);
            }
            return ResponseFormat::returnFailed("Order hasn't been paid for");
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed($e->getMessage());
        }
    }

    public function toggle($id)
    {
        try {
            $ticket = Ticket::where('guid', $id)->first();
            if ($ticket) {
                $status = $ticket->status == 1 ? 0 : 1;
                Ticket::where('guid', $ticket->guid)->update(['status' => $status]);
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed();
        }
    }

    public function issueGamePass($id)
    {
        try {
            $ticket = Ticket::where('guid', $id)->first();
            if ($ticket) {
                $game_pass_issued = $ticket->game_pass_issued == 1 ? 0 : 1;
                Ticket::where('guid', $ticket->guid)->update(['game_pass_issued' => $game_pass_issued]);
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed();
        }
    }

    public function allTicketType()
    {
        try {
            $ticketTypes = TicketType::all();
            return ResponseFormat::returnSuccess($ticketTypes);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function storeTicketType(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return ResponseFormat::returnFailed($validator->errors());
            }

            $ticketType = $validator->validated();
            TicketType::create($ticketType);
            return ResponseFormat::returnSuccess();
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function toggleTicketType($id)
    {
        try {
            $ticketType = TicketType::find($id);
            if ($ticketType) {
                $ticketType->status = $ticketType->status == 1 ? 0 : 1;
                $ticketType->save();
                return ResponseFormat::returnSuccess();
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed();
        }
    }

    public function sendOneTicket($id)
    {
        try {
            $ticket = Ticket::where('guid', $id)->first();
            if ($ticket) {
                $gamer = $ticket->order->gamer;
                if ($gamer) {
                    $result = $this->sendTickets(array($ticket), $gamer->email);
                    if ($result) {
                        return ResponseFormat::returnSuccess();
                    }
                    return ResponseFormat::returnFailed("Failed to send ticket");
                }
                return ResponseFormat::returnFailed("Gamer's email address missing, cannot send ticket");
            }
            return ResponseFormat::returnNotFound();
        } catch (Exception $e) {
            return ResponseFormat::returnFailed();
        }
    }

    private function sendTickets($tickets, $email)
    {
        try {
            foreach ($tickets as $ticket) {
                Mail::to($email)
                    ->send(new TicketGenerated($ticket));
            }
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
