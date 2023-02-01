@extends('layouts.app')
@section('title', 'Location Overview')

@section('content')
    <div>
        @foreach($locations as $location)
            <h4>
                <a href="{{ route('locations.show', ['location' => $location->id]) }}">
                    {{ $location->name }}
                </a>
            </h4>
            <p>Players: {{ $location->players_count }}</p>
            <p>Games: {{ $location->games_count }}</p>
        @endforeach
    </div>
@endsection
