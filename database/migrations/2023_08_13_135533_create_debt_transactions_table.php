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
        Schema::create('debt_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id');
            $table->enum('transaction_type', ['سداد', 'سحب']);
            $table->decimal('weight', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->decimal('amount', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->date('date');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('debt_transactions');
    }
};
