<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function test_user_in_database()
    {
        $this->assertDatabaseHas('users', [
            'first_name' => 'a8124f3119',
        ]);
    }
}
