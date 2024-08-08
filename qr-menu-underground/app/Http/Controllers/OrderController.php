<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Calculation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Formdan gelen sepet verilerini JSON formatında al
        $cartItems = json_decode($request->input('cart_items'), true);

        if (!$cartItems) {
            return redirect()->back()->with('error', 'Sepet boş.');
        }

        // Toplam tutarı hesapla
        $totalAmount = array_sum(array_column($cartItems, 'price'));

        // Masa numarasını al
        $tableNumber = $request->input('table_number');

        // Yeni sipariş oluştur
        $order = Calculation::create([
            'table_number' => $tableNumber,
            'total_amount' => $totalAmount,
        ]);

        // Sepetteki ürünleri siparişe ekle
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Sepeti temizle
        $request->session()->forget('cartItems');

        return redirect()->route('order.store', $order->id)->with('success', 'Siparişiniz başarıyla oluşturuldu.');
    }

    public function show(Request $request)
    {
        $tableNumber = $request->query('table');

        if (!$tableNumber) {
            return redirect('/')->with('error', 'Table number is required.');
        }

        $calculations = Calculation::where('table_number', $tableNumber)->get();

        return view('orders.show', compact('calculations', 'tableNumber'));
    }
}
