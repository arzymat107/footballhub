<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StageGroup extends Model
{
    protected $fillable = ['stage_id', 'name', 'teams_advancing'];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'group_teams', 'stage_group_id', 'team_id');
    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'stage_group_id');
    }
}