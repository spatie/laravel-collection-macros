<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Mockery;
use Spatie\CollectionMacros\Test\TestCase;

class IfEmptyTest extends TestCase
{
    /** @var \Mockery\MockInterface spy */
    private $spy;

    public function setup(): void
    {
        parent::setUp();

        $this->spy = Mockery::spy();
    }

    public function tearDown(): void
    {
        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        Mockery::close();
    }

    /** @test */
    public function it_executes_the_callable_if_the_collection_is_empty()
    {
        Collection::make()->ifEmpty(function () {
            $this->spy->someCall();
        });

        $this->spy->shouldHaveReceived('someCall')->once();
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
    }

    /** @test */
    public function it_provides_a_fluent_interface()
    {
        $collection = Collection::make();

        $this->assertEquals($collection, $collection->ifEmpty(function () {
        }));
    }
}
