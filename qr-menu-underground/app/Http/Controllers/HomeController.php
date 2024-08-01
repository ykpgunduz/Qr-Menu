<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
}
