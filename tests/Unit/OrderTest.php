<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Order;
use App\Product;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_an_order_consists_of_products(){

    	$order = new Order();

    	$product1 = new Product('Fallout-4', 59);
    	$product2 = new Product('pillowcase', 7);

    	$order->add($product1);
    	$order->add($product2);

    	$this->assertCount(2, $order->products());
    }

    public function test_an_order_has_a_total_cost_for_all_its_products(){

    	$order = new Order();

    	$product1 = new Product('Fallout-4', 59);
    	$product2 = new Product('pillowcase', 7);

    	$order->add($product1);
    	$order->add($product2);

    	$this->assertEquals(66, $order->total());

    	// dd($product1->price());
    }
}
