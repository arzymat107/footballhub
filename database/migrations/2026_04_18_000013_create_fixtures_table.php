<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stage_id')->constrained()->cascadeOnDelete();
            $table->foreignId('round_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('stage_group_id')->nullable()->constrained('stage_groups')->nullOnDelete();
            $table->foreignId('tie_id')->nullable()->constrained('ties')->nullOnDelete();
            $table->foreignId('home_team_id')->constrained('teams');
            $table->foreignId('away_team_id')->constrained('teams');
            $table->string('venue')->nullable();
            $table->dateTime('scheduled_at')->nullable();
            $table->enum('leg', ['single', 'first', 'second'])->default('single');
            $table->enum('status', ['scheduled', 'completed', 'postponed', 'cancelled'])->default('scheduled');
            $table->unsignedTinyInteger('home_score')->nullable();
            $table->unsignedTinyInteger('away_score')->nullable();
            $table->unsignedTinyInteger('home_score_et')->nullable();
            $table->unsignedTinyInteger('away_score_et')->nullable();
            $table->unsignedTinyInteger('home_score_pen')->nullable();
            $table->unsignedTinyInteger('away_score_pen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};