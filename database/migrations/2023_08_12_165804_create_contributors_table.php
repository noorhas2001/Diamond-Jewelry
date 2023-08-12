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
        Schema::create('contributors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('shekels_balance', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->decimal('dollars_balance', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->decimal('dinars_balance', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('contributors');
    }
};
