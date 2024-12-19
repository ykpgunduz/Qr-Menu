<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'table_number',
        'product_id',
        'quantity',
        'price',
        'status',
        'note',
    ];

    /**
     * Define the relationship with the Calculation model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function calculation()
    {
        return $this->belongsTo(Calculation::class, 'table_number', 'table_number');
    }

    /**
     * Define the relationship with the Product model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (OrderItem $orderItem) {
            $orderItem->recalculateTotal();
        });

        static::updated(function (OrderItem $orderItem) {
            $orderItem->recalculateTotal();
        });

        static::deleted(function (OrderItem $orderItem) {
            $orderItem->recalculateTotal();
        });
    }

    /**
     * Recalculate the total amount for the associated calculation.
     *
     * @return void
     */
    public function recalculateTotal()
    {
        $calculation = $this->calculation;

        if ($calculation) {
            $totalAmount = DB::table('order_items')
                ->where('table_number', $this->table_number)
                ->sum(DB::raw('quantity * price'));

            $totalAmount -= $calculation->ikram ?? 0;

            $calculation->update(['total_amount' => $totalAmount]);
        }
    }
}
