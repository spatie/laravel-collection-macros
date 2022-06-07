<?php

namespace Spatie\CollectionMacros\Test\Macros;

use ArrayIterator;
use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;
use SplObjectStorage;

class NullifyTest extends TestCase
{
    /** @test */
    public function it_can_nullify_values_in_collection()
    {
        $result = Collection::make([
            'first_name'  => null,
            'last_name'   => '',
            'full_name'   => collect(),
            'nick_name'   => [],
            'countable'   => new SplObjectStorage,
            'correct_one' => 'Correct one!',
        ])->nullify()->toArray();

        $this->assertSame([
            'first_name'  => null,
            'last_name'   => null,
            'full_name'   => null,
            'nick_name'   => null,
            'countable'   => null,
            'correct_one' => 'Correct one!',
        ], $result);
    }

    /** @test */
    public function it_can_nullify_values_in_collection_with_nested_array_access()
    {
        $result = Collection::make([
            'test'       => new SplObjectStorage,
            'first_name' => collect(['first_part' => false, 'last_part' => '']),
            'last_name'  => collect(['first_part' => true, 'last_part' => []]),
            'full_name'  => collect(['first_part' => new SplObjectStorage, 'last_part' => collect(['additional_part' => ''])]),
        ])->nullify()->toArray();

        $this->assertSame([
            'test'       => null,
            'first_name' => ['first_part' => false, 'last_part' => null],
            'last_name'  => ['first_part' => true, 'last_part' => null],
            'full_name'  => ['first_part' => null, 'last_part' => ['additional_part' => null]],
        ], $result);
    }

    /** @test */
    public function it_can_nullify_values_in_collection_without_converting_to_array()
    {
        $nullified = Collection::make([
            'first_name' => ['first_part' => false, 'last_part'  => ''],
            'last_name'  => collect(['first_part' => false, 'last_part'  => []]),
            'full_name'  => ['first_part' => true, 'last_part'  => collect(['additional_part' => ''])],
        ])->nullify();

        $expected = Collection::make([
            'first_name' => ['first_part' => false, 'last_part'  => null],
            'last_name'  => collect(['first_part' => false, 'last_part'  => null]),
            'full_name'  => ['first_part' => true, 'last_part'  => collect(['additional_part' => null])],
        ]);

        $this->assertEquals($expected, $nullified);
    }

    /** @test */
    public function test_array_iterator_behaves_as_expected_when_nullify()
    {
        $nullified = Collection::make(['iterator' => new ArrayIterator([1, 2, 3])])->nullify();
        $expected  = Collection::make(['iterator' => new ArrayIterator([1, 2, 3])]);
        $this->assertEquals($expected, $nullified);

        $nullified = Collection::make(['iterator' => new ArrayIterator])->nullify();
        $expected  = Collection::make(['iterator' => null]);
        $this->assertEquals($expected, $nullified);
    }

    /** @test */
    public function test_generators_passes_through_nullify()
    {
        $nullified = Collection::make(['generator' => (fn () => yield 0)()])->nullify();
        $expected  = Collection::make(['generator' => (fn () => yield 0)()]);
        $this->assertEquals($expected, $nullified);
    }
}
