<?php

namespace Tests\Console;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Artisan;
use Jaspaul\LaravelRollout\Helpers\User;
use Opensoft\Rollout\Rollout;
use Tests\Doubles\SampleGroup;
use Tests\TestCase;

class AddGroupCommandTest extends TestCase
{
    public function test_running_the_command_with_a_feature_will_create_the_corresponding_feature(): void
    {
        Artisan::call('rollout:add-group', [
            'feature' => 'derp',
            'group' => 'ballers',
        ]);

        /** @var Store $store */
        $store = app()->make('cache.store')->getStore();

        $this->assertSame('derp', $store->get('rollout.feature:__features__'));
        $this->assertSame('0||ballers||[]', $store->get('rollout.feature:derp'));
    }

    public function test_rollout_will_flag_a_user_as_active_if_the_group_returns_true(): void
    {
        config(['laravel-rollout.groups' => [SampleGroup::class]]);

        $this->assertFalse(app()->make(Rollout::class)->isActive('derp', new User('id')));

        Artisan::call('rollout:add-group', [
            'feature' => 'derp',
            'group' => 'sample-group',
        ]);

        $this->assertTrue(app()->make(Rollout::class)->isActive('derp', new User('id')));
    }
}
