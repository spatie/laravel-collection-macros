<?php

namespace Spatie\CollectionMacros\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;

abstract class IntegrationTestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [CollectionMacroServiceProvider::class];
    }

    public function avoidTestMarkedAsRisky()
    {
        $this->assertTrue(true);
    }
}
