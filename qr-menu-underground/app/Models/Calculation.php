<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'total_amount',
        'session_id',
        'order_number',
        'device_info',
        'status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'table_number', 'table_number');
    }

    public function updateTotalAmount()
    {
        $totalAmount = $this->orderItems()->sum(DB::raw('quantity * price'));
        $this->total_amount = $totalAmount;
        $this->save();
    }
}
