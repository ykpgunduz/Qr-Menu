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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('service_rating');
            $table->unsignedTinyInteger('product_rating');
            $table->unsignedTinyInteger('ambiance_rating');
            $table->enum('return_response', ['yes', 'no']);
            $table->text('additional_comments')->nullable();
            $table->string('order_number');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
