<?php

namespace Jaspaul\LaravelRollout\Console;

use Opensoft\Rollout\Rollout;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Jaspaul\LaravelRollout\FeaturePresenter;
use Jaspaul\LaravelRollout\Helpers\FeatureTable;

abstract class RolloutCommand extends Command
{
    /**
     * Initialize our create feature command with an instance of the rollout
     * service.
     */
    public function __construct(
        protected readonly Rollout $rollout,
    ) {
        parent::__construct();
    }

    /**
     * Renders the feature as a table.
     */
    public function renderFeatureAsTable(string $featureName): void
    {
        $presenters = (new Collection([$featureName]))
            ->map(function ($feature) {
                return new FeaturePresenter($this->rollout->get($feature));
            });

        (new FeatureTable($presenters))->render($this);
    }

    /**
     * Performs the logic for the command.
     */
    abstract public function handle(): int;
}
