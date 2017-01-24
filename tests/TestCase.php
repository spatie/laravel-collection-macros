<?php

namespace Spatie\CollectionMacros\Test;

use Mockery;
use PHPUnit_Framework_TestCase;

abstract class TestCase extends PHPUnit_Framework_TestCase
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
}
