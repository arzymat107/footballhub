<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $fillable = ['name', 'nationality', 'date_of_birth', 'position'];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'player_team_seasons')
            ->withPivot('season_id', 'shirt_number')
            ->withTimestamps();
    }

    public function teamSeasons(): HasMany
    {
        return $this->hasMany(PlayerTeamSeason::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function lineups(): HasMany
    {
        return $this->hasMany(FixtureLineup::class);
    }

    public function stats(int $seasonId): array
    {
        $lineups = $this->lineups()
            ->whereHas('fixture', fn ($q) => $q->where('season_id', $seasonId)->where('status', 'completed'))
            ->get();

        $events = $this->events()
            ->whereHas('fixture', fn ($q) => $q->where('season_id', $seasonId)->where('status', 'completed'))
            ->get();

        $matchesPlayed = $lineups->count();
        $goals = $events->whereIn('type', ['goal', 'penalty_goal'])->count();
        $ownGoals = $events->where('type', 'own_goal')->count();
        $yellowCards = $events->where('type', 'yellow_card')->count();
        $redCards = $events->where('type', 'red_card')->count();
        $mvps = $lineups->where('is_mvp', true)->count();

        $result = compact('matchesPlayed', 'goals', 'ownGoals', 'yellowCards', 'redCards', 'mvps');

        if ($this->position === 'goalkeeper') {
            $result['goalsAgainst'] = $this->computeGoalsAgainst($seasonId);
            $result['cleanSheets'] = $this->computeCleanSheets($seasonId);
        }

        return $result;
    }

    private function computeGoalsAgainst(int $seasonId): int
    {
        return $this->lineups()
            ->whereHas('fixture', fn ($q) => $q->where('season_id', $seasonId)->where('status', 'completed'))
            ->with(['fixture.events'])
            ->get()
            ->sum(function (FixtureLineup $lineup) {
                return $lineup->fixture->events
                    ->whereIn('type', ['goal', 'own_goal'])
                    ->where('team_id', '!=', $lineup->team_id)
                    ->count();
            });
    }

    private function computeCleanSheets(int $seasonId): int
    {
        return $this->lineups()
            ->whereHas('fixture', fn ($q) => $q->where('season_id', $seasonId)->where('status', 'completed'))
            ->with(['fixture.events'])
            ->get()
            ->filter(function (FixtureLineup $lineup) {
                return $lineup->fixture->events
                    ->whereIn('type', ['goal', 'own_goal'])
                    ->where('team_id', '!=', $lineup->team_id)
                    ->isEmpty();
            })
            ->count();
    }
}