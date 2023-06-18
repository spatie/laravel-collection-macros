<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class KeysToPropertiesTest extends TestCase
{
    /** @test */
    public function it_creates_properties_from_string_keys()
    {
        $collection = Collection::make([
            'child' => [1, 2, 3],
            'anotherchild' => [1, 2, 3],
        ])->keysToProperties();

        $this->assertTrue(property_exists($collection, 'child'));
        $this->assertTrue(property_exists($collection, 'anotherchild'));
    }

    /** @test */
    public function it_does_not_create_properties_for_integer_keys()
    {
        $collection = Collection::make([1, 2, 3])
            ->keysToProperties();

        $this->assertFalse(property_exists($collection, 0));
    }
}
