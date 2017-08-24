<?php

namespace Spatie\CollectionMacros\Test;

use Mockery;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;

abstract class TestCase extends Orchestra
{
    /** @var \Mockery\MockInterface spy */
    public $spy;

    public function setUp()
    {
        parent::setUp();

        $this->spy = Mockery::spy();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    protected function getPackageProviders($app)
    {
        return [CollectionMacroServiceProvider::class];
    }

    public function avoidTestMarkedAsRisky()
    {
        $this->assertTrue(true);
    }
}
