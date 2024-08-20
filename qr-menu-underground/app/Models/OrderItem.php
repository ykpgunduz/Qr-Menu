<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'product_id',
        'quantity',
        'price',
        'status',
        'table_number',
    ];

    protected static function booted()
    {
        static::saved(function ($orderItem) {
            $totalAmount = DB::table('order_items')
                ->where('table_number', $orderItem->table_number)
                ->sum(DB::raw('quantity * price'));

            DB::table('calculations')
                ->where('table_number', $orderItem->table_number)
                ->update(['total_amount' => $totalAmount]);
        });
    }

    public function calculation()
    {
        return $this->belongsTo(Calculation::class, 'table_number', 'table_number');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
