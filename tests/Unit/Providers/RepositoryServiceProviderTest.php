<?php

namespace Tests\Unit\Providers;

use Tests\TestCase;
use App\Providers\RepositoryServiceProvider;

class RepositoryServiceProviderTest extends TestCase
{
    public function test_register_function()
    {
        $provider = new RepositoryServiceProvider($this->app);
        $this->assertNull($provider->register());
    }
}
