<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('language')->nullable();
            $table->string('release_title')->nullable();
            $table->string('title_version')->nullable();
            $table->boolean('is_various_artist')->nullable();
            $table->string('genre_one')->nullable();
            $table->string('genre_two')->nullable();
            $table->string('p_copy')->nullable();
            $table->string('c_copy')->nullable();
            $table->boolean('previously_release')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->string('label_id')->nullable();
            $table->string('internal_release_id')->nullable();
            $table->string('upc_ean_jan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
