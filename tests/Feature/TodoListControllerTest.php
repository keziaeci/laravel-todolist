<?php

namespace Tests\Feature;

use App\Services\TodoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    public function testIndexPage(): void
    {
        $this->withSession([
            'user' => 'rena',
            'todolist' => [
                'id' => '1',
                'todo' => 'rena'
            ]
        ])
        ->get('/todolist')
        ->assertSeeText('TODOLIST HOMEPAGE')
        ->assertSeeText('1')
        ->assertSeeText('rena');
    }

    function testSaveTodoFailed() {
        $this->withSession([
            'user' => 'rena',
        ])
        ->post('/todolist',[])
        ->assertSessionHasErrors('todo');
    }

    function testSaveTodoSuccess() {
        $this->withSession([
            'user' => 'rena',
        ])
        ->post('/todolist',[
            "todo" => "rena"
        ])
        ->assertRedirect('/todolist');
    }

    function testRemoveTodo() {
        $this->withSession([
            'user' => 'rena',
            'todolist' =>[
                [
                    'id' => '1',
                    'todo' => 'rena'
                ],
            ] 
        ])
        ->delete('/todolist/1/delete')
        ->assertRedirect('/todolist');
    }
}
