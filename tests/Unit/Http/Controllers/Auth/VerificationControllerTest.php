<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\View\View;

class VerificationControllerTest extends TestCase
{
    public function test_constructor()
    {
        $this->assertInstanceOf(VerificationController::class, new VerificationController());
    }
}
