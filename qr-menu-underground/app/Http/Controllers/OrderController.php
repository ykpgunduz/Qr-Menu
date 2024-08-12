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
        // Formdan gelen sepet verilerini JSON formatında al
        $cartItems = json_decode($request->input('cart_items'), true);

        if (!$cartItems) {
            return redirect()->back()->with('error', 'Sepet boş.');
        }

        // Toplam tutarı hesapla
        $totalAmount = array_sum(array_column($cartItems, 'price'));

        // Masa numarasını al
        $tableNumber = $request->input('table_number');

        // Session ID'yi al
        $sessionId = $request->session()->getId();

        // Formdan gelen device_info'yu al
        $deviceInfo = $request->input('device_info');

        // Aynı masa numarasıyla daha önce oluşturulmuş bir sipariş var mı kontrol et
        $existingOrder = Calculation::where('table_number', $tableNumber)->first();

        if ($existingOrder) {
            // Eğer varsa, mevcut siparişin toplam tutarını güncelle
            $existingOrder->total_amount += $totalAmount;
            $existingOrder->save();

            $orderId = $existingOrder->id;
        } else {
            // Eğer yoksa, yeni bir sipariş oluştur
            $order = Calculation::create([
                'table_number' => $tableNumber,
                'total_amount' => $totalAmount,
                'session_id' => $sessionId, // Session ID'yi kaydet
                'device_info' => $deviceInfo, // Device info'yu kaydet
            ]);

            $orderId = $order->id;
        }

        // Sepetteki ürünleri siparişe ekle
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        DB::table('carts')->where('table_number', $tableNumber)->delete();

        // Sepeti temizlemek için client-side JavaScript kodunu ekleyin
        $request->session()->flash('clearCart', true);

        return redirect()->route('order', ['orderId' => $orderId, 'table' => $tableNumber])
            ->with('success', 'Siparişiniz başarıyla oluşturuldu.');
    }

    public function show(Request $request)
    {
        // Masa numarasını al
        $tableNumber = $request->query('table');

        // Eğer masa numarası yoksa, hata mesajıyla ana sayfaya yönlendir
        if (!$tableNumber) {
            return redirect('/')->with('error', 'Masa numarası gerekli.');
        }

        // Masa numarasına göre ilk siparişi bul
        $order = Calculation::with('orderItems.product')
            ->where('table_number', $tableNumber)
            ->first();

        // Eğer sipariş bulunamadıysa, hata mesajıyla ana sayfaya yönlendir
        if (!$order) {
            return redirect('/')->with('error', 'Sipariş bulunamadı.');
        }

        // Sipariş bulunduysa, order view'i ile siparişi göster
        return view('order', compact('order'));
    }
}
