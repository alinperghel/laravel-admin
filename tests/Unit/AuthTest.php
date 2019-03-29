<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRedirectUnauthenticated()
    {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
        $response = $this->get('/terms');
        $response->assertRedirect('/login');
    }
    
    
}
