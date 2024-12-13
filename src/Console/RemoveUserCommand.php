<?php

namespace Jaspaul\LaravelRollout\Console;

use Illuminate\Console\Command;
use Jaspaul\LaravelRollout\Helpers\User;

class RemoveUserCommand extends RolloutCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollout:remove-user {feature} {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the provided user id from the feature.';

    /**
     * Removes the provided user from the feature. Note this will create
     * the feature as a side effect.
     */
    public function handle(): int
    {
        $name = $this->argument('feature');
        $userIdentifier = $this->argument('user');

        $this->rollout->deactivateUser($name, new User($userIdentifier));
        $this->renderFeatureAsTable($name);

        return Command::SUCCESS;
    }
}
