<?php

namespace Tests\Console;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Opensoft\Rollout\Rollout;
use Tests\TestCase;

class DeleteCommandTest extends TestCase
{
    function test_running_the_command_with_a_feature_will_remove_the_corresponding_feature(): void
    {
        $store = app()->make('cache.store')->getStore();

        $rollout = app()->make(Rollout::class);
        $rollout->get('derp');

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));

        Artisan::call('rollout:delete', [
            'feature' => 'derp',
        ]);

        $store = app()->make('cache.store')->getStore();

        $this->assertEquals('', $store->get('rollout.feature:__features__'));
    }

    function test_running_the_command_outputs_a_success_statement(): void
    {
        Artisan::call('rollout:delete', [
            'feature' => 'derp',
        ]);

        $output = $this->app[Kernel::class]->output();

        $this->assertStringContainsString('derp', $output);
    }
}
