<?php

namespace Jaspaul\LaravelRollout\Console;

use Illuminate\Console\Command;

class DeleteCommand extends RolloutCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollout:delete {feature}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes the feature with the provided name.';

    /**
     * Deletes the provided feature.
     */
    public function handle(): int
    {
        $name = $this->argument('feature');
        $this->rollout->remove($name);
        $this->line(sprintf("The '%s' flag was removed.", $name));

        return Command::SUCCESS;
    }
}
