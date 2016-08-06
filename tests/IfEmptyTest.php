<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;
use Mockery;

class IfEmptyTest extends TestCase
{
    /** @test */
    public function it_executes_the_callable_if_the_collection_is_empty()
    {
        $mock = Mockery::mock();
        $mock->shouldReceive('someCall')->once();

        Collection::make()->ifEmpty(function () use ($mock) {
            $mock->someCall();
        });
    }

    /** @test */
    public function it_doesnt_execute_the_callable_if_the_collection_isnt_empty()
    {
        $mock = Mockery::mock();
        $mock->shouldNotReceive('someCall');

        Collection::make(['foo'])->ifEmpty(function () use ($mock) {
            $mock->someCall();
        });
    }

    /** @test */
    public function it_provides_a_fluent_interface()
    {
        $collection = Collection::make();

        $this->assertEquals($collection, $collection->ifEmpty(function () {}));
    }
}
