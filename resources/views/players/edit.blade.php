@extends('layouts.app')

@section('title', 'create Player')
@section('content')
<div>
    <form method="POST" action="{{ route('players.update', ['player' => $player->id]) }}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input value="{{ $player->firstName }}" type="text" name="firstName" id="firstName">
            <label for="lastName">Last Name</label>
            <input value="{{ $player->lastName }}" type="text" name="lastName" id="lastName">
            <div class="mt-3">
                <select name="location_id" class="form-select mb-1" aria-label="select the location of the Player">
                    <option value="{{ $player->location->id }}" selected>{{ $player->location->name }}</option>
                    @foreach($locations as $location)
                        @if($player->location->id === $location->id)
                            @continue
                        @endif
                        <option value="{{ $location->id }}">
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <input class="btn btn-primary" type="submit" value="Update">
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
