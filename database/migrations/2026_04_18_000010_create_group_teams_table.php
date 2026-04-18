<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_teams', function (Blueprint $table) {
            $table->foreignId('stage_group_id')->constrained('stage_groups')->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->primary(['stage_group_id', 'team_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_teams');
    }
};