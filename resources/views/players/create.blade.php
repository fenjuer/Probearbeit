@extends('layouts.app')

@section('title', 'create Player')
@section('content')
<div>
    <form method="POST" action="{{ route('players.store') }}">
        @csrf
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName">
            <div class="mt-3">
                <select name="location_id" class="form-select mb-1" aria-label="select the location of the Player">
                    <option selected>Please Select an location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
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
