<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
   /**
    * The constructor function takes a UserService object as a parameter.
    */
    public function __construct(private UserService $userService) {
    }
    function login() {
        return view('user.login',[
            "title" => "login"
        ]);
    }

    function authenticate(Request $request)  {
        $request->validate([
            "user" => "required",
            "password" => "required"
        ]);

        if ($this->userService->login($request->user , $request->password)) {
            $request->session()->put("user", $request->user);
            return redirect('/');
        }

        return view('user.login',[
            "title" => "login",
            "error" => "Username or Password might be wrong!"
        ]);
        // return $this->userService->login($request->user , $request->password);
    }

    function logout(Request $request) {
        $request->session()->forget('user');
        return redirect('/');        
    } 
}
