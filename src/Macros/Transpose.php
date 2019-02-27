<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/*
 * Transpose an array.
 *
 * @return \Illuminate\Support\Collection
 *
 * @throws \LengthException
 */
class Transpose
{
    public function __invoke() {
        return function (): Collection {
            if ($this->isEmpty()) {
                return new static();
            }

            $firstItem = $this->first();

            $expectedLength = is_array($firstItem) || $firstItem instanceof Countable ? count($firstItem) : 0;

            array_walk($this->items, function ($row) use ($expectedLength) {
                if ((is_array($row) || $row instanceof Countable) && count($row) !== $expectedLength) {
                    throw new \LengthException("Element's length must be equal.");
                }
            });

            $items = array_map(function (...$items) {
                return new static($items);
            }, ...array_map(function ($items) {
                return $this->getArrayableItems($items);
            }, array_values($this->items)));

            return new static($items);
        };
    }
}
