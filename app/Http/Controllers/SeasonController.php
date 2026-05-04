<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FixtureLineup;
use App\Models\PlayerTeamSeason;
use App\Models\Season;
use App\Models\Stage;
use Inertia\Inertia;
use Inertia\Response;

class SeasonController extends Controller
{
    public function show(Season $season): Response
    {
        $season->load(['division.league', 'teams', 'stages']);

        $fixtures = $season->fixtures()
            ->with(['homeTeam', 'awayTeam', 'round'])
            ->orderBy('scheduled_at')
            ->get();

        $stages = $season->stages->map(fn (Stage $stage) => $this->stageData($stage, $season));

        $playerStats = $this->playerStats($season->id);

        return Inertia::render('public/SeasonShow', [
            'season'      => $season,
            'fixtures'    => $fixtures,
            'stages'      => $stages,
            'playerStats' => $season->track_players ? $playerStats : [],
        ]);
    }

    private function stageData(Stage $stage, Season $season): array
    {
        $data = ['id' => $stage->id, 'name' => $stage->name, 'type' => $stage->type];

        if ($stage->type === 'league') {
            $data['standings'] = $season->standings($stage->id)->values();
        } elseif ($stage->type === 'group') {
            $stage->loadMissing('groups');
            $data['groups'] = $stage->groups->map(fn ($g) => [
                'id'        => $g->id,
                'name'      => $g->name,
                'standings' => $season->standings($stage->id, $g->id)->values(),
            ])->values();
        } elseif ($stage->type === 'knockout') {
            $stage->loadMissing('rounds.ties.homeTeam', 'rounds.ties.awayTeam', 'rounds.ties.winner', 'rounds.ties.fixtures');
            $data['wins_required'] = $stage->wins_required;
            $data['rounds'] = $stage->rounds->map(fn ($round) => [
                'id'   => $round->id,
                'name' => $round->name,
                'ties' => $round->ties->map(function ($tie) {
                    $completed = $tie->fixtures
                        ->where('status', 'completed')
                        ->sortBy('scheduled_at');

                    $legs = $completed->map(function ($f) use ($tie) {
                        $fromHome = $f->home_team_id === $tie->home_team_id;
                        $home = $fromHome ? $f->home_score : $f->away_score;
                        $away = $fromHome ? $f->away_score : $f->home_score;
                        $penHome = null;
                        $penAway = null;
                        if ($home === $away) {
                            $penHome = $fromHome ? $f->home_score_pen : $f->away_score_pen;
                            $penAway = $fromHome ? $f->away_score_pen : $f->home_score_pen;
                        }
                        return ['home' => $home, 'away' => $away, 'pen_home' => $penHome, 'pen_away' => $penAway];
                    })->values();

                    $homeWins = $legs->filter(fn ($l) =>
                        $l['home'] > $l['away'] ||
                        ($l['home'] === $l['away'] && $l['pen_home'] !== null && $l['pen_home'] > $l['pen_away'])
                    )->count();
                    $awayWins = $legs->filter(fn ($l) =>
                        $l['away'] > $l['home'] ||
                        ($l['home'] === $l['away'] && $l['pen_away'] !== null && $l['pen_away'] > $l['pen_home'])
                    )->count();

                    return [
                        'id'        => $tie->id,
                        'home_team' => ['id' => $tie->homeTeam->id, 'name' => $tie->homeTeam->name],
                        'away_team' => ['id' => $tie->awayTeam->id, 'name' => $tie->awayTeam->name],
                        'winner'    => $tie->winner ? ['id' => $tie->winner->id, 'name' => $tie->winner->name] : null,
                        'status'    => $tie->status,
                        'legs'       => $legs,
                        'home_wins'  => $homeWins,
                        'away_wins'  => $awayWins,
                    ];
                })->values(),
            ])->values();
        }

        return $data;
    }

    private function playerStats(int $seasonId): array
    {
        $completedFixtureIds = Season::find($seasonId)
            ->fixtures()
            ->where('status', 'completed')
            ->pluck('id');

        $lineups = FixtureLineup::with('player', 'team')
            ->whereIn('fixture_id', $completedFixtureIds)
            ->get();

        $events = Event::with('player', 'team')
            ->whereIn('fixture_id', $completedFixtureIds)
            ->get();

        $stats = [];

        foreach ($lineups as $lineup) {
            $pid = $lineup->player_id;
            if (!isset($stats[$pid])) {
                $stats[$pid] = [
                    'player' => ['id' => $lineup->player->id, 'name' => $lineup->player->name, 'position' => $lineup->player->position],
                    'team'   => ['id' => $lineup->team->id, 'name' => $lineup->team->name],
                    'played' => 0, 'goals' => 0, 'own_goals' => 0,
                    'yellow_cards' => 0, 'red_cards' => 0, 'mvp' => 0,
                ];
            }
            $stats[$pid]['played']++;
            if ($lineup->is_mvp) {
                $stats[$pid]['mvp']++;
            }
        }

        foreach ($events as $event) {
            $pid = $event->player_id;
            if (!isset($stats[$pid])) {
                $stats[$pid] = [
                    'player' => ['id' => $event->player->id, 'name' => $event->player->name, 'position' => $event->player->position],
                    'team'   => ['id' => $event->team->id, 'name' => $event->team->name],
                    'played' => 0, 'goals' => 0, 'own_goals' => 0,
                    'yellow_cards' => 0, 'red_cards' => 0, 'mvp' => 0,
                ];
            }
            match ($event->type) {
                'goal'        => $stats[$pid]['goals']++,
                'own_goal'    => $stats[$pid]['own_goals']++,
                'yellow_card' => $stats[$pid]['yellow_cards']++,
                'red_card'    => $stats[$pid]['red_cards']++,
                default       => null,
            };
        }

        // Override team with the player's current active registration for this season
        $activeTeams = PlayerTeamSeason::with('team')
            ->where('season_id', $seasonId)
            ->whereIn('player_id', array_keys($stats))
            ->whereNull('left_at')
            ->get()
            ->keyBy('player_id');

        foreach ($stats as $pid => &$s) {
            if ($activeTeams->has($pid)) {
                $t = $activeTeams[$pid]->team;
                $s['team'] = ['id' => $t->id, 'name' => $t->name];
            }
        }
        unset($s);

        return collect($stats)
            ->sortByDesc('goals')
            ->values()
            ->toArray();
    }
}