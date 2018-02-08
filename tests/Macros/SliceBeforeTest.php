<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class SliceBeforeTest extends TestCase
{
    /** @test */
    public function it_provides_slice_before_macro()
    {
        $this->assertTrue(Collection::hasMacro('sliceBefore'));
    }

    /** @test */
    public function it_can_slice_before_the_collection_with_a_given_callback()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        });

        $expected = [
            [10, 34],
            [51, 17, 47],
            [64, 9, 44, 20],
            [59],
            [66],
            [77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function it_can_slice_before_the_collection_with_a_given_callback_with_preserving_the_original_keys()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        }, true);

        $expected = [
            [0 => 10, 1 => 34],
            [2 => 51, 3 => 17, 4 => 47],
            [5 => 64, 6 => 9, 7 => 44, 8 => 20],
            [9 => 59],
            [10 => 66],
            [11 => 77],
        ];

        $toArray = $sliced->toArray();
        $this->assertEquals($expected, $toArray);
    }

    /** @test */
    public function it_can_slice_before_the_collection_with_complex_data_with_a_given_callback_without_preserving_the_original_keys()
    {
        $collection = new Collection([10, [34, 51], [17], 47, [64, 9], 44, [20], [59], [66], 77]);

        $sliced = $collection->sliceBefore(function ($item) {
            return is_array($item);
        });

        $expected = [
            [10],
            [[34, 51]],
            [[17], 47],
            [[64, 9], 44],
            [[20]],
            [[59]],
            [[66], 77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function it_can_slice_before_the_collection_with_complex_data_with_a_given_callback_with_preserving_the_original_keys()
    {
        $collection = new Collection([10, [34, 51], [17], 47, [64, 9], 44, [20], [59], [66], 77]);

        $sliced = $collection->sliceBefore(function ($item) {
            return is_array($item);
        }, true);

        $expected = [
            [0 => 10],
            [1 => [34, 51]],
            [2 => [17], 3 => 47],
            [4 => [64, 9], 5 => 44],
            [6 => [20]],
            [7 => [59]],
            [8 => [66], 9 => 77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function it_can_slice_before_the_collection_with_a_given_callback_without_preserving_the_original_associative_keys()
    {
        $collection = new Collection(['a' => 10, 'b' => 34, 'c' => 51, 'd' => 17, 'e' => 47, 'f' => 64, 'g' => 9, 'h' => 44, 'i' => 20, 'j' => 59, 'k' => 66, 'l' => 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        });

        $expected = [
            [10, 34],
            [51, 17, 47],
            [64, 9, 44, 20],
            [59],
            [66],
            [77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function it_can_slice_before_the_collection_with_a_given_callback_with_preserving_the_original_associative_keys()
    {
        $collection = new Collection(['a' => 10, 'b' => 34, 'c' => 51, 'd' => 17, 'e' => 47, 'f' => 64, 'g' => 9, 'h' => 44, 'i' => 20, 'j' => 59, 'k' => 66, 'l' => 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        }, true);

        $expected = [
            ['a' => 10, 'b' => 34],
            ['c' => 51, 'd' => 17, 'e' => 47],
            ['f' => 64, 'g' => 9, 'h' => 44, 'i' => 20],
            ['j' => 59],
            ['k' => 66],
            ['l' => 77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }
}
