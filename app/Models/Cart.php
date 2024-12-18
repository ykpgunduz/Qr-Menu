<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['session_id', 'table_number', 'product_id', 'quantity', 'price', 'device_info'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
