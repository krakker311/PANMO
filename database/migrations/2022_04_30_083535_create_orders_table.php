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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id');
            $table->foreignId('category_id');
            $table->foreignId('city_id');
            $table->foreignId('model_id');
            $table->foreignId('user_id');
            $table->String('name');
            $table->string('address');
            $table->string('phone');
            $table->date('date');
            $table->time('time');
            $table->Boolean('isOrderAccepted');
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
        Schema::dropIfExists('orders');
    }
};
