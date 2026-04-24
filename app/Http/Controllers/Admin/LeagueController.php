<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\League;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LeagueController extends Controller
{
    public function index(): Response
    {
        $leagues = League::withCount('divisions')
            ->orderBy('name')
            ->paginate(20);

        return Inertia::render('admin/leagues/Index', [
            'leagues' => $leagues,
        ]);
    }

    public function show(League $league): Response
    {
        $league->load(['divisions' => fn ($q) => $q->withCount('seasons')->orderBy('level')]);

        return Inertia::render('admin/leagues/Show', [
            'league' => $league,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/leagues/Form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        League::create($data);

        return redirect()->route('admin.leagues.index')->with('success', 'League created.');
    }

    public function edit(League $league): Response
    {
        return Inertia::render('admin/leagues/Form', [
            'league' => $league,
        ]);
    }

    public function update(Request $request, League $league): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $league->update($data);

        return redirect()->route('admin.leagues.index')->with('success', 'League updated.');
    }

    public function destroy(League $league): RedirectResponse
    {
        $league->delete();

        return redirect()->route('admin.leagues.index')->with('success', 'League deleted.');
    }
}