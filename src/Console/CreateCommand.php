<?php

namespace Jaspaul\LaravelRollout\Console;

use Illuminate\Console\Command;

class CreateCommand extends RolloutCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollout:create {feature}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a feature with the provided name.';

    /**
     * Creates the provided feature.
     */
    public function handle(): int
    {
        $name = $this->argument('feature');
        $this->renderFeatureAsTable($name);

        return Command::SUCCESS;
    }
}
