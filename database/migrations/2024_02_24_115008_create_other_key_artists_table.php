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
        Schema::create('other_key_artists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('other_key_artist_name')->nullable();
            $table->integer('role')->nullable();
            $table->boolean('other_key_Spotify')->nullable();
            $table->boolean('other_key_apple_music')->nullable();
            $table->string('other_key_Spotify_details')->nullable();
            $table->string('other_key_apple_music_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_key_artists');
    }
};
