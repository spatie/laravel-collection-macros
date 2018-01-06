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

    $firstItem = $this->first();

    if (! $firstItem instanceof Countable) {
        return new static();
    }

    $expectedLength = count($firstItem);

    array_walk($this->items, function ($row) use ($expectedLength) {
        if (count($row) !== $expectedLength) {
            throw new \LengthException("Element's length must be equal.");
        }
    });

    $items = array_map(function (...$items) {
        return new static($items);
    }, ...array_map(function ($items) {
        return $this->getArrayableItems($items);
    }, array_values($this->items)));

    return new static($items);
});
