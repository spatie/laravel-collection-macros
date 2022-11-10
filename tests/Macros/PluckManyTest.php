<?php

namespace Spatie\CollectionMacros\Test\Macros;

use ArrayAccess;
use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class PluckManyTest extends TestCase
{
    /** @test */
    public function it_provides_a_pluckMany_macro()
    {
        $this->assertTrue(Collection::hasMacro('pluckMany'));
    }

    /** @test */
    public function it_can_pluck_from_a_collection_of_collections()
    {
        $data = Collection::make([
            collect(['id' => 1, 'name' => 'matt', 'hobby' => 'coding']),
            collect(['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking']),
        ]);

        $this->assertEquals($data->map->only(['name', 'hobby']), $data->pluckMany(['name', 'hobby']));
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
                (object) ['name' => 'matt', 'hobby' => 'coding'],
                ['name' => 'tomo', 'hobby' => 'cooking'],
            ],
            $data->pluckMany(['name', 'hobby'])->all()
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
                ['name' => 'marco', 'hobby' => 'drinking'],
                ['name' => 'belle', 'hobby' => 'cross-stitch'],
            ],
            $data->pluckMany(['name', 'hobby'])->all()
        );
    }
}

class TestArrayAccessImplementation implements ArrayAccess
{
    private $arr;

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->arr[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->arr[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->arr[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->arr[$offset]);
    }
}
