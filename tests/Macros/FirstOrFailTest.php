<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Exceptions\CollectionItemNotFound;
use Spatie\CollectionMacros\Test\TestCase;

class FirstOrFailTest extends TestCase
{
    /** @test */
    public function it_returns_first_item_when_there_is_one()
    {
        if (method_exists(Collection::class, 'firstOrFail')) {
            $this->expectNotToPerformAssertions();
            return;
        }

        $result = Collection::make([1, 2, 3, 4])->firstOrFail();

        $this->assertEquals(1, $result);
    }

    /** @test */
    public function it_throws_exception_when_there_are_no_items()
    {
        if (method_exists(Collection::class, 'firstOrFail')) {
            $this->expectNotToPerformAssertions();
            return;
        }
        
        $this->expectException(CollectionItemNotFound::class);
        Collection::make()->firstOrFail();
    }
}
