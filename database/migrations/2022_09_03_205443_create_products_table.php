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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('category_name');
            $table->integer('sub_category_id');
            $table->string('sub_category_name');
            $table->string('product_code');
            $table->string('product_name');
            $table->text('product_brand');
            $table->text('product_color');
            $table->string('product_size')->nullable();
            $table->string('product_price');
            $table->integer('product_quantity');
            $table->integer('product_discount');
            $table->integer('product_discount_price');
            $table->text('product_details');
            $table->string('product_image');
            $table->text('product_status')->default('Enable');
            $table->integer('product_delete')->default(1);
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
        Schema::dropIfExists('products');
    }
};
