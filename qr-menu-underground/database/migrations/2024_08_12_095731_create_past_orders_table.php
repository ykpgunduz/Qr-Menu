<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('past_orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->integer('table_number');
            $table->decimal('total_amount', 8, 2);
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('price');
            $table->string('device_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('past_orders');
    }
};
