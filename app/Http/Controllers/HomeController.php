<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Calculation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();
        $cafe = Cafe::first();
        $tableNumber = $request->query('table');
        $orderItem = OrderItem::where('table_number', $tableNumber)->first();

        return view('qr-menu', compact('products', 'categories', 'cafe', 'tableNumber', 'orderItem'));
    }

    public function addToCart(Request $request)
    {
        $tableNumber = $request->input('table');
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $deviceInfo = $request->header('User-Agent');

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Ürün bulunamadı'], 404);
        }

        $cartItem = Cart::where('session_id', session()->getId())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->price = $product->price;
            $cartItem->save();
        } else {
            $cartItem = new Cart();
            $cartItem->session_id = session()->getId();
            $cartItem->table_number = $tableNumber;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = $quantity;
            $cartItem->price = $product->price;
            $cartItem->device_info = $deviceInfo;
            $cartItem->save();
        }

        $cartCount = Cart::where('session_id', session()->getId())->count();
        $totalAmount = Cart::where('session_id', session()->getId())->sum('price');

        return response()->json([
            'success' => true,
            'message' => 'Ürün siparişe eklendi!',
            'cartCount' => $cartCount,
            'totalAmount' => $totalAmount
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer',
            'products' => 'required|json',
        ]);

        Calculation::create([
            'table_number' => $request->input('table_number'),
            'products' => json_decode($request->input('products')),
        ]);

        return redirect()->route('admin.orders');
    }
}
