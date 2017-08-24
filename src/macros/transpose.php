<?php

use Illuminate\Support\Collection;

/*
 * Transpose an array.
 *
 * @return \Illuminate\Support\Collection
 *
 * @throws \LengthException
 */
Collection::macro('transpose', function (): Collection {
    $values = $this->values();

    $expectedLength = count($this->first());
    $diffLength = count(array_intersect_key(...$values));

    if ($expectedLength !== $diffLength) {
        throw new LengthException("Element's length must be equal.");
    }

    $items = array_map(function (...$items) {
        return new static($items);
    }, ...$values);

    return new static($items);
});
