@extends('layouts.app')
@section('title', 'Games Overview')

@section('content')
    <div>
        <ul>
            @forelse($games as $game)
                <li>
                    <a href="{{ route('games.show', ['game' => $game->id]) }}">
                    {{ $game->id }}
                    played: {{ $game->created_at->diffForHumans() }} in {{ $game->location->name }}
                    of Type {{ $game->type->name }}
                    </a>
                </li>
            @empty
                <p>no Games yet</p>
            @endforelse
        </ul>
    </div>
@endsection
