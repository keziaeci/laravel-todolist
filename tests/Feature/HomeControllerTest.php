<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    function testGuest()  {
        $this->get('/')
        ->assertRedirect('/login');
    }

    function testAuthenticated() {
        $this->withSession([
            'user' => 'rena'
        ])
        ->get('/')
        ->assertRedirect('/todolist');
    }
}
