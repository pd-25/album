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
        Schema::create('track_artists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->unsignedBigInteger('track_id')->nullable();
            $table->unsignedBigInteger('track_artist_id')->nullable();
            $table->boolean('has_spotify')->nullable();
            $table->boolean('has_applemusic')->nullable();
            $table->string('track_spotify_id')->nullable();
            $table->string('track_apple_id')->nullable();
            $table->string('role')->nullable();
            
            $table->string('share')->nullable();
            $table->string('publishing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_artists');
    }
};
