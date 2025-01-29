<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\User;
use App\Models\Rating;
use App\Models\OrderItem;
use App\Models\Calculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Filament\Notifications\Notification;

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
        $status = $request->input('status');

        $orderNumber = 'ORD-' . strtoupper(uniqid());

        $existingOrder = Calculation::where('table_number', $tableNumber)->first();

        if ($existingOrder) {
            if ($status == 'Self') {
                $existingOrder->total_amount += $totalAmount * 0.95;
                $existingOrder->ikram += $totalAmount * 0.05;
                $existingOrder->status = $status;
            } else {
                $existingOrder->total_amount += $totalAmount;
                $existingOrder->status = $status;
            }
            $existingOrder->save();
            $orderId = $existingOrder->id;
        } elseif ($status == 'Self') {
            $calculation = Calculation::create([
                'table_number' => $tableNumber,
                'total_amount' => $totalAmount * 0.95,
                'ikram' => $totalAmount * 0.05,
                'session_id' => $sessionId,
                'device_info' => $deviceInfo,
                'order_number' => $orderNumber,
                'status' => $status,
            ]);
            $orderId = $calculation->id;
        } else {
            $calculation = Calculation::create([
                'table_number' => $tableNumber,
                'total_amount' => $totalAmount,
                'session_id' => $sessionId,
                'device_info' => $deviceInfo,
                'order_number' => $orderNumber,
                'status' => $status,
            ]);
            $orderId = $calculation->id;
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

        $notification = $tableNumber . ". Masa Sipariş Verdi!";

        Notification::make()
            ->title($notification)
            ->success()
            ->duration(5000)
            ->sendToDatabase(User::all());

        DB::table('carts')->where('table_number', $tableNumber)->delete();
        Session::flash('clearCart', true);

        return redirect()->route('order', ['table' => $tableNumber]);
    }

    public function show(Request $request)
    {
        $tableNumber = $request->query('table');
        $cafe = Cafe::first();

        $order = Calculation::with('orderItems.product')
            ->where('table_number', $tableNumber)
            ->first();

        if (!$order) {
            $order = DB::table('past_orders')
                ->where('table_number', $tableNumber)
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$order) {
                return redirect()->back()->with('error', 'Sipariş bulunamadı.');
            }

            return redirect()->route('past.order.show', ['orderNumber' => $order->order_number]);
        }

        return view('qr-orders', compact('order', 'tableNumber', 'cafe'));
    }


    public function come(Request $request)
    {
        $tableNumber = $request->input('table_number');
        $order = Calculation::where('table_number', $tableNumber)->first();

        if ($order) {
            $order->status = 'Hesap';
            $order->save();
        }

        $notification = $tableNumber . ". Masa Hesabı İstiyor!";

        Notification::make()
            ->title($notification)
            ->success()
            ->sendToDatabase(User::all());

        return redirect()->back();
    }

    public function showPastOrder($orderNumber)
    {
        $order = DB::table('past_orders')->where('order_number', $orderNumber)->first();
        $cafe = Cafe::first();
        $rating = Rating::where('order_number', $orderNumber)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Geçmiş sipariş bulunamadı.');
        }

        return view('past-order', compact('order', 'cafe', 'rating'));
    }
}
