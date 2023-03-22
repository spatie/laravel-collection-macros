<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class RecursiveTest extends TestCase
{
    /** @test */
    public function it_coverts_child_arrays_to_collections()
    {
        $collection = Collection::make([
            'child' => [
                1, 2, 3, 'anotherchild' => [1, 2, 3],
            ],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(Collection::class, $collection['child']['anotherchild']);
    }

    /** @test */
    public function it_coverts_child_objects_to_collections()
    {
        $collection = Collection::make([
            'child' => (object) [1, 2, 3, 'anotherchild' => (object) [1, 2, 3]],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(Collection::class, $collection['child']['anotherchild']);
    }

    /** @test */
    public function it_coverts_child_arrays_to_collections_with_a_max_depth()
    {
        $collection = Collection::make([
            'child' => [
                1, 2, 3, 'anotherchild' => [
                    1, 2, 3, 'lastchild' => [1, 2, 3]
                ],
            ],
        ])
            ->recursive(1);

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(Collection::class, $collection['child']['anotherchild']);
        $this->assertIsArray($collection['child']['anotherchild']['lastchild']);
    }
}
