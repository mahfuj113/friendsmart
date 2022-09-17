<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('visitor_id');
            $table->integer('cart_product_id');
            $table->string('cart_product_color')->nullable();
            $table->string('cart_product_size')->nullable();
            $table->integer('cart_product_quantity')->nullable();
            $table->integer('cart_order_id')->nullable();
            $table->integer('cart_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
