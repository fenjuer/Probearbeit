@extends('layouts.app')

@section('title', 'edit Game')
@section('content')
    <div>
        <form method="POST" action="{{ route('games.update', ['game' => $game->id]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="mt-3">
                    <select name="location_id" class="form-select mb-1" aria-label="select the location of the Game">
                        <option value="{{ $game->location->id }}" selected>{{ $game->location->name }}</option>
                        @foreach($locations as $location)
                            @if($game->location->id === $location->id)
                                @continue
                            @endif
                            <option value="{{ $location->id }}">
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <select name="type_id" class="form-select mb-1" aria-label="select the type of Game">
                        <option value="{{ $game->type->id }}" selected>{{ $game->type->name }}</option>
                        @foreach($types as $type)
                            @if($game->type->id === $type->id)
                                @continue
                            @endif
                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <h4>Please select players</h4>
                    @foreach($game->players as $originalPlayer)
                        <label for="player_{{ $loop->index }}">Select Player {{ $loop->index +1 }}</label>
                        <select id="player_{{ $loop->index }}" name="players[]" class="form-select mb-1"
                                aria-label="select player {{ $loop->index + 1 }}">
                            <option value="{{ $originalPlayer->id }}" selected>{{ $originalPlayer->firstName }} {{ $originalPlayer->lastName }}</option>
                            @foreach($players as $player)
                                @if($originalPlayer->id === $player->id)
                                    @continue
                                @endif
                                <option value="{{ $player->id }}">
                                    {{ $player->firstName }} {{ $player->lastName }}
                                </option>
                            @endforeach
                        </select>
                    @endforeach
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Edit">
        </form>
        @if($errors->any())
            <div class="mb-3">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @include('rounds.create')
@endsection
