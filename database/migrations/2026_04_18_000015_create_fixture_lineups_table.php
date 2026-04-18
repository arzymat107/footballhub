<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixture_lineups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixture_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_mvp')->default(false);
            $table->unique(['fixture_id', 'player_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fixture_lineups');
    }
};