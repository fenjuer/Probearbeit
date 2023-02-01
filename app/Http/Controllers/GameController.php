<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Game;
use App\Models\Location;
use App\Models\Player;
use App\Models\Position;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        return view('games.index',
            [
                'games' => Game::with(
                    ['location', 'rounds', 'type']
                )->get()
            ]);
    }

    public function create(): View
    {
        return view('games.create', [
            'locations' => Location::all(),
            'types' => Type::all(),
            'players' => Player::all()
        ]);
    }

    public function store(GameRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $game = Game::create($validated);

        foreach ($validated['players'] as $playerId) {
            $game->players()->attach($playerId);
        }

        $request->session()->flash('status', 'game creation successful');

        return redirect()->route('games.show', ['game' => $game->id]);
    }

    public function show(int $id): View
    {
        return view('games.show', ['game' => Game::with('players')->findOrFail($id)]);
    }

    public function edit(int $id): View
    {
        return view('games.edit', [
            'game' => Game::with(['location', 'type', 'players'])->findOrFail($id),
            'locations' => Location::all(),
            'types' => Type::all(),
            'players' => Player::all(),
            'positions' => Position::all()
        ]);
    }

    public function update(GameRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();
        $game = Game::findOrFail($id);
        $game->fill($validated);
        $game->save();

        $originalPlayers = $game->players()->get();
        foreach ($originalPlayers as $originalPlayer) {
           $game->players()->detach($originalPlayer->id);
        }

        foreach ($validated['players'] as $playerId) {
            $game->players()->attach($playerId);
        }
        $request->session()->flash('status', 'game update successful');

        return redirect()->route('games.show', ['game' => $game->id]);
    }

    public function destroy($id, Request $request)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        $request->session()->flash('status', 'game deletion successful');

        return redirect()->route('games.index');
    }
}
