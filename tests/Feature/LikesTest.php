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
    protected $post;

    public function setUp() :void{

        parent::setUp();
        $this->post = factory(\App\Post::class)->create();

        $this->signIn();
    }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_a_user_can_like_a_post(){

        //given we have a post
       
        //we have a signed in user
       
        //user likes the model
        $this->post->likes();
        //database should show
        $this->assertDatabaseHas('likes', [
            'user_id' => $this->user->id,
            'likeable_type' => \App\Post::class,
            'likeable_id' => $this->post->id
        ]);

        $this->assertTrue($this->post->isLiked());

        
    }

    public function test_a_user_can_unlike_a_post(){

        //given we have a post
        
        //we have a signed in user
        
        //user likes the model
        $this->post->likes();

        $this->post->unlike();

        $this->assertFalse($this->post->isLiked());

    }

    public function test_a_user_can_toggle_posts(){

        //given we have a post
        
        //we have a signed in user
        
        //user likes the model
        $this->post->toggle();

        $this->assertTrue($this->post->isLiked());

        $this->post->toggle();

        $this->assertFalse($this->post->isLiked());
    }

    public function test_it_knows_how_many_likes_it_has(){


        $this->post->likes();
        
        $this->assertEquals(1, $this->post->likesCount);

    }
}
