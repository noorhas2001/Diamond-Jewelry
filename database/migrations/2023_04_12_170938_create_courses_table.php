<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->default(1);
            $table->integer('image')->nullable();
            $table->foreignId('added_by');
            $table->double('price')->default(0)->unsigned();
            $table->integer('hours')->unsigned();
            $table->integer('lecture_hours')->unsigned();
            $table->integer('number_seats')->nullable();
            $table->text('description')->nullable();
            $table->json('course_days');
            $table->dateTime('start_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
