<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use Inertia\Inertia;
use Inertia\Response;

class FixtureController extends Controller
{
    public function show(Fixture $fixture): Response
    {
        $fixture->load(['homeTeam', 'awayTeam', 'season.division.league', 'round']);

        $lineups = FixtureLineup::with('player')
            ->where('fixture_id', $fixture->id)
            ->get()
            ->groupBy('team_id')
            ->map(fn ($group) => $group->map(fn ($l) => [
                'id' => $l->id,
                'is_mvp' => $l->is_mvp,
                'player' => [
                    'id' => $l->player->id,
                    'name' => $l->player->name,
                    'position' => $l->player->position,
                ],
            ])->values());

        $events = Event::with('player', 'team')
            ->where('fixture_id', $fixture->id)
            ->orderBy('minute')
            ->get()
            ->map(fn ($e) => [
                'id' => $e->id,
                'type' => $e->type,
                'minute' => $e->minute,
                'player' => ['id' => $e->player->id, 'name' => $e->player->name],
                'team_id' => $e->team_id,
            ]);

        return Inertia::render('public/FixtureShow', [
            'fixture' => $fixture,
            'lineups' => $lineups,
            'events' => $events,
        ]);
    }
}