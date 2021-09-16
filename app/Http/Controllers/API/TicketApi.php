<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ResponseFormat;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\TicketType;
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

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => ['required', 'integer', 'exists:orders,id'],
                'game_pass_issued' => ['boolean'],
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
                foreach ($bookings as $booking) {
                    $ticket_exists = Ticket::where('booking_id', $booking->id)->get();
                    if (count($ticket_exists) > 0) {
                        // foreach ($ticket_exists as $oldTicket) {
                        //     $oldTicket->status = 0;
                        //     $oldTicket->save();
                        // }
                        Ticket::where('booking_id', $booking->id)->update(['status' => 0]);
                    }
                    $ticket['guid'] = Str::uuid();
                    $ticket['tickettype_id'] = 1;
                    $ticket['booking_id'] = $booking->id;
                    $ticket['client_id'] = $booking->client_id;
                    Ticket::create($ticket);
                    $tickets[] = $ticket;
                }
            }
            return ResponseFormat::returnSuccess($tickets);
        } catch (Exception $e) {
            Log::error($e);
            return ResponseFormat::returnFailed();
        }
    }

    public function toggle($id)
    {
        try {
            $ticket = Ticket::find($id);
            if ($ticket) {
                $ticket->status = $ticket->status == 1 ? 0 : 1;
                $ticket->save();
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
}
