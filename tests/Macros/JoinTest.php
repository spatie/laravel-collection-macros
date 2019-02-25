<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class JoinTest extends TestCase
{
    /** @test */
    public function it_can_join_items_in_the_collection()
    {
        $this->assertEquals('a, b, c', (new Collection(['a', 'b', 'c']))->join(', '));

        $this->assertEquals('a, b and c', (new Collection(['a', 'b', 'c']))->join(', ', ' and '));

        $this->assertEquals('a and b', (new Collection(['a', 'b']))->join(', ', ' and '));

        $this->assertEquals('a', (new Collection(['a']))->join(', ', ' and '));

        $this->assertEquals('', (new Collection([]))->join(', ', ' and '));
    }
}
