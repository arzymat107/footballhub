<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PlayerController extends Controller
{
    public function index(): Response
    {
        $players = Player::orderBy('name')->paginate(25);

        return Inertia::render('admin/players/Index', [
            'players' => $players,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/players/Form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'position' => 'nullable|in:goalkeeper,defender,midfielder,forward',
        ]);

        Player::create($data);

        return redirect()->route('admin.players.index')->with('success', 'Player created.');
    }

    public function edit(Player $player): Response
    {
        return Inertia::render('admin/players/Form', [
            'player' => $player,
        ]);
    }

    public function update(Request $request, Player $player): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'position' => 'nullable|in:goalkeeper,defender,midfielder,forward',
        ]);

        $player->update($data);

        return redirect()->route('admin.players.index')->with('success', 'Player updated.');
    }

    public function destroy(Player $player): RedirectResponse
    {
        $player->delete();

        return redirect()->route('admin.players.index')->with('success', 'Player deleted.');
    }
}