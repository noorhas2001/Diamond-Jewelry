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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->decimal('weight', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT);
            $table->decimal('equation' , AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT);
            $table->decimal('workmanship' , AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT);
            $table->decimal('total_weight' ,AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT);
            $table->decimal('total_workmanship' ,AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT);
            $table->softDeletes();
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
        Schema::dropIfExists('inventories');
    }
};
