<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Inserts an item after another item by key.
 *
 * @param  mixed $afterKey
 * @param  mixed $item
 * @param  mixed $key
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return Collection
 */
class InsertAfterKey
{
    public function __invoke()
    {
        return function ($afterKey, $item, $key = null): Collection {
            $index = array_search($afterKey, array_keys($this->items));

            return $this->insertAt($index + 1, $item, $key);
        };
    }
}
