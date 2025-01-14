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
        'ikram',
        'session_id',
        'order_number',
        'device_info',
        'status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'table_number', 'table_number');
    }
}
