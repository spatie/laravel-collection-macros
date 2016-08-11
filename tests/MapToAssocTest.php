<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class MapToAssocTest extends TestCase
{
    /** @test */
    public function it_provides_a_mapToAssoc_macro()
    {
        $this->assertTrue(Collection::hasMacro('mapToAssoc'));
    }

    /** @test */
    public function it_can_map_a_collection_and_transform_it_into_an_associative_array()
    {
        $employees = collect([
            [
                'name' => 'John',
                'department' => 'Sales',
                'email' => 'john@example.com',
            ],
            [
                'name' => 'Jane',
                'department' => 'Marketing',
                'email' => 'jane@example.com',
            ],
            [
                'name' => 'Dave',
                'department' => 'Marketing',
                'email' => 'dave@example.com',
            ],
        ]);

        $this->assertEquals([
            'john@example.com' => 'John',
            'jane@example.com' => 'Jane',
            'dave@example.com' => 'Dave',
        ], $employees->mapToAssoc(function ($employee) {
            return [$employee['email'], $employee['name']];
        })->toArray());
    }
}
