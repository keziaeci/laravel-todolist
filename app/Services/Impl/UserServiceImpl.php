<?php 

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService {

    /* `private` is an access modifier in PHP that restricts the visibility of a property or method to
    only within the class where it is declared. In this context, the `` property is declared
    as private, which means it can only be accessed and modified within the `UserServiceImpl` class
    and not from outside the class or its subclasses. */
    private $users = [
        "rena" => "123"
    ];
    function login(string $user, string $password): bool {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPw = $this->users[$user];
        return $password == $correctPw; //if-else shorthand
        // if ($password == $correctPw) {
        //     return true;
        // } e
    }
}