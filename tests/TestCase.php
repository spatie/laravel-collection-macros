<?php

namespace Spatie\CollectionMacros\Test;

use Mockery;
use PHPUnit_Framework_TestCase;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        require_once __DIR__ . '/../src/macros.php';
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
