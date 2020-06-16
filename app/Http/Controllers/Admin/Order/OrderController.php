<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::with('customer', 'shipping', 'payments', 'orderItems')->latest()->get();
//        return $orders;
        $order_items = OrderItem::with('product', 'order')->latest()->get();
//        return $order_items;

        return view('admin.order.index', compact('orders', 'order_items'));
    }

    public function show($order_id) {
        $order_id = base64_decode($order_id);
        $order = Order::with('customer', 'shipping', 'payments', 'orderItems')->where('id', $order_id)->first();
        return $order;
    }
}
