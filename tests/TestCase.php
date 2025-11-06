<?php

namespace Tests;

use Illuminate\Foundation\Application;
use Mockery;
use Orchestra\Testbench\TestCase as Base;
use Jaspaul\LaravelRollout\ServiceProvider;

abstract class TestCase extends Base
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpMockery();
    }

    protected function tearDown(): void
    {
        $this->close_mockery();
        parent::tearDown();
    }

    protected function setUpMockery(): void
    {
        Mockery::getConfiguration()->allowMockingNonExistentMethods(false);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function close_mockery(): void
    {
        Mockery::close();
    }
}
