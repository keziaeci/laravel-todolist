<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLoginPage(): void
    {
        $this->get('/login')
        ->assertSeeText('Login');
    }

    function testLoginSuccess() {
        $this->post('/login',[
            "user" => "rena",
            "password" => "123"
        ])
        ->assertRedirect("/")
        ->assertSessionHas("user","rena");
    }

    function testLoginFailed() {
        $this->post('/login',[
            "user" => "raena",
            "password" => "dad23"
        ])
        ->assertSeeText('Username');
    }

    function testLoginInputEmpty() {
        $this->post('/login',[])
        ->assertSessionHasErrors([
            "user","password"
        ]);
    }

}
