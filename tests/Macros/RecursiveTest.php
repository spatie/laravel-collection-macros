<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class RecursiveTest extends TestCase
{
    /** @test */
    public function it_provides_recursive_macro()
    {
        $this->assertTrue(Collection::hasMacro('recursive'));
    }

    /** @test */
    public function it_can_collect_recursive()
    {
        $collection = new Collection([
            'item' => [
                'children' => [
                    'next' => [],
                ],
            ]
        ]);

        $expected = new Collection([
            'item' => new Collection([
                'children' => new Collection([
                    'next' => new Collection()
                ]),
            ])
        ]);

        $this->assertEquals(
            $expected,
            $collection->recursive()
        );
    }
}
