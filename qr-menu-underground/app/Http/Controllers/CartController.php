<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart(Request $request)
    {
        $tableNumber = $request->input('table');
        $sessionId = session()->getId();

        $cartItems = Cart::where('table_number', $tableNumber)
            ->where('session_id', $sessionId)
            ->with('product') // 'product' yerine 'item' yazılmalı
            ->get();

        // Toplam tutarı hesaplama
        $totalAmount = $cartItems->sum(function ($cartItem) {
            return $cartItem->price;
        });

        return view('sepet', compact('cartItems', 'tableNumber', 'totalAmount'));
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
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Güncellenmiş quantity ve price hesaplama
        $cartItem->quantity = $request->quantity;
        $cartItem->price = $cartItem->product->price * $cartItem->quantity;
        $cartItem->save();

        // Toplam tutarı hesaplama
        $totalAmount = Cart::where('session_id', $cartItem->session_id)->sum('price');

        return response()->json([
            'totalAmount' => $totalAmount,
            'itemPrice' => $cartItem->price,
            'itemId' => $cartItem->id
        ]);
    }
}
