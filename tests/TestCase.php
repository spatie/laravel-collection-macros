<?php

namespace Spatie\CollectionMacros\Test;

use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        $this->createDummyprovider()->register();

        ray()->newScreen($this->getName());
    }

    protected function createDummyprovider(): CollectionMacroServiceProvider
    {
        $reflectionClass = new ReflectionClass(CollectionMacroServiceProvider::class);

        return $reflectionClass->newInstanceWithoutConstructor();
    }
}
