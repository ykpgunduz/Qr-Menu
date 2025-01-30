<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Calculation;
use App\Models\PastOrder;

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

        $pastOrder = PastOrder::where('table_number', $table_number)
            ->whereDate('created_at', $calculation->created_at->toDateString())
            ->first();

        $data = [
            'table_number' => $calculation->table_number,
            'customer' => $calculation->customer,
            'order_number' => $calculation->order_number,
            'order_items' => $orderItems,
            'total_amount' => $calculation->total_amount,
            'created_at' => $calculation->created_at,
            'cafe_name' => $cafe->name ?? 'Cafe Adı',
            'cafe_description' => $cafe->description ?? 'Açıklama',
            'cafe_address' => $cafe->address ?? 'Adres Bilgisi',
            'cafe_phone' => $cafe->phone ?? 'Telefon Bilgisi',
            'cafe_insta_name' => $cafe->insta_name ?? 'Instagram Adı',
            'payment_info' => $pastOrder ? [
                'cash_money' => $pastOrder->cash_money,
                'credit_card' => $pastOrder->credit_card,
                'iban' => $pastOrder->iban,
                'ikram' => $pastOrder->ikram,
                'selfikram' => $pastOrder->selfikram,
            ] : null,
        ];

        return view('receipt', $data);
    }

    public function print(PastOrder $calculation)
    {
        // Toplam ürün miktarını alalım
        $totalQuantity = $calculation->quantity;

        // Ürün başına ortalama fiyatı hesaplayalım (ikramlar hariç)
        $pricePerItem = ($calculation->total_amount + $calculation->ikram + $calculation->selfikram) / $totalQuantity;

        $orderItems = collect(explode(',', $calculation->products))->map(function ($item) use ($pricePerItem) {
            $parts = explode('x', $item);
            $quantity = (int)trim($parts[0]);

            return [
                'quantity' => $quantity,
                'product_name' => trim($parts[1] ?? ''),
                'price' => round($pricePerItem * $quantity), // Her ürün için toplam fiyat
            ];
        });

        $cafe = Cafe::first();

        $data = [
            'table_number' => $calculation->table_number,
            'customer' => $calculation->customer,
            'order_number' => $calculation->order_number,
            'order_items' => $orderItems,
            'total_amount' => $calculation->total_amount,
            'created_at' => $calculation->created_at,
            'cafe_name' => $cafe->name ?? 'Cafe Adı',
            'cafe_description' => $cafe->description ?? 'Açıklama',
            'cafe_address' => $cafe->address ?? 'Adres Bilgisi',
            'cafe_phone' => $cafe->phone ?? 'Telefon Bilgisi',
            'cafe_insta_name' => $cafe->insta_name ?? 'Instagram Adı',
            'payment_info' => [
                'cash_money' => $calculation->cash_money,
                'credit_card' => $calculation->credit_card,
                'iban' => $calculation->iban,
                'ikram' => $calculation->ikram,
                'selfikram' => $calculation->selfikram,
            ],
        ];

        return view('receipt', $data);
    }
}
