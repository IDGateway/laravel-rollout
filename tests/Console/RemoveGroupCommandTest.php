<?php

namespace Tests\Console;

use Illuminate\Support\Facades\Artisan;
use Opensoft\Rollout\Rollout;
use Tests\TestCase;

class RemoveGroupCommandTest extends TestCase
{
    public function test_running_the_command_with_a_feature_will_remove_the_corresponding_user(): void
    {
        $store = app()->make('cache.store')->getStore();

        $rollout = app()->make(Rollout::class);
        $rollout->activateGroup('derp', 'ballers');

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('0||ballers||[]', $store->get('rollout.feature:derp'));

        Artisan::call('rollout:remove-group', [
            'feature' => 'derp',
            'group' => 'ballers',
        ]);

        $this->assertEquals('derp', $store->get('rollout.feature:__features__'));
        $this->assertEquals('0||||[]', $store->get('rollout.feature:derp'));
    }
}
