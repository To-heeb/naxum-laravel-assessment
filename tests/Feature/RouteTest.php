<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;

class RouteTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_task_one_route()
    {
        $response = $this->get('/task_one');

        $response->assertStatus(200);
    }

    public function test_task_two_route()
    {
        $response = $this->get('/task_two');

        $response->assertStatus(200);
    }

    public function test_search_route()
    {
        $response = $this->get('/search');

        $response->assertStatus(200);
    }

    public function test_autocomplete_route()
    {
        $response = $this->get('/autocomplete');

        $response->assertStatus(200);
    }

    public function test_search_order_items()
    {
        $response = $this->get('/order_items/12211');

        $response->assertStatus(200);
    }

    public function test_autocomplete_response()
    {
        //$this->withoutExceptionHandling();
        $response = $this->json('get', '/autocomplete', ['terms' => 234]);

        $response->assertOk();
        $response->assertJsonStructure(['id', 'first_name', 'last_name']);
    }
}
