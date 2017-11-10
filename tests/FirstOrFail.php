<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class FirstOrFail extends TestCase
{
    /** @test */
    public function it_returns_first_item_when_there_is_one()
    {
        $result = Collection::make([1, 2, 3, 4])->firstOrFail();

        $this->assertEquals([1], $result->values()->toArray());
    }

    /** @test */
    public function it_throws_exception_when_there_are_no_items()
    {
        $this->expectException(Collection::make()->firstOrFail());
    }
}
