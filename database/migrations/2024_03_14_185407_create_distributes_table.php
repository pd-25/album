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
        Schema::create('distributes', function (Blueprint $table) {
            $table->id();
            $table->boolean('release_start');
            $table->timestamp('release_start_date')->nullable();
            $table->string('music_distribution')->nullable();
            $table->boolean('monetization_facebook')->nullable();
            $table->integer('facebook_policy')->nullable();
            $table->boolean('monetization_youTube')->nullable();
            $table->integer('youTube_policy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributes');
    }
};
