<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class PrioritizeTest extends TestCase
{
    /** @test */
    public function it_moves_a_single_element_to_the_start_of_the_collection()
    {
        $collection = Collection::make([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
        ]);

        $prioritized = $collection->prioritize(function (array $item) {
            return $item['id'] === 2;
        });

        $this->assertEquals([2, 1, 3], $prioritized->pluck('id')->toArray());
    }

    /** @test */
    public function it_moves_multiple_elements_to_the_start_of_the_collection()
    {
        $collection = Collection::make([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
        ]);

        $prioritized = $collection->prioritize(function (array $item) {
            return in_array($item['id'], [2, 4]);
        });

        $this->assertEquals([2, 4, 1, 3], $prioritized->pluck('id')->toArray());
    }

    /** @test */
    public function it_keeps_keys_of_the_original_collection()
    {
        $collection = Collection::make([
            [
                'mfr' => 'Apple',
                'name' => 'iPhone Xs',
            ],
            [
                'mfr' => 'Google',
                'name' => 'Pixel 3',
            ],
            [
                'mfr' => 'Microsoft',
                'name' => 'Lumia 950',
            ],
            [
                'mfr' => 'OnePlus',
                'name' => '6T',
            ],
            [
                'mfr' => 'Samsung',
                'name' => 'Galaxy S9',
            ],
        ])->keyBy('mfr');

        $prioritized = $collection->prioritize(function ($phones, $mfr) {
            return in_array($mfr, ['OnePlus', 'Samsung']);
        });
        $this->assertEquals(['OnePlus', 'Samsung', 'Apple', 'Google', 'Microsoft'], $prioritized->keys()->toArray());
    }
}
