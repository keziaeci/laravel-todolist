<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    /**
     * The setUp function initializes the UserService class for testing in a PHP unit test.
     */
    protected function setUp(): void {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    function testSample() : void {
        assertTrue(true);
    }

    function testLoginSuccess() {
        assertTrue($this->userService->login("rena", "123"));
    }

    function testLoginUserNotFound() {
        assertFalse($this->userService->login("ren", "123"));
    }
    
    function testLoginWrongPassword() {
        assertFalse($this->userService->login("rena", "1233"));
    }

}
