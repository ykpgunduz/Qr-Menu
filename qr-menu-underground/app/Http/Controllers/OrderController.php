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

        $totalAmount = array_sum(array_column($cartItems, 'price'));
        $tableNumber = $request->input('table_number');
        $sessionId = $request->session()->getId();
        $deviceInfo = $request->input('device_info');
        $note = $request->input('note'); // Get the note from the request

        $existingOrder = Calculation::where('table_number', $tableNumber)->first();

        if ($existingOrder) {
            $existingOrder->total_amount += $totalAmount;
            $existingOrder->note = $note; // Update the note if the order already exists
            $existingOrder->save();

            $orderId = $existingOrder->id;
        } else {
            $order = Calculation::create([
                'table_number' => $tableNumber,
                'total_amount' => $totalAmount,
                'session_id' => $sessionId,
                'device_info' => $deviceInfo,
                'note' => $note, // Save the note when creating a new order
            ]);

            $orderId = $order->id;
        }

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        DB::table('carts')->where('table_number', $tableNumber)->delete();

        $request->session()->flash('clearCart', true);

        return redirect()->route('order', ['orderId' => $orderId, 'table' => $tableNumber])
            ->with('success', 'Siparişiniz başarıyla oluşturuldu.');
    }

    public function show(Request $request)
    {
        $tableNumber = $request->query('table');


        $order = Calculation::with('orderItems.product')
            ->where('table_number', $tableNumber)
            ->first();

  

        return view('order', compact('order'));
    }

    public function come(Calculation $order)
    {
        $order->status = 'Hesap';
        $order->save();

        return redirect()->back()->with('success', 'Hesap başarıyla güncellendi!');
    }
}
