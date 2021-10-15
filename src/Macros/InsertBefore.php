<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Inserts an item before another item.
 *
 * @param  mixed $before
 * @param  mixed $item
 * @param  mixed $key
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return Collection
 */
class InsertBefore
{
    public function __invoke()
    {
        return function ($before, $item, $key = null): Collection {
            $beforeKey = array_search($before, $this->items);

            return $this->insertBeforeKey($beforeKey, $item, $key);
        };
    }
}
