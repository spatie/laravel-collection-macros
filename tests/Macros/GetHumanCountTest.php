<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class GetHumanCountTest extends TestCase
{
    /** @test */
    public function it_gets_the_first_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(1, $data->first());
    }

    /** @test */
    public function it_gets_the_second_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(2, $data->second());
    }

    /** @test */
    public function it_gets_the_third_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(3, $data->third());
    }

    /** @test */
    public function it_gets_the_fourth_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(4, $data->fourth());
    }

    /** @test */
    public function it_gets_the_fifth_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(5, $data->fifth());
    }

    /** @test */
    public function it_gets_the_sixth_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(6, $data->sixth());
    }

    /** @test */
    public function it_gets_the_seventh_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(7, $data->seventh());
    }

    /** @test */
    public function it_gets_the_eighth_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(8, $data->eighth());
    }

    /** @test */
    public function it_gets_the_ninth_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(9, $data->ninth());
    }

    /** @test */
    public function it_gets_the_tenth_item_of_the_collection()
    {
        $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $this->assertEquals(10, $data->tenth());
    }

    /** @test */
    public function it_returns_null_if_index_is_undefined()
    {
        $data = new Collection();

        $this->assertNull($data->first());
        $this->assertNull($data->second());
        $this->assertNull($data->third());
        $this->assertNull($data->fourth());
        $this->assertNull($data->fifth());
        $this->assertNull($data->sixth());
        $this->assertNull($data->seventh());
        $this->assertNull($data->eighth());
        $this->assertNull($data->ninth());
        $this->assertNull($data->tenth());
    }
}
