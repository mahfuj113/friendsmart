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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id('exc_id');
            $table->integer('exchanger_id');
            $table->string('exchange_product_name');
            $table->text('exchange_product_details');
            $table->string('exchange_product_image')->nullable();
            $table->integer('exchange_product_asking_price');
            $table->integer('exchange_product_sell_price')->nullable();
            $table->string('exchange_method')->nullable();
            $table->text('exchange_status')->default('Pending');
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
        Schema::dropIfExists('exchanges');
    }
};
