<?php

namespace Tests\Unit\Providers;

use Tests\TestCase;
use App\Providers\BroadcastServiceProvider;

class BroadcastServiceProviderTest extends TestCase
{
    public function test_boot_function()
    {
        $provider = new BroadcastServiceProvider($this->app);
        $this->assertNull($provider->boot());
    }
}
