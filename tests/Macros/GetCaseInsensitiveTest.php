<?php

it(
    'can get the value of a case-insensitive key',
    function (string $key, string|null $expectedResult) {
        $collection = collect([
            'foo' => 'bar',
        ]);

        expect($collection->getCaseInsensitive($key))->toBe($expectedResult);
    }
)->with([
    ['foo', 'bar'],
    ['FOO', 'bar'],
    ['Foo', 'bar'],
    ['foO', 'bar'],
    ['bar', null],
]);
