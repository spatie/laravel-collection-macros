<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Inserts an item before another item by key.
 *
 * @param  mixed $beforeKey
 * @param  mixed $item
 * @param  mixed $key
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return Collection
 */
class InsertBeforeKey
{
    public function __invoke()
    {
        return function ($beforeKey, $item, $key = null): Collection {
            $index = array_search($beforeKey, array_keys($this->items));

            return $this->insertAt($index, $item, $key);
        };
    }
}
