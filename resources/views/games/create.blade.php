@extends('layouts.app')

@section('title', 'create Player')
@section('content')
    <div>
        <form method="POST" action="{{ route('games.store') }}">
            @csrf
            <div class="form-group">
                <div class="mt-3">
                    <select name="location_id" class="form-select mb-1" aria-label="select the location of the Game">
                        <option selected>Please Select an location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <select name="type_id" class="form-select mb-1" aria-label="select the type of Game">
                        <option selected>Please Select the type of game</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <h4>Please select players</h4>
                    @for($i = 1; $i <= 4; $i++)
                        <label for="player_{{ $i }}">Select Player {{ $i }}</label>
                        <select id="player_{{ $i }}" name="players[]" class="form-select mb-1" aria-label="select player {{$i}}">
                            <option selected>Please Select player {{ $i }}</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">
                                    {{ $player->firstName }} {{ $player->lastName }}
                                </option>
                            @endforeach
                        </select>
                    @endfor
                </div>
            </div>
            <input type="submit" value="Create">
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
@endsection
