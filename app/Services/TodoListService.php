<?php 

namespace App\Services;

interface TodoListService {
    function saveTodo(string $id , string $todo): void ;
    function getTodoList() : array;
    function removeTodoList(string $id);
}
