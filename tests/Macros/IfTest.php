<?php


use Illuminate\Support\Collection;
use Illuminate\Support\Str;

it('will return the right branch', function () {
    expect(collect()->if(true, then: true, else: false))->toBeTrue();
    expect(collect()->if(false, then: true, else: false))->toBeFalse();
});

it('will pass the collection to the branches', function (string $sentence, string $modifiedSentence) {
    $collection = collect([$sentence])
        ->if(
            fn (Collection $collection) => $collection->contains('this is the value'),
            then: fn (Collection $collection) => $collection->map(fn (string $item) => strtoupper($item)),
            else: fn (Collection $collection) => $collection->map(fn (string $item) => Str::kebab($item))
        );

    expect($collection[0])->toEqual($modifiedSentence);
})->with([
    ['this is the value', 'THIS IS THE VALUE'],
    ['this is another value', 'this-is-another-value'],
]);

test('the branches are optional', function () {
    $result = collect(['this is a value'])
        ->if(
            false,
            then: fn (Collection $collection) => 'something',
        );

    expect($result)->toBeNull();
});
