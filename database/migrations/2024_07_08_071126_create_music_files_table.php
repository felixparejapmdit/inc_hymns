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
     Schema::create('music_files', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->bigInteger('music_id')->unsigned();
        $table->string('title');
        $table->string('music_score_path')->nullable();
        $table->string('lyrics_path')->nullable();
        $table->string('vocals_mp3_path')->nullable();
        $table->string('organ_mp3_path')->nullable();
        $table->string('preludes_mp3_path')->nullable();
        $table->integer('created_by')->nullable();
        $table->integer('updated_by')->nullable();
        $table->timestamps();

        $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_files');
    }
};
