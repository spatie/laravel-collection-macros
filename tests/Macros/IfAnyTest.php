<?php


use Illuminate\Support\Collection;

beforeEach(function () {
    $this->spy = Mockery::spy();
});

afterEach(function () {
    if ($container = Mockery::getContainer()) {
        $this->addToAssertionCount($container->mockery_getExpectationCount());
    }

    Mockery::close();
});

it('executes the callable if the collection isnt empty', function () {
    Collection::make(['foo'])->ifAny(function () {
        $this->spy->someCall();
    });

    $this->spy->shouldHaveReceived('someCall')->once();
});

it('pass the collection in the callback', function () {
    $originCollection = Collection::make(['foo']);

    $originCollection->ifAny(function (Collection $collection) use ($originCollection) {
        expect($collection)->toEqual($originCollection);
    });
});

it('doesnt execute the callable if the collection is empty', function () {
    Collection::make()->ifAny(function () {
        $this->spy->someCall();
    });

    $this->spy->shouldNotHaveReceived('someCall');
});

it('provides a fluent interface', function () {
    $collection = Collection::make();

    expect($collection->ifAny(function () {
    }))->toEqual($collection);
});
