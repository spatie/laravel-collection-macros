<?php

namespace Spatie\CollectionMacros\Test;

use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;

abstract class TestCase extends BaseTestCase
{
    public function setup(): void
    {
        $this->createDummyprovider()->register();
    }

    protected function createDummyprovider(): CollectionMacroServiceProvider
    {
        $reflectionClass = new ReflectionClass(CollectionMacroServiceProvider::class);

        return $reflectionClass->newInstanceWithoutConstructor();
    }
}
