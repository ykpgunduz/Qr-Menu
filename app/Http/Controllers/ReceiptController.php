<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Calculation;

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

        $cafe = Cafe::first();

        $data = [
            'table_number' => $calculation->table_number,
            'order_number' => $calculation->order_number,
            'order_items' => $orderItems,
            'total_amount' => $calculation->total_amount,
            'cafe_name' => $cafe->name ?? 'Cafe Adı',
            'cafe_address' => $cafe->address ?? 'Adres Bilgisi',
            'cafe_phone' => $cafe->phone ?? 'Telefon Bilgisi',
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

        $cafe = Cafe::first();

        $data = [
            'table_number' => $calculation->table_number,
            'order_number' => $calculation->order_number,
            'order_items' => $orderItems,
            'total_amount' => $calculation->total_amount,
            'cafe_name' => $cafe->name ?? 'Cafe Adı',
            'cafe_address' => $cafe->address ?? 'Adres Bilgisi',
            'cafe_phone' => $cafe->phone ?? 'Telefon Bilgisi',
        ];

        return view('receipt', $data);
    }
}
