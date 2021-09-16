<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BookingApi;
use App\Http\Controllers\API\OrderApi;
use App\Http\Controllers\API\TicketApi;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketApi, $orderApi, $bookingApi;

    public function __construct(TicketApi $ticketApi, OrderApi $orderApi, BookingApi $bookingApi)
    {
        $this->ticketApi = $ticketApi;
        $this->orderApi = $orderApi;
        $this->bookingApi = $bookingApi;
    }

    public function tickets()
    {
        $tickets = $this->ticketApi->all()->getData();
        $tickets = $tickets->status ? $tickets->data : null;

        $bookings = $this->bookingApi->all()->getData();
        $bookings = $bookings->status ? $bookings->data : null;

        $orders = $this->orderApi->all()->getData();
        $orders = $orders->status ? $orders->data : null;

        $page_title = 'tickets';
        $page_description = 'tickets on gamelab';

        return view('admin.ticket.tickets', compact('page_title', 'page_description', 'tickets', 'orders', 'bookings'));
    }

    public function get($id)
    {
        $ticket = $this->ticketApi->get($id)->getData();
        $ticket = $ticket->status ? $ticket->data : null;

        $page_title = $ticket->machinename;
        $page_description = $ticket->machinename;

        return view('admin.tickets.tickets', compact('page_title', 'page_description', 'ticket'));
    }

    public function create()
    {
        $page_title = 'Create game';
        $page_description = 'create a new game';
        $action = 'create';

        return view('admin.games.create', compact('page_title', 'page_description', 'action'));
    }

    public function store(Request $request)
    {
        $tickets = $this->ticketApi->store($request)->getData();

        if (!$tickets->status) {
            return back()->withErrors($tickets->data);
        }

        return redirect()->route('admin.tickets');
    }
}
