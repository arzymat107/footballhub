<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('player_team_seasons', function (Blueprint $table) {
            $table->dropUnique(['player_id', 'team_id', 'season_id']);
            $table->date('joined_at')->nullable()->after('shirt_number');
            $table->date('left_at')->nullable()->after('joined_at');
        });
    }

    public function down(): void
    {
        Schema::table('player_team_seasons', function (Blueprint $table) {
            $table->dropColumn(['joined_at', 'left_at']);
            $table->unique(['player_id', 'team_id', 'season_id']);
        });
    }
};