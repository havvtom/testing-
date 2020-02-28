<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Team;
use App\User;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_team_has_name(){

        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);
    }

    public function test_a_team_can_add_members(){

        $team = factory(Team::class)->create();

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->addUser($user1);
        $team->addUser($user2);

        $this->assertEquals(2, $team->count());
    }

    public function test_a_team_has_a_maximum_size(){

        $team = factory(Team::class)->create();

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user3 = factory(User::class)->create();
        $user4 = factory(User::class)->create();
        $user5 = factory(User::class)->create();
        $user6 = factory(User::class)->create();

        $team->addUser($user1);
        $team->addUser($user2);
        $team->addUser($user3);
        $team->addUser($user4);
        $team->addUser($user5);
        $team->addUser($user6);

        

    }
}
