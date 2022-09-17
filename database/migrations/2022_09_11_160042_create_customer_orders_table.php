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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->integer('total_price');
            $table->integer('point_use')->default(0);
            $table->integer('payment_status')->default(0);
            $table->string('payment_method');
            $table->string('customer_address1');
            $table->string('customer_address2');
            $table->text('order_status')->default('Processing');
            $table->date('delevered_at')->nullable();
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
        Schema::dropIfExists('customer_orders');
    }
};
