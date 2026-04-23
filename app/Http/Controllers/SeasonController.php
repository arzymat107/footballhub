<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FixtureLineup;
use App\Models\Season;
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

        $leagueStage = $season->stages->firstWhere('type', 'league')
            ?? $season->stages->first();

        $standings = $leagueStage
            ? $season->standings($leagueStage->id)
            : collect();

        $playerStats = $this->playerStats($season->id);

        return Inertia::render('public/SeasonShow', [
            'season' => $season,
            'fixtures' => $fixtures,
            'standings' => $standings,
            'playerStats' => $season->track_players ? $playerStats : [],
        ]);
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
                    'team' => ['id' => $lineup->team->id, 'name' => $lineup->team->name],
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
                    'team' => ['id' => $event->team->id, 'name' => $event->team->name],
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

        return collect($stats)
            ->sortByDesc('goals')
            ->values()
            ->toArray();
    }
}