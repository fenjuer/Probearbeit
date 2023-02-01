<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Models\Location;
use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(): View
    {
        return view('players.index', ['players' => Player::with('location')->get()]);
    }

    public function create(): View
    {
        return view('players.create', ['locations' => Location::all()]);
    }

    public function store(PlayerRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $player = Player::create($validated);

        $request->session()->flash('status', 'player creation successful');

        return redirect()->route('players.show', ['player' => $player->id]);
    }

    public function show(int $id): View
    {
        return view('players.show', ['player' => Player::with('location')->findOrFail($id)]);
    }

    public function edit(int $id): View
    {
        return view(
            'players.edit',
            [
                'player' => Player::with('location')->findOrFail($id),
                'locations' => Location::all()
            ]
        );
    }

    public function update(PlayerRequest $request, int $id): RedirectResponse
    {
        $player = Player::findOrFail($id);

        $validated = $request->validated();
        $player->fill($validated);
        $player->save();

        $request->session()->flash('status', 'player update successful');

        return redirect()->route('players.show', ['player' => $player->id]);
    }

    public function destroy(int $id, Request $request)
    {
        $player = Player::findOrFail($id);

        $player->delete();

        $request->session()->flash('status', 'player deletion successful');

        return redirect()->route('players.index');
    }
}
