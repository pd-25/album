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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('adminId')->nullable();
            $table->integer('userId');
            $table->integer('earning')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('adjust_earning')->nullable();
            $table->string('earning_referance')->nullable();
            $table->string('type')->comment('E=Earning, D=Deduction')->nullable();
            $table->boolean('status')->default(0)->comment('0=pending, 1=approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
