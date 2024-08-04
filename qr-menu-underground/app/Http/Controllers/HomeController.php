<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();

        // https://example.com/menu?table=5
        $tableNumber = $request->query('table');

        return view('index', compact('products', 'categories', 'tableNumber'));
    }

    public function addToCart(Request $request)
    {
        $tableNumber = $request->input('table');
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $deviceInfo = $request->header('User-Agent');

        // Ürünü bul
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Ürün bulunamadı'], 404);
        }

        // Sepette ürün var mı kontrol et
        $cartItem = Cart::where('session_id', session()->getId())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Sepette varsa miktarı güncelle
            $cartItem->quantity += $quantity;
            $cartItem->price = $product->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            // Sepette yoksa yeni ekle
            $cartItem = new Cart();
            $cartItem->session_id = session()->getId();
            $cartItem->table_number = $tableNumber;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = $quantity;
            $cartItem->price = $product->price * $quantity;
            $cartItem->device_info = $deviceInfo; // Cihaz bilgisini ekle
            $cartItem->save();
        }

        // Sepetteki toplam ürün sayısını ve toplam tutarı hesapla
        $cartCount = Cart::where('session_id', session()->getId())->count();
        $totalAmount = Cart::where('session_id', session()->getId())->sum('price');

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepete eklendi!',
            'cartCount' => $cartCount,
            'totalAmount' => $totalAmount
        ]);
    }

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

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer',
            'products' => 'required|json',
        ]);

        // Yeni siparişi oluştur
        Order::create([
            'table_number' => $request->input('table_number'),
            'products' => json_decode($request->input('products')),
        ]);

        // Sipariş onaylandıktan sonra admin sayfasına yönlendir
        return redirect()->route('admin.orders');
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

    public function sepet()
    {
        return view('sepet');
    }
}
