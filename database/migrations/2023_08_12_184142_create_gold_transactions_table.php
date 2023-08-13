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
        Schema::create('gold_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gold_delar_id');
            $table->enum('transaction_type', ['استلام', 'دفعة']);
            $table->text('item')->nullable();
            $table->decimal('weight', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
            $table->decimal('workmanship', AMOUNT_TOTAL_DIGITS, AMOUNT_TOTAL_DIGITS_FLOAT)->nullable();
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
        Schema::dropIfExists('gold_transactions');
    }
};
