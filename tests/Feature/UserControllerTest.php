<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
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

    public function testStore()
    {
        $response = $this->json('POST', '/api/user/store', [
            'name' => 'example',
            'email' => 'aaa@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
    }
}
