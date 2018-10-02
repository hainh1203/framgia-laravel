<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Models\User;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\RedirectResponse;

class RedirectIfAuthenticatedTest extends TestCase
{
    public function test_handle_function_unauthorized()
    {
        $middleware = new RedirectIfAuthenticated($this->app['auth']);
        $this->assertNull($middleware->handle($this->app['request'], function () {}));
    }

    public function test_handle_function_authorized()
    {
        $middleware = new RedirectIfAuthenticated($this->app['auth']);
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $this->assertInstanceOf(RedirectResponse::class, $middleware->handle($this->app['request'], function () {}));
    }
}
