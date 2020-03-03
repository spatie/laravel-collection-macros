<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class PluckToArrayTest extends TestCase
{
    /** @test */
    public function it_returns_array_of_attributes()
    {
        $result = Collection::make([
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
        ])->pluckToArray('id');

        $expected = [1, 2, 3];

        $this->assertEquals($expected, $result);

        $this->assertTrue(is_array($result));
    }

    /** @test */
    public function it_return_array_of_attributes_with_correct_keys()
    {
        $result = Collection::make([
            ['id' => 2, 'title' => 'A'],
            ['id' => 3, 'title' => 'B'],
            ['id' => 4, 'title' => 'C'],
        ])->pluckToArray('title', 'id');

        $expected = [2 => 'A', 3 => 'B', 4 => 'C'];

        $this->assertEquals($expected, $result);
    }
}
