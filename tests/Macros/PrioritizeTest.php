<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class PrioritizeTest extends TestCase
{
    /** @test */
    public function it_moves_elements_to_the_start_of_the_collection()
    {
        $collection = Collection::make([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
        ]);

        $prioritized = $collection->prioritize(function(array $item) {
            return $item['id'] === 2;
        });

        $this->assertEquals([2,1,3], $prioritized->pluck('id')->toArray());
    }
}
