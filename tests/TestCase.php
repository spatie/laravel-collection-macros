<?php

namespace Spatie\CollectionMacros\Test;

use Mockery;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * @property \Mockery\MockInterface spy
 */
abstract class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        require_once __DIR__.'/../src/macros.php';

        $this->spy = Mockery::spy();
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
