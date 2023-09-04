<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->string('person_name');
            $table->decimal('amount', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->datetime('debt_date');
            $table->boolean('is_debt_from_others');
            $table->foreignId('currency_id')->nullable();
            $table->decimal('weight', AMOUNT_TOTAL_DIGITS , AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('is_paid')->default(DEFAULT_ID_PAID_VALUE);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('debts');
    }
};
