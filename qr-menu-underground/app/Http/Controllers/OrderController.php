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

        // Toplam tutarı hesapla
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

        $tableNumber = $request->input('table_number');
        $sessionId = $request->session()->getId();
        $deviceInfo = $request->input('device_info');
        $note = $request->input('note');

        // Var olan siparişi kontrol et
        $existingOrder = Calculation::where('table_number', $tableNumber)->first();

        if ($existingOrder) {
            $existingOrder->total_amount += $totalAmount;
            $existingOrder->note = $note;
            $existingOrder->save();

            $orderId = $existingOrder->id;
        } else {
            // Yeni sipariş oluştur
            $order = Calculation::create([
                'table_number' => $tableNumber,
                'total_amount' => $totalAmount,
                'session_id' => $sessionId,
                'device_info' => $deviceInfo,
                'note' => $note,
            ]);

            $orderId = $order->id;
        }

        // Sipariş öğelerini ekle
        foreach ($cartItems as $item) {
            OrderItem::create([
                'table_number' => $tableNumber,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Sepeti temizle
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

        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }

        return view('order', compact('order', 'tableNumber'));
    }

    public function come(Calculation $order)
    {
        // Siparişin durumunu güncelle
        $order->status = 'Hesap';
        $order->save();

        return redirect()->back()->with('success', 'Hesap başarıyla güncellendi!');
    }
}
