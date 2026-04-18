<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Season extends Model
{
    protected $fillable = [
        'division_id', 'name', 'format', 'status',
        'track_players', 'start_date', 'end_date',
    ];

    protected $casts = [
        'track_players' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'season_teams')->withTimestamps();
    }

    public function stages(): HasMany
    {
        return $this->hasMany(Stage::class)->orderBy('order');
    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }

    public function playerTeamSeasons(): HasMany
    {
        return $this->hasMany(PlayerTeamSeason::class);
    }

    public function standings(int $stageId, ?int $groupId = null): \Illuminate\Support\Collection
    {
        $fixtures = Fixture::with('events')
            ->where('season_id', $this->id)
            ->where('stage_id', $stageId)
            ->where('status', 'completed')
            ->when($groupId, fn ($q) => $q->where('stage_group_id', $groupId))
            ->get();

        $teams = $this->teams;
        $table = [];

        foreach ($teams as $team) {
            $table[$team->id] = [
                'team' => $team,
                'played' => 0, 'won' => 0, 'drawn' => 0, 'lost' => 0,
                'goals_for' => 0, 'goals_against' => 0, 'points' => 0,
            ];
        }

        foreach ($fixtures as $fixture) {
            $home = $fixture->home_team_id;
            $away = $fixture->away_team_id;

            if (! isset($table[$home], $table[$away])) {
                continue;
            }

            $hg = $fixture->home_score;
            $ag = $fixture->away_score;

            $table[$home]['played']++;
            $table[$away]['played']++;
            $table[$home]['goals_for'] += $hg;
            $table[$home]['goals_against'] += $ag;
            $table[$away]['goals_for'] += $ag;
            $table[$away]['goals_against'] += $hg;

            if ($hg > $ag) {
                $table[$home]['won']++;
                $table[$home]['points'] += 3;
                $table[$away]['lost']++;
            } elseif ($hg < $ag) {
                $table[$away]['won']++;
                $table[$away]['points'] += 3;
                $table[$home]['lost']++;
            } else {
                $table[$home]['drawn']++;
                $table[$away]['drawn']++;
                $table[$home]['points']++;
                $table[$away]['points']++;
            }
        }

        return collect(array_values($table))
            ->map(fn ($row) => array_merge($row, [
                'goal_difference' => $row['goals_for'] - $row['goals_against'],
            ]))
            ->sortByDesc(fn ($row) => [$row['points'], $row['goal_difference'], $row['goals_for']])
            ->values();
    }
}