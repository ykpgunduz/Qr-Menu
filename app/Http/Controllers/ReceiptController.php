<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function show($table_number)
    {
        $calculation = Calculation::where('table_number', $table_number)->with('orderItems.product')->firstOrFail();

        $orderItems = $calculation->orderItems->map(function ($item) {
            return [
                'quantity' => $item->quantity,
                'product_name' => $item->product->title,
                'price' => $item->price * $item->quantity,
            ];
        });

        $data = [
            'table_number' => $calculation->table_number,
            'order_number' => $calculation->order_number,
            'order_items' => $orderItems,
            'total_amount' => $calculation->total_amount,
        ];

        return view('receipt', $data);
    }

    public function print(Calculation $calculation)
    {
        $orderItems = $calculation->orderItems->map(function ($item) {
            return [
                'quantity' => $item->quantity,
                'product_name' => $item->product->title,
                'price' => $item->price * $item->quantity,
            ];
        });

        $data = [
            'table_number' => $calculation->table_number,
            'order_number' => $calculation->order_number,
            'order_items' => $orderItems,
            'total_amount' => $calculation->total_amount,
        ];

        return view('receipt', $data);
    }
}
