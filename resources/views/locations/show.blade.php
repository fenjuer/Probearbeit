@extends('layouts.app')

@section('content')

<div>
    <h4 class="mb-3">{{ $location->name }}</h4>
    <h5>Players: </h5>
    <ul>
        @forelse($location->players as $player)
            <li>
                <a href="{{ route('players.show', ['player' => $player->id]) }}">
                    {{ $player->firstName }} {{ $player->lastName }}
                </a>
            </li>
        @empty
            <p>There are no players for this Location.</p>
            <p>You can add players <a href="{{ route('players.create') }}">here</a></p>
        @endforelse
    </ul>
    <h5>Games:</h5>
    <ul>
        @forelse($location->games as $game)
            <li>
                <a href="{{ route('games.show', ['game' => $game->id]) }}">
                    Played {{ $game->created_at->diffForHumans() }}
                </a>
            </li>
        @empty
            <p>There are no games for this Location.</p>
            <p>You can add games <a href="{{ route('games.create') }}">here</a></p>
        @endforelse
    </ul>
</div>
@endsection
