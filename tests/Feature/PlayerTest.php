<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanGetNoPlayersTextWhenNoPlayersWereCreated(): void
    {
        $response = $this->get('/players');
        $response->assertSeeText('no players yet');

        $response->assertStatus(200);
    }

    public function testCanGetPlayerInformationIfPlayersExistInDB(): void
    {
        $location = $this->createLocation();
        $player = new Player();
        $player->firstName = 'Felix';
        $player->lastName = 'Reich';
        $player->location_id = 1;
        $player->save();

        $response = $this->get('/players');
        $response->assertSeeText('Felix Reich');
        $response->assertSeeText('from ' . $location->name);

        $response->assertStatus(200);
    }

    public function testCanCreateNewPlayerWithValidInput(): void
    {
        $this->createLocation();
        $requestParams = [
            'firstName' => 'Felix',
            'lastName' => 'Reich',
            'location_id' => 1
        ];

        $response = $this->post('/players', $requestParams);
        $response->assertStatus(302);
        $response->assertSessionHas('status');

        $this->assertEquals('player creation successful', session('status'));
    }

    /**
     * @dataProvider provideWrongCreationInput
     */
    public function testCanSeeErrorsWhenCreationInputIsNotValid(array $wrongInput, array $validationResult): void
    {
        $this->createLocation();

        $this->post('/players', $wrongInput)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $this->assertEquals($validationResult, session('errors')->getMessages());
    }

    public function testCanViewOneSpecificPlayer(): void
    {
        $player = $this->createPlayer();

        $response = $this->get('/players/1');
        $response->assertStatus(200);
        $response->assertSeeText($player->firstName . ' ' . $player->lastName);
    }

    public function testCanGet404PageIfSpecificPlayerDoesNotExist(): void
    {
        $response = $this->get('/players/1');
        $response->assertStatus(404);
    }

    public function testCanUpdateExistingPlayer(): void
    {
        $player = $this->createPlayer();

        $this->assertDatabaseHas('players', [
            'firstName' => $player->firstName,
            'lastName' => $player->lastName,
            'id' => $player->id,
            'location_id' => $player->location_id,
        ]);

        $changedValues = [
            'firstName' => 'I have changed',
            'lastName' => $player->lastName,
            'location_id' => $player->location_id,
        ];

        $this->put('/players/' . $player->id, $changedValues);

        $this->assertDatabaseHas('players', [
            'firstName' => 'I have changed',
            'lastName' => $player->lastName,
            'id' => $player->id
        ]);

        $this->assertEquals('player update successful', session('status'));
    }

    public function testCanDeleteExistingPlayer(): void
    {
        $player = $this->createPlayer();

        $this->assertDatabaseHas('players', [
            'firstName' => $player->firstName,
            'lastName' => $player->lastName,
            'id' => $player->id,
            'location_id' => $player->location_id,
        ]);

        $this->delete('/players/' . $player->id);

        $this->assertDatabaseMissing('players', [
            'firstName' => $player->firstName,
            'lastName' => $player->lastName,
            'id' => $player->id
        ]);

        $this->assertEquals('player deletion successful', session('status'));
    }

    private function provideWrongCreationInput(): array
    {
        return [
            'missing firstName' => [
                [
                    'firstName' => '',
                    'lastName' => 'Something correct',
                    'location_id' => 1
                ],
                [
                    'firstName' => [
                        0 => 'The first name field is required.'
                    ]
                ]
            ],
            'missing lastName' => [
                [
                    'firstName' => 'Felix',
                    'lastName' => '',
                    'location_id' => 1
                ],
                [
                    'lastName' => [
                        0 => 'The last name field is required.'
                    ]
                ]
            ],
            'missing first and last Name' => [
                [
                    'firstName' => '',
                    'lastName' => '',
                    'location_id' => 1
                ],
                [
                    'firstName' => [
                        0 => 'The first name field is required.'
                    ],
                    'lastName' => [
                        0 => 'The last name field is required.'
                    ]
                ]
            ],
            'too long first Name and missing last Name' => [
                [
                    'firstName' => str_repeat('a', 266),
                    'lastName' => '',
                    'location_id' => 1
                ],
                [
                    'firstName' => [
                        0 => 'The first name must not be greater than 255 characters.'
                    ],
                    'lastName' => [
                        0 => 'The last name field is required.'
                    ]
                ]
            ],
            'location id doesnt exist in DB' => [
                [
                    'firstName' => 'Felix',
                    'lastName' => 'Reich',
                    'location_id' => 4
                ],
                [
                    'location_id' => [
                        0 => 'The selected location id is invalid.'
                    ]
                ]
            ],
        ];
    }

    private function createLocation(): Location
    {
        $location = new Location();
        $location->name = 'Berlin';
        $location->save();
        return $location;
    }

    private function createPlayer()
    {
        $this->createLocation();
        $player = new Player();
        $player->firstName = 'Felix';
        $player->lastName = 'Reich';
        $player->location_id = 1;
        $player->save();
        return $player;
    }
}
