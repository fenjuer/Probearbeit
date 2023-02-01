@extends('layouts.app')

@section('content')

<div>
    <h4 class="mb-3">{{ $player->firstName }} {{ $player->lastName }}</h4>
    <h6>
        <a href="{{ route('locations.show', ['location' => $player->location->id]) }}">
            from {{ $player->location->name }}
        </a>
    </h6>
    <a class="btn btn-primary" href="{{ route('players.edit', ['player' => $player->id]) }}">Edit</a>
    <form action="{{ route('players.destroy', ['player' => $player->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete" class="btn btn-danger"
               href="{{ route('players.destroy', ['player' => $player->id]) }}">
    </form>
</div>
@endsection
