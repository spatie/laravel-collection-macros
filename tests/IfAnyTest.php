<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class IfAnyTest extends TestCase
{
    /** @test */
    public function it_executes_the_callable_if_the_collection_isnt_empty()
    {
        Collection::make(['foo'])->ifAny(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldHaveReceived('someCall')->once();
    }

    /** @test */
    public function it_doesnt_execute_the_callable_if_the_collection_is_empty()
    {
        Collection::make()->ifAny(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldNotHaveReceived('someCall');
    }

    /** @test */
    public function it_provides_a_fluent_interface()
    {
        $collection = Collection::make();

        $this->assertEquals($collection, $collection->ifAny(function () {}));
    }
}
