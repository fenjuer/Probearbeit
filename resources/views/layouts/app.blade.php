<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js'])
    <title>Kicker - @yield('title')</title>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">
    <h5 class="my-0 me-md-auto font-weight-normal">Kicker</h5>
    <nav class="my-2 my-md-0 me-md-3">
        <a class="p-2 text-dark" href="{{ route('locations.index') }}">Location Overview</a>
        <a class="p-2 text-dark" href="{{ route('players.index') }}">Player Overview</a>
        <a class="p-2 text-dark" href="{{ route('games.index') }}">Games Overview</a>
        <a class="p-2 text-dark" href="{{ route('players.create') }}">Add a Player</a>
        <a class="p-2 text-dark" href="{{ route('games.create') }}">Add a Game</a>
    </nav>
</div>
<div class="container">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>
