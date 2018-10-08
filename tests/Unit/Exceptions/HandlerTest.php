<?php

namespace Tests\Unit\Exceptions;

use Tests\TestCase;
use App\Exceptions\Handler;
use Illuminate\Http\Response;
use Exception;

class HandlerTest extends TestCase
{
    public function test_report_function()
    {
        $handler = new Handler($this->app);
        $exception = new Exception();
        $this->assertNull($handler->report($exception));
    }

    public function test_render_function()
    {
        $handler = new Handler($this->app);
        $exception = new Exception();
        $this->assertInstanceOf(Response::class, $handler->render($this->app['request'], $exception));
    }
}
