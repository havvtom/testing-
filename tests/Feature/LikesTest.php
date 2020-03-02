<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikesTest extends TestCase
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

    public function test_a_user_can_like_a_post(){

        //given we have a post
        $post = factory(\App\Post::class)->create();
        //we have a signed in user
        $this->actingAs($user = factory(\App\User::class)->create());
        //user likes the model
        $post->likes();
        //database should show
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_type' => \App\Post::class,
            'likeable_id' => $post->id
        ]);

        $this->assertTrue($post->isLiked());

        
    }

    public function test_a_user_can_unlike_a_post(){

        //given we have a post
        $post = factory(\App\Post::class)->create();
        //we have a signed in user
        $this->actingAs($user = factory(\App\User::class)->create());
        //user likes the model
        $post->likes();

        $post->unlike();

        $this->assertFalse($post->isLiked());

    }

    public function test_a_user_can_toggle_posts(){

        //given we have a post
        $post = factory(\App\Post::class)->create();
        //we have a signed in user
        $this->actingAs($user = factory(\App\User::class)->create());
        //user likes the model
        $post->toggle();

        $this->assertTrue($post->isLiked());

        $post->toggle();

        $this->assertFalse($post->isLiked());
    }

    public function test_it_knows_how_many_likes_it_has(){

        $post = factory(\App\Post::class)->create();

        $this->actingAs($user = factory(\App\User::class)->create());

        $post->likes();
        
        $this->assertEquals(1, $post->likesCount);

    }
}
