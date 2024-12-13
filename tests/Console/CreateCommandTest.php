<?php

namespace Tests\Console;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CreateCommandTest extends TestCase
{
    function test_running_the_command_with_a_feature_will_create_the_corresponding_feature(): void
    {
        Artisan::call('rollout:create', [
            'feature' => 'derp',
        ]);

        $store = app()->make('cache.store')->getStore();

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('0||||[]', $store->get('rollout.feature:derp'));
    }
}
