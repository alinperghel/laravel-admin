<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase {

    public function testLoginTest() {
        $response = $this->get('/login');
        
        $response = $this->call('POST', route('login'), ['email' => 'a.perghel@gmail.com', 'password' => '123xYz!@#']);
        $response->assertRedirect(route('home'));
        
        $response = $this->call('POST', route('login'), ['email' => 'a.perghel@gmail.com', 'password' => 'wrong']);
        $response->assertRedirect(route('home'));
    }
    
    public function testLoginWrongPasswordTest(){
        $response = $this->get('/login');
       
        $response = $this->call('POST', route('login'), ['email' => 'a.perghel@gmail.com', 'password' => 'wrong']);
        $response->assertRedirect(route('login'));
    }

}
