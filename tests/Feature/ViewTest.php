<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
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

    public function test_task_one_view()
    {

        $response = $this->get('/task_one');

        $response->assertSee('Distributor');
    }

    public function test_task_two_view()
    {

        $response = $this->get('/task_two');

        $response->assertSeeInOrder(['Top', '100', 'Distributors']);
    }


    public function test_index_view()
    {

        //$view = $this->blade('index');
        $response = $this->get('/');

        $response->assertSee('Oyekola Toheeb');
    }
}
