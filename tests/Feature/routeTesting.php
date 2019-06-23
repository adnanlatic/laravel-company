<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class routeTesting extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/company');
        $response->assertStatus(200);

        $response = $this->get('/employee');
        $response->assertStatus(200);

    }
}
