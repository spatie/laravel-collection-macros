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
    public function it_ignores_closures()
    {
        $collection = Collection::make([
            'child' => [
                1, 2, 3, 'anotherchild' => fn() => 1 + 2,
            ],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(\Closure::class, $collection['child']['anotherchild']);
        $this->assertNotInstanceOf(Collection::class, $collection['child']['anotherchild']);
    }
}
