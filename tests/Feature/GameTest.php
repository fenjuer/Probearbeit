<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Location;
use App\Models\Player;
use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function testCanGetEmptyPageIfThereAreNoGamesYet(): void
    {
        $response = $this->get('/games');
        $response->assertStatus(200);
        $response->assertSeeText('no Games yet');
    }

    public function testCanSeeGameOverviewWithOneGame(): void
    {
        $this->createGame();

        $response = $this->get('/games');
        $response->assertStatus(200);

        $response->assertDontSeeText('no Games yet');
    }

    public function testCanSeeSpecificGameWithPlayers(): void
    {
        $game = $this->createGame();
        $location = Location::factory()->has(Player::factory()->count(1))->create();
        $player = $location->players()->first();
        $game->players()->attach($player->id);

        $response = $this->get('/games/1');
        $response->assertStatus(200);
        $response->assertSeeText($player->firstName);
    }

    public function testCanUpdateGame(): void
    {
        $game = $this->createGame();
        $location = Location::factory()->has(Player::factory()->count(2))->create();
        $player = $location->players()->first();
        $game->players()->attach($player->id);

        $this->assertDatabaseMissing('players_games', [
            'player_id' => 2,
            'game_id' => 1,
        ]);

        $changedData = [
            'location_id' => 1,
            'type_id' => 1,
            'players' => [
                0 => 1,
                1 => 1,
                2 => 1,
                3 => 2,
            ]
        ];

        $response = $this->put('/games/1', $changedData);
        $response->assertStatus(302);
    }

    private function createGame(): Game
    {
        $type = new Type();
        $type->name = 'Best of 3';
        $type->numberOfRounds = 3;
        $type->save();
        Location::factory()->create();
        $game = new Game();
        $game->location_id = 1;
        $game->type_id = 1;
        $game->save();
        return $game;
    }
}
