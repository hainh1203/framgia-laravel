<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\View\View;

class ResetPasswordControllerTest extends TestCase
{
    public function test_constructor()
    {
        $this->assertInstanceOf(ResetPasswordController::class, new ResetPasswordController());
    }
}
