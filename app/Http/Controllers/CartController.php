<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
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
            return $cartItem->quantity * $cartItem->price;
        });

        $deviceInfo = Cart::where('table_number', $tableNumber)
            ->where('session_id', $sessionId)
            ->value('device_info');

        $products = Product::all();

        return view('qr-cart', compact('cartItems', 'tableNumber', 'totalAmount', 'sessionId', 'deviceInfo', 'products'));
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
                $cartItem->price = $cartItem->product->price;
                $cartItem->save();
            }
        }

        return redirect()->back()->with('success', 'Sepet güncellendi.');
    }

    public function decreaseQuantity($id, Request $request)
    {
        try {
            $sessionId = session()->getId();
            $tableNumber = $request->input('table');

            $cartItem = Cart::where('product_id', $id)
                ->where('session_id', $sessionId)
                ->where('table_number', $tableNumber)
                ->first();

            if ($cartItem) {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                    $cartItem->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Ürün miktarı azaltıldı',
                        'quantity' => $cartItem->quantity
                    ]);
                } else {
                    $cartItem->delete();
                    return response()->json([
                        'success' => true,
                        'message' => 'Ürün sepetten çıkarıldı'
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Ürün bulunamadı'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu'
            ], 500);
        }
    }

    public function ajaxUpdate(Request $request, $id)
    {
        try {
            $cartItem = Cart::where('id', $id)
                ->where('session_id', session()->getId())
                ->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ürün bulunamadı'
                ], 404);
            }

            $newQuantity = $cartItem->quantity + $request->quantity_change;

            if ($newQuantity <= 0) {
                $cartItem->delete();
            } else {
                $cartItem->quantity = $newQuantity;
                $cartItem->save();
            }

            // Toplam tutarı doğru şekilde hesapla ve kuruş kısmını kaldır
            $totalAmount = Cart::where('session_id', session()->getId())
                ->where('table_number', $request->table)
                ->get()
                ->sum(function($item) {
                    return $item->quantity * $item->price;
                });

            return response()->json([
                'success' => true,
                'totalAmount' => number_format($totalAmount, 0) // 0 decimal places
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function ajaxRemove($id)
    {
        $cartItem = Cart::find($id);
        if (!$cartItem) {
            return response()->json(['success' => false], 404);
        }

        $cartItem->delete();

        // Toplam tutarı hesapla
        $totalAmount = Cart::sum('price');

        return response()->json([
            'success' => true,
            'totalAmount' => number_format($totalAmount, 2)
        ]);
    }

    public function getCartItems(Request $request)
    {
        try {
            $cartItems = Cart::where('table_number', $request->table)
                ->where('session_id', $request->session_id)
                ->with('product')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'note' => $item->note,
                        'product' => $item->product
                    ];
                });

            return response()->json([
                'success' => true,
                'cartItems' => $cartItems
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sepet öğeleri alınamadı'
            ], 500);
        }
    }
}
