<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class FirstOrPushTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_a_value_if_one_exists()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(1, $data->firstOrPush(fn($item) => $item === 1, 2));
    }

    /** @test */
    public function if_a_value_doesnt_exist_the_second_argument_is_pushed_in_to_the_collection_and_returned()
    {
        $data = new Collection([1, 2]);

        $this->assertEquals(3, $data->firstOrPush(fn($item) => $item === 3, 3));
        $this->assertEquals(3, $data->firstOrPush(fn($item) => $item === 3, 4));
    }

    /** @test */
    public function the_value_parameter_can_be_a_callable()
    {
        $this->assertEquals(1, (new Collection())->firstOrPush(fn($item) => false, fn() => 1));
    }

    /** @test */
    public function a_collection_object_can_be_specified_as_the_push_target()
    {
        $data = new Collection([1, 2, 3]);
        $data->filter(fn($item) => false)->firstOrPush(fn($item) => false, 4, $data);

        $this->assertEquals(new Collection([1, 2, 3, 4]), $data);
    }
}
