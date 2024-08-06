<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('calculations')->onDelete('cascade'); // Sipariş ID'si
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Ürün ID'si
            $table->integer('quantity'); // Miktar
            $table->decimal('price', 10, 2); // Fiyat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
