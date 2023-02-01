<div>
    <form method="POST" action="{{ route('rounds.store') }}">
        @csrf
        <div class="form-group">
            <div>
                <h3>Team 1</h3>
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                <select name="playersTeam1[player1][id]" class="form-select mb-1" aria-label="select the players for the team">
                    <option selected>Please select the players</option>
                    @foreach($game->players as $player)
                        <option value="{{ $player->id }}">{{ $player->firstName }} {{ $player->lastName }}</option>
                    @endforeach
                </select>
                <select name="playersTeam1[player1][positionId]">
                    <option selected>Please select the position for that player</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
                <select name="playersTeam1[player2][id]" class="form-select mb-1" aria-label="select the players for the team">
                    <option selected>Please select the players</option>
                    @foreach($game->players as $player)
                        <option value="{{ $player->id }}">{{ $player->firstName }} {{ $player->lastName }}</option>
                    @endforeach
                </select>
                <select name="playersTeam1[player2][positionId]">
                    <option selected>Please select the position for that player</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <h3>Team 2</h3>
                <select name="playersTeam2[player1][id]" class="form-select mb-1" aria-label="select the players for the team">
                    <option selected>Please select the players</option>
                    @foreach($game->players as $player)
                        <option value="{{ $player->id }}">{{ $player->firstName }} {{ $player->lastName }}</option>
                    @endforeach
                </select>
                <select name="playersTeam2[player1][positionId]">
                    <option selected>Please select the position for that player</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
                <select name="playersTeam2[player2][id]" class="form-select mb-1" aria-label="select the players for the team">
                    <option selected>Please select the players</option>
                    @foreach($game->players as $player)
                        <option value="{{ $player->id }}">{{ $player->firstName }} {{ $player->lastName }}</option>
                    @endforeach
                </select>
                <select name="playersTeam2[player2][positionId]">
                    <option selected>Please select the position for that player</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
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
