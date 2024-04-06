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

    // LOGIN
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

    function testLoginPageWithAuthenticatedUser() {
        $this->withSession([
            'user' => 'rena'
        ])->get('/login')
        ->assertRedirect('/')
        ->assertSessionHas('user');
    }

    function testLoginPageWithGuest() {
        $this->get('/login')
        ->assertSeeText('login')
        ->assertSessionMissing('user');
    }

    function testLoginPageWithAlreadyLoginUser() {
        $this->withSession([
            'user' => 'rena'
        ])->post('/login',[
            'user' => 'rena',
            'password' => '123'
        ])
        ->assertRedirect('/');
    }

    // LOGOUT
    function testLogout() {
        $this->withSession([
            'user' => 'rena'
        ])->post('/logout')
        ->assertRedirect('/');
    }

    function testLogoutWithGuest() {
        $this->post('/logout')
        ->assertRedirect('/login')
        ->assertSessionMissing('user');
    }
}
