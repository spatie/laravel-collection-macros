<?php


use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Exceptions\CollectionItemNotFound;

it('returns first item when there is one', function () {
    if (method_exists(Collection::class, 'firstOrFail')) {
        $this->expectNotToPerformAssertions();

        return;
    }

    $result = Collection::make([1, 2, 3, 4])->firstOrFail();

    expect($result)->toEqual(1);
});

it('throws exception when there are no items', function () {
    if (method_exists(Collection::class, 'firstOrFail')) {
        $this->expectNotToPerformAssertions();

        return;
    }

    $this->expectException(CollectionItemNotFound::class);

    Collection::make()->firstOrFail();
});
