<?php

it(
    'can determine that a collection has a key in a case insensitive way',
    function (string $key, bool $expectedResult) {
        $collection = collect([
            'foo' => 'bar',
        ]);

        expect($collection->hasCaseInsensitive($key))->toBe($expectedResult);
    }
)->with([
    ['foo', true],
    ['FOO', true],
    ['Foo', true],
    ['foO', true],
    ['bar', false],
]);
