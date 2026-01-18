<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer')->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);

        $orders->appends($request->all());

        return view('dashboard.orders.index', compact('orders'));
    }



    public function show(Order $order)
    {
        $order->load('items');

        return response()->json([
            'order' => $order,
            'items' => $order->items,
        ]);
    }



    public function toggleItemStatus(OrderItem $item)
    {
        $item->update([
            'status' => $item->status === 'completed'
                ? 'refunded'
                : 'completed'
        ]);

        return response()->json([
            'success' => true,
            'status'  => $item->status,
        ]);
    }
}
