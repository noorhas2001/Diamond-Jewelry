<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('gold_delars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('total_weight', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->decimal('total_workmanship', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->string('phone_number');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('gold_delars');
    }
};
