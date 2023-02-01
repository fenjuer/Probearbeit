@extends('layouts.app')

@section('content')

<div>
    <h4 class="mb-3">Game Number {{ $game->id }}</h4>
    <p>started {{ $game->created_at->diffForHumans() }}</p>
    <h3>Players:</h3>
    <ul>
        @forelse($game->players as $player)
            <li>
                <a href="{{ route('players.show', ['player' => $player->id]) }}">
                    {{ $player->firstName }} {{ $player->lastName }}
                </a>
            </li>
        @empty
            <p>There are no players for this Game.</p>
            <p>You can add players <a href="{{ route('players.create') }}">here</a></p>
            <p>Or you can edit the game <a href="{{ route('games.edit', ['game' => $game->id]) }}">here</a></p>
        @endforelse
            <a class="btn btn-primary mt-3" href="{{ route('games.edit', ['game' => $game->id]) }}">Edit</a>
    </ul>
    <form action="{{ route('games.destroy', ['game' => $game->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete" class="btn btn-danger"
               href="{{ route('games.destroy', ['game' => $game->id]) }}">
    </form>
</div>
@endsection
