<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(Request $request)  {
        if ($request->session()->has('user')) {
            return redirect('/todolist');
        } 
        return redirect('/login');
    }
}
