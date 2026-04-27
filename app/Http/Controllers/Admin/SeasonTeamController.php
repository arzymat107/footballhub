<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerTeamSeason;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SeasonTeamController extends Controller
{
    public function show(Season $season, Team $team): Response
    {
        abort_unless($season->teams()->where('teams.id', $team->id)->exists(), 404);

        $season->load('division.league');

        $registrations = PlayerTeamSeason::with('player')
            ->where('season_id', $season->id)
            ->where('team_id', $team->id)
            ->orderBy('shirt_number')
            ->get();

        $activePlayerIds = $registrations->whereNull('left_at')->pluck('player_id');

        $availablePlayers = Player::whereNotIn('id', $activePlayerIds)
            ->orderBy('name')
            ->get(['id', 'name', 'position']);

        return Inertia::render('admin/seasons/TeamShow', [
            'season' => $season,
            'team' => $team,
            'registrations' => $registrations,
            'availablePlayers' => $availablePlayers,
        ]);
    }

    public function store(Request $request, Season $season, Team $team): RedirectResponse
    {
        abort_unless($season->teams()->where('teams.id', $team->id)->exists(), 404);

        $data = $request->validate([
            'player_id' => 'required|exists:players,id',
            'shirt_number' => 'nullable|integer|min:1|max:99',
            'joined_at' => 'nullable|date',
        ]);

        PlayerTeamSeason::create([
            'player_id' => $data['player_id'],
            'team_id' => $team->id,
            'season_id' => $season->id,
            'shirt_number' => $data['shirt_number'] ?? null,
            'joined_at' => $data['joined_at'] ?? null,
        ]);

        return back();
    }

    public function update(Request $request, Season $season, Team $team, PlayerTeamSeason $registration): RedirectResponse
    {
        abort_if($registration->season_id !== $season->id || $registration->team_id !== $team->id, 403);

        $data = $request->validate([
            'left_at' => 'nullable|date',
        ]);

        $registration->update(['left_at' => $data['left_at']]);

        return back();
    }

    public function destroy(Season $season, Team $team, PlayerTeamSeason $registration): RedirectResponse
    {
        abort_if($registration->season_id !== $season->id || $registration->team_id !== $team->id, 403);
        $registration->delete();

        return back();
    }
}