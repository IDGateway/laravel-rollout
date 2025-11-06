<?php

namespace Tests\Console;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EveryoneCommandTest extends TestCase
{
    function test_running_the_command_with_a_feature_will_set_the_rollout_percentage_to_100(): void
    {
        Artisan::call('rollout:everyone', [
            'feature' => 'derp',
        ]);

        $store = app()->make('cache.store')->getStore();

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('100||||[]', $store->get('rollout.feature:derp'));
    }
}
