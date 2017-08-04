<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class IfEmptyTest extends TestCase
{
    /** @test */
    public function it_executes_the_callable_if_the_collection_is_empty()
    {
        Collection::make()->ifEmpty(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldHaveReceived('someCall')->once();

        $this->avoidTestMarkedAsRisky();
    }

    /** @test */
    public function it_pass_the_collection_in_the_callback()
    {
        $originCollection = Collection::make();

        $originCollection->ifEmpty(function (Collection $collection) use ($originCollection) {
            $this->assertEquals($originCollection, $collection);
        });
    }

    /** @test */
    public function it_doesnt_execute_the_callable_if_the_collection_isnt_empty()
    {
        Collection::make(['foo'])->ifEmpty(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldNotHaveReceived('someCall');

        $this->avoidTestMarkedAsRisky();
    }

    /** @test */
    public function it_provides_a_fluent_interface()
    {
        $collection = Collection::make();

        $this->assertEquals($collection, $collection->ifEmpty(function () {
        }));
    }
}
