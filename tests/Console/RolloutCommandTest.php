<?php

namespace Tests\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Jaspaul\LaravelRollout\Console\RolloutCommand;
use Jaspaul\LaravelRollout\Drivers\Cache;
use Opensoft\Rollout\Rollout;
use Tests\TestCase;

class RolloutCommandTest extends TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            TestServiceProvider::class,
        ];
    }

    function test_render_feature_as_a_table_renders_the_feature_as_a_table(): void
    {
        Artisan::call('rollout:test', [
            'feature' => 'derp',
        ]);

        $output = $this->app[Kernel::class]->output();

        $this->assertStringContainsString('derp', $output);
    }
}

class TestCommand extends RolloutCommand
{
    protected $signature = 'rollout:test {feature}';

    protected $description = 'A simple helper for testing.';

    public function handle(): int
    {
        $name = $this->argument('feature');
        $this->renderFeatureAsTable($name);

        return Command::SUCCESS;
    }
}

class TestServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->app->singleton(Rollout::class, function ($app) {
            return new Rollout(new Cache($app->make('cache.store')));
        });

        $this->commands([
            TestCommand::class,
        ]);
    }
}
