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
    public function it_inserts_at_correct_index()
    {
        $data = Collection::make(['zero', 'two', 'three']);
        $data->insertAt(1, 'one');

        $this->assertEquals(['zero', 'one', 'two', 'three'], $data->toArray());
    }
}
