<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    public function testCanGetIndexPage(): void
    {
        $response = $this->get('/locations');
        $response->assertStatus(200);
    }

    public function testCanGetPlayerCountForLocation(): void
    {
        Location::factory()
            ->has(
                Player::factory()->count(3)
            )->create();

        $response = $this->get('/locations');
        $response->assertStatus(200);
        $response->assertSeeText('Players: 3');
    }

    public function testCanViewSpecificLocationWithAllAttachedPlayers(): void
    {
        $location = Location::factory()->has(Player::factory()->count(2))->create();
        $players = $location->players()->get();

        $response = $this->get('/locations/' . $location->id);
        $response->assertStatus(200);

        foreach ($players as $player) {
            $response->assertSeeText($player->firstName . ' ' . $player->lastName);
        }
    }
}
