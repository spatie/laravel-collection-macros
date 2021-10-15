<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class InsertAfterTest extends TestCase
{
    /** @test */
    public function it_provides_an_insertAfter_macro()
    {
        $this->assertTrue(Collection::hasMacro('insertAfter'));
    }

    /** @test */
    public function it_inserts_at_the_correct_index()
    {
        $collection = Collection::make(['zero', 'two', 'three']);
        $collection->insertAfter('zero', 'one');
        $this->assertEquals(json_encode(['zero', 'one', 'two', 'three']), json_encode($collection->toArray()));
    }

    /** @test */
    public function it_returns_the_updated_collection()
    {
        $collection = Collection::make(['zero', 'two', 'three'])->insertAfter('zero', 'one');
        $this->assertEquals(
            json_encode(['zero', 'one', 'two', 'three']),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function it_maintains_array_keys()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfter(0, 'one');
        $this->assertEquals(
            json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function it_inserts_with_a_key()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfter(0, 5, 'five');
        $this->assertEquals(
            json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function it_inserts_at_the_end_of_the_array()
    {
        $collection = Collection::make(['one', 'two'])->insertAfter('two', 'three');
        $this->assertEquals(
            json_encode(['one', 'two', 'three']),
            json_encode($collection->toArray())
        );
    }
}
