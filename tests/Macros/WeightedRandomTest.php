<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class WeightedRandom extends TestCase
{
    /** @test */
    public function it_will_probably_return_the_heaviest_item_most()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 1],
            ['value' => 'b', 'weight' => 10],
            ['value' => 'c', 'weight' => 1],
        ]);

        $mostPopularValue = Collection::range(0, 1000)
            ->map(function () use ($items) {
                return $items->weightedRandom(function (array $item) {
                    return $item['weight'];
                });
            })
            ->groupBy('value')
            ->map
            ->count()
            ->sortDesc()
            ->flip()
            ->first();

        $this->assertEquals('b', $mostPopularValue);
    }

    /** @test */
    public function it_will_not_pick_a_value_without_a_weight()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 0],
            ['value' => 'b', 'weight' => 0],
            ['value' => 'c', 'weight' => 1],
            ['value' => 'c', 'weight' => 0],
        ]);

        $pickedItem = $items->weightedRandom(fn (array $item) => $item['weight']);

        $this->assertEquals('c', $pickedItem['value']);
    }

    /** @test */
    public function it_will_pick_a_random_value_when_all_values_are_zero()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 0],
            ['value' => 'b', 'weight' => 0],
            ['value' => 'c', 'weight' => 0],
        ]);

        $this->assertIsArray($items->weightedRandom(fn (array $item) => $item['weight']));
    }

    /** @test */
    public function it_can_pick_a_weighted_random_by_attribute_name()
    {
        $items = collect([
            ['value' => 'a', 'weight' => 0],
            ['value' => 'b', 'weight' => 1],
            ['value' => 'c', 'weight' => 0],
        ]);

        $item = ($items->weightedRandom('weight'));

        $this->assertEquals('b', $item['value']);
    }
}
