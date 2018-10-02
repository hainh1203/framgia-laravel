<?php

namespace Tests\Unit\Models;

use Tests\ModelTestCase as TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_model_configuration()
    {
        $this->runConfigurationAssertions(new User(), [
            'name',
            'email',
            'password',
        ], [
            'password',
            'remember_token',
        ]);
    }
}
