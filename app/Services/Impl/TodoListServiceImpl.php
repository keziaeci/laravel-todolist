<?php 

namespace App\Services\Impl;
use App\Services\TodoListService;
use Illuminate\Support\Facades\Session;

class TodoListServiceImpl implements TodoListService {
    function saveTodo(string $id, string $todo): void {
        if (!Session::has("todolist")) {
            Session::put("todolist",[]);
        }

        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    function getTodoList(): array {
        return Session::get("todolist",[]);
    }

    function removeTodoList(string $id) {
        $todoList = Session::get("todolist");

        foreach ($todoList as $index => $value) {
            if ($value['id'] == $id) {
                unset($todoList[$index]);
                break;
            }
        }

        return Session::put("todolist",$todoList);
    }
}