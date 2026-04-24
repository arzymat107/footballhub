<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Fixture;
use App\Models\FixtureLineup;
use App\Models\Player;
use App\Models\PlayerTeamSeason;
use App\Models\Round;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FixtureController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Fixture::with(['homeTeam', 'awayTeam', 'season.division.league', 'round'])
            ->orderByDesc('scheduled_at');

        if ($request->filled('season_id')) {
            $query->where('season_id', $request->season_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return Inertia::render('admin/fixtures/Index', [
            'fixtures' => $query->paginate(25)->withQueryString(),
            'seasons' => Season::with('division.league')->orderByDesc('start_date')->get(['id', 'name', 'division_id']),
            'filters' => $request->only(['season_id', 'status']),
        ]);
    }

    public function create(Request $request): Response
    {
        $round = $request->filled('round_id')
            ? Round::with('stage.season')->find($request->round_id)
            : null;

        return Inertia::render('admin/fixtures/Form', [
            'seasons' => Season::with('division.league')->orderByDesc('start_date')->get(['id', 'name', 'division_id']),
            'teams' => Team::orderBy('name')->get(['id', 'name']),
            'rounds' => Round::orderBy('name')->get(['id', 'name', 'stage_id']),
            'roundId' => $round?->id,
            'seasonId' => $round?->stage->season->id,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'round_id' => 'nullable|exists:rounds,id',
            'home_team_id' => 'required|exists:teams,id|different:away_team_id',
            'away_team_id' => 'required|exists:teams,id',
            'scheduled_at' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
        ]);

        if (!empty($data['round_id'])) {
            $round = Round::find($data['round_id']);
            $data['stage_id'] = $round->stage_id;
        }

        $fixture = Fixture::create($data);

        if ($data['status'] === 'completed') {
            return redirect()->route('admin.fixtures.edit', $fixture->id)->with('success', 'Fixture created. Now add lineup & events.');
        }

        if (!empty($data['round_id'])) {
            return redirect()->route('admin.rounds.show', $data['round_id'])->with('success', 'Fixture created.');
        }

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture created.');
    }

    public function edit(Fixture $fixture): Response
    {
        $fixture->load(['homeTeam', 'awayTeam', 'season', 'round']);

        $seasonPlayerRecords = PlayerTeamSeason::with('player')
            ->where('season_id', $fixture->season_id)
            ->whereIn('team_id', [$fixture->home_team_id, $fixture->away_team_id])
            ->get();

        $seasonPlayers = $seasonPlayerRecords
            ->groupBy('team_id')
            ->map(fn ($group) => $group->map(fn ($r) => [
                'id' => $r->player->id,
                'name' => $r->player->name,
                'position' => $r->player->position,
            ])->values());

        $registeredPlayerIds = $seasonPlayerRecords->pluck('player_id')->unique();
        $allPlayers = Player::whereNotIn('id', $registeredPlayerIds)
            ->orderBy('name')
            ->get(['id', 'name', 'position']);

        $lineups = FixtureLineup::with('player')
            ->where('fixture_id', $fixture->id)
            ->get()
            ->groupBy('team_id')
            ->map(fn ($group) => $group->map(fn ($l) => [
                'id' => $l->id,
                'is_mvp' => $l->is_mvp,
                'player' => ['id' => $l->player->id, 'name' => $l->player->name],
            ])->values());

        $events = Event::with('player', 'team')
            ->where('fixture_id', $fixture->id)
            ->orderBy('minute')
            ->get();

        return Inertia::render('admin/fixtures/Form', [
            'fixture' => $fixture,
            'seasons' => Season::with('division.league')->orderByDesc('start_date')->get(['id', 'name', 'division_id']),
            'teams' => Team::orderBy('name')->get(['id', 'name']),
            'rounds' => Round::orderBy('name')->get(['id', 'name', 'stage_id']),
            'roundId' => null,
            'seasonId' => null,
            'seasonPlayers' => $seasonPlayers,
            'allPlayers' => $allPlayers,
            'lineups' => $lineups,
            'events' => $events,
        ]);
    }

    public function attachPlayer(Request $request, Fixture $fixture): RedirectResponse
    {
        $data = $request->validate([
            'player_id' => 'required|exists:players,id',
            'team_id' => 'required|in:' . $fixture->home_team_id . ',' . $fixture->away_team_id,
        ]);

        PlayerTeamSeason::firstOrCreate([
            'player_id' => $data['player_id'],
            'team_id' => $data['team_id'],
            'season_id' => $fixture->season_id,
        ]);

        return back();
    }

    public function quickCreatePlayer(Request $request, Fixture $fixture): RedirectResponse
    {
        $data = $request->validate([
            'team_id' => 'required|in:' . $fixture->home_team_id . ',' . $fixture->away_team_id,
            'name' => 'required|string|max:255',
            'position' => 'required|in:goalkeeper,defender,midfielder,forward',
        ]);

        $player = Player::create([
            'name' => $data['name'],
            'position' => $data['position'],
        ]);

        PlayerTeamSeason::firstOrCreate([
            'player_id' => $player->id,
            'team_id' => $data['team_id'],
            'season_id' => $fixture->season_id,
        ]);

        return back()->with('newPlayerId', $player->id);
    }

    public function update(Request $request, Fixture $fixture): RedirectResponse
    {
        $data = $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'round_id' => 'nullable|exists:rounds,id',
            'home_team_id' => 'required|exists:teams,id|different:away_team_id',
            'away_team_id' => 'required|exists:teams,id',
            'scheduled_at' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
        ]);

        if (!empty($data['round_id'])) {
            $data['stage_id'] = Round::find($data['round_id'])->stage_id;
        }

        $fixture->update($data);

        if (!empty($data['round_id'])) {
            return redirect()->route('admin.rounds.show', $data['round_id'])->with('success', 'Fixture updated.');
        }

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture updated.');
    }

    public function destroy(Fixture $fixture): RedirectResponse
    {
        $roundId = $fixture->round_id;
        $fixture->delete();

        if ($roundId) {
            return redirect()->route('admin.rounds.show', $roundId)->with('success', 'Fixture deleted.');
        }

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture deleted.');
    }
}