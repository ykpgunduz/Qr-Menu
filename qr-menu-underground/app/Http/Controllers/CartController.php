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
            ->with('product')
            ->get();

        $totalAmount = $cartItems->sum(function ($cartItem) {
            return $cartItem->price;
        });

        $deviceInfo = Cart::where('table_number', $tableNumber)
            ->where('session_id', $sessionId)
            ->value('device_info');

        return view('sepet', compact('cartItems', 'tableNumber', 'totalAmount', 'sessionId', 'deviceInfo'));
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

        $cartItem->quantity = $request->quantity;
        $cartItem->price = $cartItem->product->price * $cartItem->quantity;
        $cartItem->save();

        $totalAmount = Cart::where('session_id', $cartItem->session_id)->sum('price');

        return response()->json([
            'totalAmount' => $totalAmount,
            'itemPrice' => $cartItem->price,
            'itemId' => $cartItem->id
        ]);
    }
}
