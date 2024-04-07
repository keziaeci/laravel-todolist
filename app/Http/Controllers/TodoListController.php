<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TodoListController extends Controller
{
    public function __construct(private TodoListService $todoListService) {
    }
    function index(){
        // dd(Session::all());     
        return view('todolist.todolist',[
            "title" => "TODOLIST HOMEPAGE",
            "todos" => array_reverse($this->todoListService->getTodoList())
        ]);
    }

    function addTodo(Request $request) : RedirectResponse {
        $request->validate([
            "todo" => "required"
        ]);

        $this->todoListService->saveTodo(uniqid("TODO-"), $request->todo);
        return redirect('/todolist');
    }

    function removeTodo(Request $request , $id) {
        $this->todoListService->removeTodoList($id);
        return redirect('/todolist');
    }
}
