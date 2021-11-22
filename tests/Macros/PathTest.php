<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class PathTest extends TestCase
{
    /** @test */
    public function it_retrieves_item_from_collection()
    {
        $collection = new Collection(['foo', 'bar']);

        $this->assertSame(
            'foo',
            $collection->path(0)
        );
    }

    /** @test */
    public function it_retrieves_item_from_collection_using_dot_notation()
    {
        $collection = new Collection([
            'foo' => [
                'bar' => [
                    'baz' => 100,
                ],
            ],
        ]);

        $this->assertSame(
            100,
            $collection->path('foo.bar.baz')
        );
    }

    /** @test */
    public function it_doesnt_remove_item_from_collection()
    {
        $collection = new Collection(['foo', 'bar']);

        $collection->path(0);

        $this->assertEquals(
            [
                0 => 'foo',
                1 => 'bar',
            ],
            $collection->all()
        );
    }

    /** @test */
    public function it_returns_default()
    {
        $collection = new Collection([]);

        $this->assertSame(
            'foo',
            $collection->path(0, 'foo')
        );
    }
}
