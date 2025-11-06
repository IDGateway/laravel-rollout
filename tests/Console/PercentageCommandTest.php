<?php

namespace Tests\Console;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PercentageCommandTest extends TestCase
{
    function test_running_the_command_will_update_the_percentage_to_the_provided_value(): void
    {
        Artisan::call('rollout:percentage', [
            'feature' => 'derp',
            'percentage' => 88,
        ]);

        $store = app()->make('cache.store')->getStore();

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('88||||[]', $store->get('rollout.feature:derp'));
    }
}
