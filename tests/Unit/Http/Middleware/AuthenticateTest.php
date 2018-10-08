<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

class AuthenticateTest extends TestCase
{
    public function test_handle_function_unauthorized()
    {
        $middleware = new Authenticate($this->app['auth']);
        $this->expectException(AuthenticationException::class);
        $middleware->handle($this->app['request'], function () {});
    }

    public function test_handle_function_authorized()
    {
        $middleware = new Authenticate($this->app['auth']);
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $this->assertNull($middleware->handle($this->app['request'], function () {}));
    }
}
