<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Article;

class ArticleTest extends TestCase
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

    public function test_it_fetches_popular_articles(){

        //Given 
        factory(\App\Article::class, 3)->create();
        $article1 = factory(\App\Article::class)->create(['reads' => 6]);
        $article2 = factory(\App\Article::class)->create(['reads' => 3]);

        //When

        $trending = Article::trending();

        //then

        $this->assertEquals($article1->id, $trending->first()->id);
    }
}
