<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class RecursiveTest extends TestCase
{
    /** @test */
    public function it_coverts_child_arrays_to_collections(): void
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
    public function it_coverts_child_objects_to_collections(): void
    {
        $collection = Collection::make([
            'child' => (object) [1, 2, 3, 'anotherchild' => (object) [1, 2, 3]],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(Collection::class, $collection['child']['anotherchild']);
    }

    /** @test */
    public function it_coverts_child_arrays_to_collections_with_a_max_depth(): void
    {
        $collection = Collection::make([
            'child' => [
                1, 2, 3, 'anotherchild' => [
                    1, 2, 3, 'lastchild' => [1, 2, 3],
                ],
            ],
        ])
            ->recursive(1);

        $this->assertInstanceOf(Collection::class, $collection['child']);
        $this->assertInstanceOf(Collection::class, $collection['child']['anotherchild']);
        $this->assertIsArray($collection['child']['anotherchild']['lastchild']);
    }

    /** @test */
    public function it_allows_object_like_access_to_items(): void
    {
        $collection = Collection::make([
            'child' => ['intchild' => 1, 2, 3, 'anotherchild' => (object) [1, 2, 3]],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection->child);
        $this->assertInstanceOf(Collection::class, $collection->child->anotherchild);
        $this->assertIsInt($collection->child->intchild);
    }

    /** @test */
    public function it_does_not_add_properties_for_integer_keys(): void
    {
        $collection = Collection::make([
            'child' => [1 => 'notproperty', 2, 3, 'anotherchild' => (object) [1, 2, 3]],
        ])
            ->recursive();

        $this->expectExceptionMessage('Property [1] does not exist on this collection instance.');

        $collection->child->{'1'};
    }

    /** @test */
    public function it_respects_inheritance(): void
    {
        $collection = ChildCollection::make([
            'child' => [1, 2, 3, 'anotherchild' => (object) [1, 2, 3]],
        ])
            ->recursive();

        $this->assertInstanceOf(ChildCollection::class, $collection->child);
        $this->assertInstanceOf(ChildCollection::class, $collection->child->anotherchild);
    }

    /** @test */
    public function it_ignores_closures(): void
    {
        $collection = Collection::make([
            'child' => [
                1, 2, 3, 'anotherchild' => fn () => 1 + 2,
            ],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection->child);
        $this->assertInstanceOf(Closure::class, $collection->child->anotherchild);
    }

    /** @test */
    public function it_accepts_callback_to_extend_exit_conditions(): void
    {
        $collection = Collection::make([
            'child' => [1, 2, 3, 'anotherchild' => now()],
        ])
            ->recursive();

        $this->assertInstanceOf(Collection::class, $collection->child->anotherchild);

        $collection = Collection::make([
            'child' => [1, 2, 3, 'anotherchild' => now()],
        ])
            ->recursive(
                shouldExit: fn ($value, $key, $depth, $maxDepth) => $value instanceof Carbon,
            );

        $this->assertInstanceOf(Carbon::class, $collection->child->anotherchild);
    }
}

class ChildCollection extends Collection
{
}
