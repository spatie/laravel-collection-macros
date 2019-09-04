<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class CollectByTest extends TestCase
{
    /** @test */
    public function it_returns_a_collection_containing_the_collected_items()
    {
        $collection = new Collection([
            'name' => 'taco',
            'ingredients' => [
                'cheese',
                'lettuce',
                'beef',
                'tortilla',
            ],
            'should_eat' => true,
        ]);

        $ingredients = $collection->collectBy('ingredients');

        $this->assertTrue(is_a($ingredients, Collection::class));

        $this->assertEquals([
            'cheese',
            'lettuce',
            'beef',
            'tortilla',
        ], $ingredients->toArray());
    }

    /** @test */
    public function it_returns_default_when_key_is_missing()
    {
        $collection = new Collection([
            'name' => 'taco',
            'ingredients' => [
                'cheese',
                'lettuce',
                'beef',
                'tortilla',
            ],
            'should_eat' => true,
        ]);

        $ingredients = $collection->collectBy('build_it', $collection->get('ingredients'));

        $this->assertEquals($collection->collectBy('ingredients'), $ingredients);
    }

    /** @test */
    public function it_returns_empty_collection_when_missing_key_without_default()
    {
        $collection = new Collection([
            'name' => 'taco',
            'ingredients' => [
                'cheese',
                'lettuce',
                'beef',
                'tortilla',
            ],
            'should_eat' => true,
        ]);

        $ingredients = $collection->collectBy('build_it');

        $this->assertEquals(new Collection, $ingredients);
    }
}
