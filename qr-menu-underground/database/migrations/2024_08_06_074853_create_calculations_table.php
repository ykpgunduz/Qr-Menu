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
            $table->integer('table_number')->unique();
            $table->integer('total_amount')->default(0);
            $table->integer('customer')->nullable();
            $table->string('session_id')->nullable();
            $table->string('device_info')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculations');
    }
};
