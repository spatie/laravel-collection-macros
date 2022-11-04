<?php

use Illuminate\Support\Collection;

beforeEach(fn () => $this->spy = Mockery::spy());

afterEach(function () {
    if ($container = Mockery::getContainer()) {
        $this->addToAssertionCount($container->mockery_getExpectationCount());
    }

    Mockery::close();
});

it('executes the callable if the collection is empty', function () {
    Collection::make()->ifEmpty(function () {
        $this->spy->someCall();
    });

    $this->spy->shouldHaveReceived('someCall')->once();
});

it('passes the collection in the callback', function () {
    $originCollection = Collection::make();

    $originCollection->ifEmpty(
        fn (Collection $collection) => expect($collection)->toEqual($originCollection)
    );
});

it("doesn't execute the callable if the collection isn't empty", function () {
    Collection::make(['foo'])->ifEmpty(function () {
        $this->spy->someCall();
    });

    $this->spy->shouldNotHaveReceived('someCall');
});

it('provides a fluent interface', function () {
    $collection = Collection::make();

    expect(
        $collection->ifEmpty(function () {
        })
    )->toEqual($collection);
});
