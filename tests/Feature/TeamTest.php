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

        $this->assertEquals(2, $team->fresh()->count());
    }

    public function test_a_team_has_a_maximum_size(){

        $this->expectException('Exception');

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
        $team->fresh()->addUser($user6);
        

    }

    // public function test_it_can_save_multiple_users_at_once(){

    //     $team = factory(Team::class)->create();

    //     $users = factory(User::class, 20)->create();

    //     $team->addUser($users);

    //     $this->assertCount(5, $team->fresh()->members);
    // }

    public function test_it_remove_a_user(){

        $team = factory(Team::class)->create();

        $member = factory(User::class)->create();

        $team->addUser($member);

        $this->assertCount(1, $team->fresh()->members);

        $this->delete('/teams/{team}/{member}');

        $this->assertCount(1, $team->fresh()->members);

    }
}
