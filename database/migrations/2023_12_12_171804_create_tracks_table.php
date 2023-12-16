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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->string('audio')->nullable();
            $table->string('language_t')->nullable();
            $table->string('track_title_version')->nullable();
            $table->string('title_version')->nullable();
            $table->boolean('has_isrc')->nullable();
            $table->string('isrc_code')->nullable();
            $table->string('explicit_lyrics')->nullable();
            $table->boolean('original_public')->nullable()->comment('0=>original, 1=>public');
            $table->string('genre_one_track')->nullable();
            $table->string('genre_two_track')->nullable();
            $table->string('p_copy_t')->nullable();
            $table->string('c_copy_t')->nullable();
            $table->string('track_label_id')->nullable();
            $table->string('internal_track_id')->nullable();
            $table->longText('lyrics')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
