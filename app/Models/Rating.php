<?php

namespace App\Models;

use App\Models\PastOrder;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'service_rating',
        'product_rating',
        'ambiance_rating',
        'return_response',
        'additional_comments',
        'order_number',
    ];

    public function pastOrder()
    {
        return $this->belongsTo(PastOrder::class, 'order_number', 'order_number');
    }
}
