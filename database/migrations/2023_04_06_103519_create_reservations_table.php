<?php

use App\Models\Reservation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(Reservation::CONFIRMED);
            $table->foreignId('added_by');
            $table->foreignId('resource_id');
            $table->foreignId('course_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->boolean('isHasUser')->default(true);
            $table->boolean('is_verified_payment')->default(false);
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
