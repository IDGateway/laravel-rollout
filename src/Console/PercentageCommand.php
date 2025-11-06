<?php

namespace Jaspaul\LaravelRollout\Console;

use Illuminate\Console\Command;

class PercentageCommand extends RolloutCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollout:percentage {feature} {percentage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rolls out the feature to the provided percentage of users.';

    /**
     * Updates the rollout percentage to the provided value.
     */
    public function handle(): int
    {
        $name = $this->argument('feature');
        $percentage = $this->argument('percentage');

        $this->rollout->activatePercentage($name, $percentage);

        $this->renderFeatureAsTable($name);

        return Command::SUCCESS;
    }
}
