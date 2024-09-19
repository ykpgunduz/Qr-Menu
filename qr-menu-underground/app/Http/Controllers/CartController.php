<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Calculation;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart(Request $request)
    {
        $tableNumber = $request->input('table');
        $sessionId = session()->getId();

        // Sepet öğelerini al
        $cartItems = Cart::where('table_number', $tableNumber)
            ->where('session_id', $sessionId)
            ->with('product')
            ->get();

        // Toplam miktarı hesapla
        $totalAmount = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->price;
        });

        // Cihaz bilgisini al
        $deviceInfo = Cart::where('table_number', $tableNumber)
            ->where('session_id', $sessionId)
            ->value('device_info');

        return view('qr-cart', compact('cartItems', 'tableNumber', 'totalAmount', 'sessionId', 'deviceInfo'));
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı');
        }

        return redirect()->back()->with('error', 'Ürün bulunamadı');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::find($id);
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Sepet öğesi bulunamadı.');
        }

        if ($request->has('quantity_change')) {
            $quantityChange = (int) $request->input('quantity_change');
            $newQuantity = $cartItem->quantity + $quantityChange;

            if ($newQuantity <= 0) {
                $cartItem->delete();
                return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı.');
            } else {
                $cartItem->quantity = $newQuantity;
                $cartItem->price = $cartItem->product->price; // Fiyatı güncelle
                $cartItem->save();
            }
        }

        return redirect()->back()->with('success', 'Sepet güncellendi.');
    }
}
