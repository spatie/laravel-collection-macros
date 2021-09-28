<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Inserts an item at a given index and returns the updated Collection instance.
 *
 * @param  int   $index
 * @param  mixed $item
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return Collection
 */
class InsertAt
{
    public function __invoke()
    {
        return function (int $index, $item): Collection {
            $after = $this->splice($index);
            $this->items = $this->push($item)->merge($after)->toArray();
            return $this;
        };
    }
}
