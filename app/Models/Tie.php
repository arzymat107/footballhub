<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tie extends Model
{
    protected $fillable = ['round_id', 'home_team_id', 'away_team_id', 'winner_id', 'status'];

    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'winner_id');
    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }

    public function aggregateScore(): array
    {
        $legs = $this->fixtures()->where('status', 'completed')->get();

        $homeGoals = 0;
        $awayGoals = 0;

        foreach ($legs as $fixture) {
            if ($fixture->home_team_id === $this->home_team_id) {
                $homeGoals += $fixture->home_score ?? 0;
                $awayGoals += $fixture->away_score ?? 0;
            } else {
                $homeGoals += $fixture->away_score ?? 0;
                $awayGoals += $fixture->home_score ?? 0;
            }
        }

        return ['home' => $homeGoals, 'away' => $awayGoals];
    }
}