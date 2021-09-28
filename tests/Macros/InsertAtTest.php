<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class InsertAtTest extends TestCase
{
    /** @test */
    public function it_provides_an_insertAt_macro()
    {
        $this->assertTrue(Collection::hasMacro('insertAt'));
    }

    /** @test */
    public function it_inserts_at_the_correct_index()
    {
        $collection = Collection::make(['zero', 'two', 'three']);
        $collection->insertAt(1, 'one');
        $this->assertEquals(json_encode(['zero', 'one', 'two', 'three']), json_encode($collection->toArray()));
    }

    /** @test */
    public function it_returns_the_updated_collection()
    {
        $collection = Collection::make(['zero', 'two', 'three'])->insertAt(1, 'one');
        $this->assertEquals(json_encode(['zero', 'one', 'two', 'three']), json_encode($collection->toArray()));
    }

    /** @test */
    public function it_maintains_array_keys()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAt(1, 'one');
        $this->assertEquals(
            json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }

    /** @test */
    public function it_inserts_with_a_key()
    {
        $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAt(1, 5, 'five');

        $this->assertEquals(
            json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]),
            json_encode($collection->toArray())
        );
    }
}
