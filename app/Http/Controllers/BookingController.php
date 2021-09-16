<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BookingApi;
use App\Http\Controllers\API\ClientApi;
use App\Http\Controllers\API\GameApi;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingApi, $gameApi, $clientApi;

    public function __construct(BookingApi $bookingApi, GameApi $gameApi, ClientApi $clientApi)
    {
        $this->bookingApi = $bookingApi;
        $this->gameApi = $gameApi;
        $this->clientApi = $clientApi;
    }

    public function bookings()
    {
        $bookings = $this->bookingApi->all()->getData();
        $bookings = $bookings->status ? $bookings->data : null;

        $games = $this->gameApi->all()->getData();
        $games = $games->status ? $games->data : null;

        $clients = $this->clientApi->all()->getData();
        $clients = $clients->status ? $clients->data : null;

        $page_title = 'Bookings';
        $page_description = 'booking on gamelab';

        return view('admin.booking.bookings', compact('page_title', 'page_description', 'bookings', 'games', 'clients'));
    }

    public function get($id)
    {
        $booking = $this->bookingApi->get($id)->getData();
        $booking = $booking->status ? $booking->data : null;

        $games = $this->gameApi->all()->getData();
        $games = $games->status ? $games->data : null;

        $clients = $this->clientApi->all()->getData();
        $clients = $clients->status ? $clients->data : null;

        $page_title = $booking->reference;
        $page_description = 'booking ' . $booking->reference;

        return view('admin.bookings.bookings', compact('page_title', 'page_description', 'booking', 'games', 'clients'));
    }

    public function store(Request $request)
    {
        $bookings = $this->bookingApi->store($request)->getData();

        if (!$bookings->status) {
            return back()->withErrors($bookings->data);
        }

        return redirect()->route('admin.bookings');
    }
}
