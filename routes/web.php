<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/template', function () {
    return view('template');
});

Route::middleware('onlyGuest')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/login' , 'login')->name('login');
        Route::post('/login' , 'authenticate');
    });

});

Route::middleware('onlyAuth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/','home');
    });

    Route::controller(TodoListController::class)->group(function () {
        Route::get('/todolist','index')->name('todolists');
        Route::post('/todolist','addTodo')->name('add-todolist');
        Route::delete('/todolist/{id}/delete','removeTodo')->name('remove-todolist');
    });
    Route::post('/logout' , [UserController::class, 'logout']);
});