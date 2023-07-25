<?php

use App\Models\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(Subscription::CONFIRMED);
            $table->foreignId('user_id');
            $table->foreignId('course_id');
            $table->double('price')->unsigned();
            $table->boolean('isBasePrice')->default(true);
            $table->boolean('is_verified_payment')->default(false);
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
