<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\PlayerTeamSeason;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FixtureDetailController extends Controller
{
    public function show(Fixture $fixture): Response
    {
        $fixture->load(['homeTeam', 'awayTeam', 'season', 'round']);

        $seasonPlayers = PlayerTeamSeason::with('player')
            ->where('season_id', $fixture->season_id)
            ->whereIn('team_id', [$fixture->home_team_id, $fixture->away_team_id])
            ->get()
            ->groupBy('team_id');

        $lineups = FixtureLineup::with('player')
            ->where('fixture_id', $fixture->id)
            ->get()
            ->groupBy('team_id');

        $events = Event::with('player', 'team')
            ->where('fixture_id', $fixture->id)
            ->orderBy('minute')
            ->get();

        return Inertia::render('admin/fixtures/Detail', [
            'fixture' => $fixture,
            'seasonPlayers' => $seasonPlayers,
            'lineups' => $lineups,
            'events' => $events,
        ]);
    }

    public function storeLineup(Request $request, Fixture $fixture): RedirectResponse
    {
        $data = $request->validate([
            'team_id' => 'required|in:' . $fixture->home_team_id . ',' . $fixture->away_team_id,
            'player_id' => 'required|exists:players,id',
            'is_mvp' => 'boolean',
        ]);

        FixtureLineup::updateOrCreate(
            ['fixture_id' => $fixture->id, 'player_id' => $data['player_id']],
            ['team_id' => $data['team_id'], 'is_mvp' => $data['is_mvp'] ?? false]
        );

        return back();
    }

    public function destroyLineup(Fixture $fixture, FixtureLineup $lineup): RedirectResponse
    {
        abort_if($lineup->fixture_id !== $fixture->id, 403);
        $lineup->delete();

        return back();
    }

    public function storeEvent(Request $request, Fixture $fixture): RedirectResponse
    {
        $data = $request->validate([
            'team_id' => 'required|in:' . $fixture->home_team_id . ',' . $fixture->away_team_id,
            'player_id' => 'required|exists:players,id',
            'type' => 'required|in:goal,own_goal,yellow_card,red_card',
            'minute' => 'required|integer|min:1|max:120',
        ]);

        Event::create(array_merge($data, ['fixture_id' => $fixture->id]));

        return back();
    }

    public function destroyEvent(Fixture $fixture, Event $event): RedirectResponse
    {
        abort_if($event->fixture_id !== $fixture->id, 403);
        $event->delete();

        return back();
    }
}