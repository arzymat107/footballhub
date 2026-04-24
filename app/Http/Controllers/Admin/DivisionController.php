<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\League;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DivisionController extends Controller
{
    public function index(): Response
    {
        $divisions = Division::with('league')
            ->orderBy('league_id')
            ->orderBy('level')
            ->paginate(20);

        return Inertia::render('admin/divisions/Index', [
            'divisions' => $divisions,
        ]);
    }

    public function show(Division $division): Response
    {
        $division->load(['league', 'seasons' => fn ($q) => $q->orderByDesc('start_date')]);

        return Inertia::render('admin/divisions/Show', [
            'division' => $division,
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('admin/divisions/Form', [
            'leagues' => League::orderBy('name')->get(['id', 'name']),
            'leagueId' => $request->integer('league_id') ?: null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $division = Division::create($data);

        return redirect()->route('admin.leagues.show', $division->league_id)->with('success', 'Division created.');
    }

    public function edit(Division $division): Response
    {
        return Inertia::render('admin/divisions/Form', [
            'division' => $division,
            'leagues' => League::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Division $division): RedirectResponse
    {
        $data = $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $division->update($data);

        return redirect()->route('admin.leagues.show', $division->league_id)->with('success', 'Division updated.');
    }

    public function destroy(Division $division): RedirectResponse
    {
        $leagueId = $division->league_id;
        $division->delete();

        return redirect()->route('admin.leagues.show', $leagueId)->with('success', 'Division deleted.');
    }
}