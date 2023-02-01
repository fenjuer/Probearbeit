@extends('layouts.app')
@section('title', 'Player Overview')

@section('content')
    <div>
        @forelse($players as $player)
            <h4>
                <a href="{{ route('players.show', ['player' => $player->id]) }}">
                    {{ $player->firstName . ' ' . $player->lastName}}
                </a>
                <a>from {{ $player->location->name }}</a>
            </h4>
        @empty
            <p>no players yet</p>
        @endforelse
    </div>
@endsection
