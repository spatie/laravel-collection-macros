<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class TransposeTest extends TestCase
{
    /** @test */
    public function it_can_transpose_an_array()
    {
        $collection = new Collection([
            ['11', '12', '13'],
            ['21', '22', '23'],
            ['31', '32', '33'],
        ]);
        $expected = new Collection([
            new Collection(['11', '21', '31']),
            new Collection(['12', '22', '32']),
            new Collection(['13', '23', '33']),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function it_will_enforce_length_equality()
    {
        $this->expectException(\LengthException::class);
        $this->expectExceptionMessage("Element's length must be equal.");

        $collection = new Collection([
            ['11', '12', '13'],
            ['21', '22'],
            ['31', '32', '33'],
        ]);

        $collection->transpose();
    }

    /** @test */
    public function it_will_remove_existing_keys()
    {
        $collection = new Collection([
            'one' => ['11', '12', '13'],
            'two' => ['21', '22', '23'],
            'three' => ['31', '32', '33'],
        ]);

        $expected = new Collection([
            new Collection(['11', '21', '31']),
            new Collection(['12', '22', '32']),
            new Collection(['13', '23', '33']),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }
}
