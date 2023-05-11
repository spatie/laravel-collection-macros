<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class PluckManyValuesTest extends TestCase
{
    /** @test */
    public function it_provides_a_pluckManyValues_macro()
    {
        $this->assertTrue(Collection::hasMacro('pluckManyValues'));
    }

    /** @test */
    public function it_can_pluck_from_a_collection_of_collections()
    {
        $data = Collection::make([
            collect(['id' => 1, 'name' => 'matt', 'hobby' => 'coding']),
            collect(['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking']),
        ]);

        $this->assertEquals($data->map->only(['name', 'hobby'])->map->values(), $data->pluckManyValues(['name', 'hobby']));
    }

    /** @test */
    public function it_can_pluck_from_array_and_object_items()
    {
        $data = Collection::make([
            (object) ['id' => 1, 'name' => 'matt', 'hobby' => 'coding'],
            ['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking'],
        ]);

        $this->assertEquals(
            [
                (object) ['matt', 'coding'],
                ['tomo', 'cooking'],
            ],
            $data->pluckManyValues(['name', 'hobby'])->all()
        );
    }

    /** @test */
    public function it_can_pluck_from_objects_that_implement_array_access_interface()
    {
        $data = Collection::make([
            new TestArrayAccessImplementation(['id' => 1, 'name' => 'marco', 'hobby' => 'drinking']),
            new TestArrayAccessImplementation(['id' => 2, 'name' => 'belle', 'hobby' => 'cross-stitch']),
        ]);

        $this->assertEquals(
            [
                ['marco', 'drinking'],
                ['belle', 'cross-stitch'],
            ],
            $data->pluckManyValues(['name', 'hobby'])->all()
        );
    }
}
