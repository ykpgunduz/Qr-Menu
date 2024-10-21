<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Calculation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cartItems = json_decode($request->input('cart_items'), true);

        if (!$cartItems) {
            return redirect()->back()->with('error', 'Sepet boş.');
        }

        $totalAmount = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

        $tableNumber = $request->input('table_number');
        $sessionId = $request->session()->getId();
        $deviceInfo = $request->input('device_info');

        $orderNumber = 'ORD-' . strtoupper(uniqid());

        $existingOrder = Calculation::where('table_number', $tableNumber)->first();

        if ($existingOrder) {
            $existingOrder->total_amount += $totalAmount;
            $existingOrder->save();
            $orderId = $existingOrder->id;
        } else {
            $order = Calculation::create([
                'table_number' => $tableNumber,
                'total_amount' => $totalAmount,
                'session_id' => $sessionId,
                'device_info' => $deviceInfo,
                'order_number' => $orderNumber,
            ]);
            $orderId = $order->id;
        }

        $notes = $request->input('notes', []);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'table_number' => $tableNumber,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'note' => $notes[$item['id']] ?? null,
            ]);
        }

        DB::table('carts')->where('table_number', $tableNumber)->delete();
        $request->session()->flash('clearCart', true);

        return redirect()->route('order', ['table' => $tableNumber]);
    }

    public function show(Request $request)
    {
        $tableNumber = $request->query('table');

        $order = Calculation::with('orderItems.product')
            ->where('table_number', $tableNumber)
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }

        return view('qr-orders', compact('order', 'tableNumber'));
    }

    public function come(Request $request)
    {
        $tableNumber = $request->input('table_number');

        $order = Calculation::where('table_number', $tableNumber)->first();

        if ($order) {
            $order->status = 'Hesap';
            $order->save();
        }

        return redirect()->back();
    }
}
