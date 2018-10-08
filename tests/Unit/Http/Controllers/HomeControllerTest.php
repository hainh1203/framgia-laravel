<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Controllers\HomeController;
use Illuminate\View\View;

class HomeControllerTest extends TestCase
{
    public function test_index_function()
    {
        $controller = new HomeController();
        $this->assertInstanceOf(View::class, $controller->index());
    }
}
