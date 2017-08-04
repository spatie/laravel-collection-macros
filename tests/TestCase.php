<?php

namespace Spatie\CollectionMacros\Test;

use Mockery;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /** @var \Mockery\MockInterface spy */
    public $spy;

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

    public function avoidTestMarkedAsRisky()
    {
        $this->assertTrue(true);
    }
}
