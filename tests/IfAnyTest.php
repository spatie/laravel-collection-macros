<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;
use Mockery;

class IfAnyTest extends TestCase
{
    /** @test */
    function it_executes_the_callable_if_the_collection_isnt_empty()
    {
        $mock = Mockery::mock();
        $mock->shouldReceive('someCall')->once();

        Collection::make(['foo'])->ifAny(function () use ($mock) {
            $mock->someCall();
        });
    }

    /** @test */
    function it_doesnt_execute_the_callable_if_the_collection_is_empty()
    {
        $mock = Mockery::mock();
        $mock->shouldNotReceive('someCall');

        Collection::make()->ifAny(function () use ($mock) {
            $mock->someCall();
        });
    }

    /** @test */
    function it_provides_a_fluent_interface()
    {
        $collection = Collection::make();

        $this->assertEquals($collection, $collection->ifAny(function () {}));
    }
}
