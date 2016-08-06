<?php

namespace Spatie\CollectionMacros\Test;

use Mockery;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        require_once __DIR__.'/../src/macros.php';
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
