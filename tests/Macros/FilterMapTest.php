<?php

use Illuminate\Support\Collection;

it('returns a mapped collection without empty values', function () {
    $result = Collection::make([1, 2, 3, 4, 5, 6])->filterMap(function ($number) {
        $quotient = $number / 3;

        return is_int($quotient) ? $quotient : null;
    });

    expect($result->values()->toArray())->toEqual([1, 2]);
});
