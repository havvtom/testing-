<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $product;

    public function setUp() :void{

        parent::setUp();

        $this->product = new Product('Fallout-4', 59);
    }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_product_has_name(){

        // $product = new Product('Fallout-4', "a");

        $this->assertEquals($this->product->name(), 'Fallout-4');
    }

    public function test_product_has_price(){

        // $product = new Product('Fallout-4', 59);

        $this->assertEquals(59, $this->product->price());
    }
}
//"vendor\bin\phpunit" --filter testExample