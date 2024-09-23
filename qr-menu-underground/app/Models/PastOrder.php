<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'table_number',
        'total_amount',
        'product_name',
        'quantity',
        'price',
        'cash_money',
        'credit_card',
        'price',
        'device_info',
        'note'
    ];
}
