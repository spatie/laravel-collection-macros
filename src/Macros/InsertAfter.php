<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Inserts an item after another item.
 *
 * @param  mixed $after
 * @param  mixed $item
 * @param  mixed $key
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return Collection
 */
class InsertAfter
{
    public function __invoke()
    {
        return function ($after, $item, $key = null): Collection {
            $afterKey = array_search($after, $this->items);

            return $this->insertAfterKey($afterKey, $item, $key);
        };
    }
}
