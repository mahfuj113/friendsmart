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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('visitor_gender');
            $table->string('visitor_email');
            $table->string('visitor_phone');
            $table->text('visitor_address');
            $table->string('visitor_password');
            $table->text('visitor_status')->default('Enable');
            $table->integer('visitor_delete')->default(1);
            $table->integer('visitor_points')->default(0);
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
        Schema::dropIfExists('visitors');
    }
};
