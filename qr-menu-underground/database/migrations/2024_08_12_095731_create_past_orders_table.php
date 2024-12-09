<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('past_orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->integer('table_number');
            $table->integer('customer')->nullable();
            $table->integer('total_amount');
            $table->decimal('net_amount');
            $table->integer('ikram')->nullable();
            $table->integer('selfikram')->nullable();
            $table->text('products');
            $table->integer('quantity');
            $table->string('note')->default('-');
            $table->string('order_number');
            $table->integer('cash_money');
            $table->integer('credit_card');
            $table->integer('iban');
            $table->string('device_info')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('past_orders');
    }
};
