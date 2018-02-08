<?php

namespace Spatie\CollectionMacros\Test;

use ReflectionClass;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;

abstract class TestCase extends BaseTestCase
{
    public function setUp()
    {
        $this->createDummyprovider()->register();
    }

    protected function createDummyprovider(): CollectionMacroServiceProvider
    {
        $reflectionClass = new ReflectionClass(CollectionMacroServiceProvider::class);

        return $reflectionClass->newInstanceWithoutConstructor();
    }
}
