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
    if ($this->isEmpty()) {
        return new static();
    }

    $expectedLength = count($this->first());

    array_walk($this->items, function ($row) use ($expectedLength) {
        if (count($row) !== $expectedLength) {
            throw new \LengthException("Element's length must be equal.");
        }
    });

    $items = array_map(function (...$items) {
        return new static($items);
    }, ...$this->values());

    return new static($items);
});
