<?php

namespace Jaspaul\LaravelRollout\Console;

use Illuminate\Console\Command;
use Jaspaul\LaravelRollout\Helpers\User;

class AddUserCommand extends RolloutCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollout:add-user {feature} {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds the provided user id to the feature.';

    /**
     * Adds the provided user to the requested feature. Note this will create
     * the feature as a side effect.
     */
    public function handle(): int
    {
        $name = $this->argument('feature');
        $userIdentifier = $this->argument('user');

        $this->rollout->activateUser($name, new User($userIdentifier));

        $this->renderFeatureAsTable($name);

        return Command::SUCCESS;
    }
}
