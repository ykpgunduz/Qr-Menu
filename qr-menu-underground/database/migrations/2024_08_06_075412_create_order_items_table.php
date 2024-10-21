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
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('table_number');
            $table->text('note')->nullable();
            $table->string('status')->default('Yeni Sipariş');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreign('table_number')->references('table_number')->on('calculations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
