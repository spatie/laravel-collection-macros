<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;

class NoneTest extends TestCase
{
    /** @test */
    public function it_can_check_if_an_item_isnt_present_in_a_collection()
    {
        $this->assertTrue(Collection::make(['foo'])->none('bar'));
        $this->assertFalse(Collection::make(['foo'])->none('foo'));
    }

    /** @test */
    public function it_can_check_if_a_key_value_pair_isnt_present_in_a_collection()
    {
        $this->assertTrue(Collection::make([['name' => 'foo']])->none('name', 'bar'));
        $this->assertFalse(Collection::make([['name' => 'foo']])->none('name', 'foo'));
    }

    /** @test */
    public function it_can_check_if_something_isnt_present_in_a_collection_with_a_truth_test()
    {
        // Below Laravel 5.3, the callable's parameter order is `$key, $value`.

        if (version_compare('5.3.0', Application::VERSION, 'lt')) {
            $this->assertTrue(Collection::make(['name' => 'foo'])->none(function ($key, $value) {
                return $key === 'name' && $value === 'bar';
            }));

            $this->assertFalse(Collection::make(['name' => 'foo'])->none(function ($key, $value) {
                return $key === 'name' && $value === 'foo';
            }));

            return;
        }

        // Above Laravel 5.3, the callable's parameter order is `$value, $key`.

        $this->assertTrue(Collection::make(['name' => 'foo'])->none(function ($value, $key) {
            return $key === 'name' && $value === 'bar';
        }));

        $this->assertFalse(Collection::make(['name' => 'foo'])->none(function ($value, $key) {
            return $key === 'name' && $value === 'foo';
        }));
    }
}
