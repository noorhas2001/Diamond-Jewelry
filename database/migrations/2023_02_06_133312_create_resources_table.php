<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resources', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by');
            $table->foreignId('category_id');
            $table->string('name', 200);
            $table->string('description')->nullable();
            $table->integer('number_seats')->default(1);
            $table->string('images')->default('[]');
            $table->integer('thumbnail_img')->nullable();
            $table->double('price_by_hour')->nullable()->unsigned();
            $table->double('price_by_day')->nullable()->unsigned();
            $table->double('price_by_weak')->nullable()->unsigned();
            $table->double('price_by_month')->nullable()->unsigned();
            $table->boolean('published')->default(true)->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
