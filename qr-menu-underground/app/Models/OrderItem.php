<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status',
        'table_number',
    ];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
