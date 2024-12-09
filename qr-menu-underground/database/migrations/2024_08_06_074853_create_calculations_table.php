<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->integer('customer')->nullable();
            $table->string('order_number');
            $table->string('session_id')->nullable();
            $table->integer('table_number')->unique();
            $table->string('device_info')->nullable();
            $table->string('status')->default('Aktif');
            $table->integer('total_amount')->default(0);
            $table->integer('ikram')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculations');
    }
};
