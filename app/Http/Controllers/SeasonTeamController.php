<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FixtureLineup;
use App\Models\PlayerTeamSeason;
use App\Models\Season;
use App\Models\Team;
use Inertia\Inertia;
use Inertia\Response;

class SeasonTeamController extends Controller
{
    public function show(Season $season, Team $team): Response
    {
        abort_unless($season->teams()->where('teams.id', $team->id)->exists(), 404);

        $season->load(['division.league']);

        $fixtures = $season->fixtures()
            ->with(['homeTeam', 'awayTeam', 'round'])
            ->where(fn ($q) => $q->where('home_team_id', $team->id)->orWhere('away_team_id', $team->id))
            ->orderBy('scheduled_at')
            ->get();

        $squad = PlayerTeamSeason::with('player')
            ->where('season_id', $season->id)
            ->where('team_id', $team->id)
            ->get();

        $fixtureIds = $fixtures->pluck('id');
        $playerIds = $squad->pluck('player_id');

        $lineups = FixtureLineup::whereIn('fixture_id', $fixtureIds)
            ->whereIn('player_id', $playerIds)
            ->where('team_id', $team->id)
            ->get()
            ->groupBy('player_id');

        $events = Event::whereIn('fixture_id', $fixtureIds)
            ->whereIn('player_id', $playerIds)
            ->get()
            ->groupBy('player_id');

        $squadData = $squad->map(function (PlayerTeamSeason $pts) use ($lineups, $events) {
            $pid = $pts->player_id;
            $playerLineups = $lineups->get($pid, collect());
            $playerEvents = $events->get($pid, collect());

            return [
                'player' => [
                    'id' => $pts->player->id,
                    'name' => $pts->player->name,
                    'position' => $pts->player->position,
                ],
                'shirt_number' => $pts->shirt_number,
                'joined_at' => $pts->joined_at?->format('Y-m-d'),
                'left_at' => $pts->left_at?->format('Y-m-d'),
                'played' => $playerLineups->count(),
                'goals' => $playerEvents->where('type', 'goal')->count(),
                'own_goals' => $playerEvents->where('type', 'own_goal')->count(),
                'yellow_cards' => $playerEvents->where('type', 'yellow_card')->count(),
                'red_cards' => $playerEvents->where('type', 'red_card')->count(),
                'mvp' => $playerLineups->where('is_mvp', true)->count(),
            ];
        })->sortBy('player.name')->values();

        return Inertia::render('public/SeasonTeamShow', [
            'season' => $season,
            'team' => $team,
            'fixtures' => $fixtures,
            'squad' => $squadData,
            'trackPlayers' => $season->track_players,
        ]);
    }
}