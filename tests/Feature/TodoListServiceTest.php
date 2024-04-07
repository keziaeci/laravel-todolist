<?php

namespace Tests\Feature;

use App\Services\TodoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class TodoListServiceTest extends TestCase
{
    // public function __construct(private TodoListService $todoListService) {
    // }
    private TodoListService $todoListService;

    function setUp(): void {
        parent::setUp();
        $this->todoListService = $this->app->make(TodoListService::class);
    }

    function testTodoListNotNull() {
        assertNotNull($this->todoListService);
    }

    function testSaveTodo()  {
        $this->todoListService->saveTodo("1","Rena");

        $todoList = Session::get("todolist");
        foreach ($todoList as $todo) {
            assertEquals("1", $todo["id"]);
            assertEquals("Rena", $todo["todo"]);
        }
    }

    function testGetTodoListEmpty() {
        assertEquals([], $this->todoListService->getTodoList());
    }

    function testGetTodoListNotEmpty() {
        $expected = [
            [
                "id" => "1",
                "todo" => "Rena"
            ],
            [
                "id" => "2",
                "todo" => "Maria"
            ],
        ];
        $this->todoListService->saveTodo("1","Rena");
        $this->todoListService->saveTodo("2","Maria");

        assertEquals($expected, $this->todoListService->getTodoList());
    }

    function testRemoveTodoList()  {
        $this->todoListService->saveTodo("1","Rena");
        $this->todoListService->saveTodo("2","Maria");
        
        assertEquals(2,sizeof($this->todoListService->getTodoList()));
        $this->todoListService->removeTodoList("3");
        assertEquals(2,sizeof($this->todoListService->getTodoList()));
        $this->todoListService->removeTodoList("2");
        assertEquals(1,sizeof($this->todoListService->getTodoList()));
        $this->todoListService->removeTodoList("1");
        assertEquals(0,sizeof($this->todoListService->getTodoList()));
        
        // assertEquals([],$this->todoListService->getTodoList());
    }
}
