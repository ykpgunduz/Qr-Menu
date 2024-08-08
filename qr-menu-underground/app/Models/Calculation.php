<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'total_amount',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
