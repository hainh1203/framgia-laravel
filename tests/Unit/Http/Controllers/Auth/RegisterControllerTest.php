<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Controllers\Auth\RegisterController;
use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Validation\Validator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\RedirectResponse;
use Mockery as m;
use Event;

class RegisterControllerTest extends TestCase
{
    protected $repository;

    public function setUp() {
        $this->afterApplicationCreated(function() {
            $this->repository = m::mock($this->app->make(UserRepository::class));
        });
        parent::setUp();
    }

    public function test_register_function()
    {
        Event::fake();
        $this->repository
            ->shouldReceive('create')
            ->with(m::any())
            ->andReturn(new User());
        $controller = new RegisterController($this->repository);
        $validator = m::mock(new Validator($this->app['translator'], [], []));
        $validator
            ->shouldReceive('validate')
            ->andReturn(null);
        $factory = m::mock($this->app->make(Factory::class));
        $factory
            ->shouldReceive('make')
            ->andReturn($validator);
        $this->app['validator'] = $factory;
        $params = [
            'name' => 'テスト',
            'email' => 'test@site.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $request = new Request();
        $request->merge($params);
        $this->assertInstanceOf(RedirectResponse::class, $controller->register($request));
    }
}
