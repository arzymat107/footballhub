<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerTeamSeason;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SquadController extends Controller
{
    public function show(Season $season): Response
    {
        $season->load(['division.league', 'teams']);

        $squads = PlayerTeamSeason::with('player', 'team')
            ->where('season_id', $season->id)
            ->orderBy('team_id')
            ->orderBy('shirt_number')
            ->get()
            ->groupBy('team_id');

        return Inertia::render('admin/seasons/Squad', [
            'season' => $season,
            'squads' => $squads,
            'players' => Player::orderBy('name')->get(['id', 'name', 'position']),
        ]);
    }

    public function store(Request $request, Season $season): RedirectResponse
    {
        $data = $request->validate([
            'player_id' => 'required|exists:players,id',
            'team_id' => 'required|exists:teams,id|in:' . $season->teams->pluck('id')->join(','),
            'shirt_number' => 'nullable|integer|min:1|max:99',
            'joined_at' => 'nullable|date',
        ]);

        PlayerTeamSeason::create([
            'player_id' => $data['player_id'],
            'team_id' => $data['team_id'],
            'season_id' => $season->id,
            'shirt_number' => $data['shirt_number'] ?? null,
            'joined_at' => $data['joined_at'] ?? null,
        ]);

        return back();
    }

    public function update(Request $request, Season $season, PlayerTeamSeason $registration): RedirectResponse
    {
        abort_if($registration->season_id !== $season->id, 403);

        $data = $request->validate([
            'left_at' => 'nullable|date',
        ]);

        $registration->update(['left_at' => $data['left_at']]);

        return back();
    }

    public function destroy(Season $season, PlayerTeamSeason $registration): RedirectResponse
    {
        abort_if($registration->season_id !== $season->id, 403);
        $registration->delete();

        return back();
    }
}