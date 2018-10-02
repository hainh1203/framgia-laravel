<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\View\View;

class ForgotPasswordControllerTest extends TestCase
{
    public function test_constructor()
    {
        $this->assertInstanceOf(ForgotPasswordController::class, new ForgotPasswordController());
    }
}
