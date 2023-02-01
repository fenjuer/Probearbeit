<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoundRequest;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    public function create(): View
    {
        return view('rounds.create');
    }

    public function store(RoundRequest $request)
    {
        $validated = $request->validated();
        //create positions
        $playerId = $validated['playersTeam1']['player1']['id'];
        $playerPosition = $validated['playersTeam1']['player1']['positionId'];
        $player = Player::findOrFail($playerId);
        $player->positions()->attach($playerPosition);




    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
