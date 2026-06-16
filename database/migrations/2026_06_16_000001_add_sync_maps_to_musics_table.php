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
        Schema::table('musics', function (Blueprint $table) {
            $table->json('lyrics_sync')->nullable()->after('lyrics');
            $table->json('score_sync')->nullable()->after('lyrics_sync');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('musics', function (Blueprint $table) {
            $table->dropColumn(['lyrics_sync', 'score_sync']);
        });
    }
};
