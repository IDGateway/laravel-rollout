<?php

namespace Tests\Doubles;

use Tests\TestCase;
use Jaspaul\LaravelRollout\Contracts\Group;

class SampleGroup implements Group
{
    /**
     * The name of the group.
     */
    public function getName(): string
    {
        return 'sample-group';
    }

    /**
     * Defines the rule membership in the group.
     */
    public function hasMember(mixed $user = null): bool
    {
        return true;
    }
}
