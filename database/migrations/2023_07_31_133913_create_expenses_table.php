<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT);
            $table->foreignId('currency_id');
            $table->dateTime('draw_date');
            $table->boolean('is_from_masa');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
