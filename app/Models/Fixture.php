<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fixture extends Model
{
    protected $fillable = [
        'season_id', 'stage_id', 'round_id', 'stage_group_id', 'tie_id',
        'home_team_id', 'away_team_id', 'venue', 'scheduled_at', 'leg', 'status',
        'home_score', 'away_score',
        'home_score_et', 'away_score_et',
        'home_score_pen', 'away_score_pen',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(StageGroup::class, 'stage_group_id');
    }

    public function tie(): BelongsTo
    {
        return $this->belongsTo(Tie::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class)->orderBy('minute');
    }

    public function lineups(): HasMany
    {
        return $this->hasMany(FixtureLineup::class);
    }
}