<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancel extends Model
{
    protected $fillable = [
        'table_number',
        'product_info',
        'status',
        'description'
    ];
}
