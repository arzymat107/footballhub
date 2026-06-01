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
        'track_players', 'tiebreaker', 'start_date', 'end_date',
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

        $rows = array_values(array_map(
            fn ($row) => array_merge($row, [
                'goal_difference' => $row['goals_for'] - $row['goals_against'],
            ]),
            $table
        ));

        if ($this->tiebreaker === 'h2h_first') {
            $h2h = $this->buildH2hLookup($fixtures);
            usort($rows, function ($a, $b) use ($h2h) {
                if ($a['points'] !== $b['points']) {
                    return $b['points'] <=> $a['points'];
                }
                $aid = $a['team']->id;
                $bid = $b['team']->id;
                $ah2h = $h2h[$aid][$bid] ?? ['points' => 0, 'gd' => 0, 'gf' => 0];
                $bh2h = $h2h[$bid][$aid] ?? ['points' => 0, 'gd' => 0, 'gf' => 0];
                if ($ah2h['points'] !== $bh2h['points']) {
                    return $bh2h['points'] <=> $ah2h['points'];
                }
                if ($ah2h['gd'] !== $bh2h['gd']) {
                    return $bh2h['gd'] <=> $ah2h['gd'];
                }
                if ($a['goal_difference'] !== $b['goal_difference']) {
                    return $b['goal_difference'] <=> $a['goal_difference'];
                }

                return $b['goals_for'] <=> $a['goals_for'];
            });
        } else {
            usort($rows, function ($a, $b) {
                if ($a['points'] !== $b['points']) {
                    return $b['points'] <=> $a['points'];
                }
                if ($a['goal_difference'] !== $b['goal_difference']) {
                    return $b['goal_difference'] <=> $a['goal_difference'];
                }

                return $b['goals_for'] <=> $a['goals_for'];
            });
        }

        return collect($rows)->values();
    }

    private function buildH2hLookup(\Illuminate\Support\Collection $fixtures): array
    {
        $h2h = [];
        foreach ($fixtures as $fixture) {
            $home = $fixture->home_team_id;
            $away = $fixture->away_team_id;
            $hg = $fixture->home_score;
            $ag = $fixture->away_score;

            if ($hg > $ag) {
                $hp = 3; $ap = 0;
            } elseif ($hg < $ag) {
                $hp = 0; $ap = 3;
            } else {
                $hp = 1; $ap = 1;
            }

            $h2h[$home][$away] ??= ['points' => 0, 'gd' => 0, 'gf' => 0];
            $h2h[$home][$away]['points'] += $hp;
            $h2h[$home][$away]['gd']     += $hg - $ag;
            $h2h[$home][$away]['gf']     += $hg;

            $h2h[$away][$home] ??= ['points' => 0, 'gd' => 0, 'gf' => 0];
            $h2h[$away][$home]['points'] += $ap;
            $h2h[$away][$home]['gd']     += $ag - $hg;
            $h2h[$away][$home]['gf']     += $ag;
        }

        return $h2h;
    }
}