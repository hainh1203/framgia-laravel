<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\View\View;

class LoginControllerTest extends TestCase
{
    public function test_constructor()
    {
        $this->assertInstanceOf(LoginController::class, new LoginController());
    }
}
