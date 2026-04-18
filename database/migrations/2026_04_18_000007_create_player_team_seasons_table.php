<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_team_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('shirt_number')->nullable();
            $table->unique(['player_id', 'team_id', 'season_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_team_seasons');
    }
};