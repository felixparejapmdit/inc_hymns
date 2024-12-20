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
        Schema::create('music_language', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_language');
    }
};
