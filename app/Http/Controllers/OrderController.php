<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BookingApi;
use App\Http\Controllers\API\ClientApi;
use App\Http\Controllers\API\GameApi;
use App\Http\Controllers\API\GamerApi;
use App\Http\Controllers\API\OrderApi;
use App\Http\Controllers\API\PaymentApi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderApi, $bookingApi, $gamerApi, $paymentApi, $gameApi, $clientApi;

    public function __construct(OrderApi $orderApi, BookingApi $bookingApi, GamerApi $gamerApi, PaymentApi $paymentApi, GameApi $gameApi, ClientApi $clientApi)
    {
        $this->orderApi = $orderApi;
        $this->bookingApi = $bookingApi;
        $this->gamerApi = $gamerApi;
        $this->paymentApi = $paymentApi;
        $this->gameApi = $gameApi;
        $this->clientApi = $clientApi;
    }

    public function orders()
    {
        $orders = $this->orderApi->all()->getData();
        $orders = $orders->status ? $orders->data : null;

        $bookings = $this->bookingApi->all()->getData();
        $bookings = $bookings->status ? $bookings->data : null;

        $gamers = $this->gamerApi->all()->getData();
        $gamers = $gamers->status ? $gamers->data : null;

        $page_title = 'Orders';
        $page_description = 'orders on gamelab';

        return view('admin.order.orders', compact('page_title', 'page_description', 'orders', 'bookings', 'gamers'));
    }

    public function get($id)
    {
        $order = $this->orderApi->get($id)->getData();
        $order = $order->status ? $order->data : null;

        $gamers = $this->gamerApi->all()->getData();
        $gamers = $gamers->status ? $gamers->data : null;

        $games = $this->gameApi->all()->getData();
        $games = $games->status ? $games->data : null;

        $clients = $this->clientApi->all()->getData();
        $clients = $clients->status ? $clients->data : null;

        $bookings = $this->bookingApi->all()->getData();
        $bookings = $bookings->status ? $bookings->data : null;

        if ($order) {
            $page_title = isset($order->order_no) ? $order->order_no : null;
            $page_description = $order->order_no;

            return view('admin.order.order', compact('page_title', 'page_description', 'order', 'gamers', 'games', 'clients', 'bookings'));
        } else {
            return back()->withErrors("Something went wrong");
        }
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
        $orders = $this->orderApi->store($request)->getData();

        if (!$orders->status) {
            return back()->withErrors($orders->data);
        }

        return back();
    }


    public function addGamerToOrder(Request $request)
    {
        $orders = $this->orderApi->addGamerToOrder($request)->getData();

        if (!$orders->status) {
            return back()->withErrors($orders->data);
        }

        return back();
    }


    public function pay($id)
    {
        $orders = $this->paymentApi->pay($id)->getData();

        if (!$orders->status) {
            return back()->withErrors($orders->data);
        }

        return back();
    }
}
