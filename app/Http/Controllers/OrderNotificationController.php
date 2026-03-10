<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Order;

class OrderNotificationController extends Controller
{
public function getNewOrders()
{
    $today = Carbon::today();

    $orders = Order::whereIn('status', ['pending', 'waiting'])
        ->whereDate('created_at', $today)
        ->latest()
        ->take(5)
        ->get();

    return response()->json([
        'count' => $orders->count(),
        'orders' => $orders
    ]);
}

}
