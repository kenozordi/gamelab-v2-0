<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BookingApi;
use App\Http\Controllers\API\OrderApi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderApi, $bookingApi;

    public function __construct(OrderApi $orderApi, BookingApi $bookingApi)
    {
        $this->orderApi = $orderApi;
        $this->bookingApi = $bookingApi;
    }

    public function orders()
    {
        $orders = $this->orderApi->all()->getData();
        $orders = $orders->status ? $orders->data : null;

        $bookings = $this->bookingApi->all()->getData();
        $bookings = $bookings->status ? $bookings->data : null;

        $page_title = 'Orders';
        $page_description = 'orders on gamelab';

        return view('admin.order.orders', compact('page_title', 'page_description', 'orders', 'bookings'));
    }

    public function get($id)
    {
        $order = $this->orderApi->get($id)->getData();
        $order = $order->status ? $order->data : null;

        $page_title = $order->machinename;
        $page_description = $order->machinename;

        return view('admin.orders.orders', compact('page_title', 'page_description', 'order'));
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

        return redirect()->route('admin.orders');
    }
}
