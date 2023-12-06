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
        Schema::create('user_order_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('order_list');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('qty');
            $table->integer('total');
            $table->integer('order_code');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_order_lists');
    }
};
