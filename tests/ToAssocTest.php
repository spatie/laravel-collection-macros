<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class ToAssocTest extends TestCase
{
    /** @test */
    public function it_provides_a_toAssoc_macro()
    {
        $this->assertTrue(Collection::hasMacro('toAssoc'));
    }

    /** @test */
    public function it_can_transform_a_collection_into_an_associative_array()
    {
        $this->assertEquals([
            'john@example.com' => 'John',
            'jane@example.com' => 'Jane',
            'dave@example.com' => 'Dave',
        ], Collection::make([
            ['john@example.com', 'John'],
            ['jane@example.com', 'Jane'],
            ['dave@example.com', 'Dave'],
        ])->toAssoc()->toArray());
    }
}
