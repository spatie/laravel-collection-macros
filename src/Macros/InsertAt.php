<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Inserts an item at a given index with an optional key.
 *
 * @param  int   $index
 * @param  mixed $item
 * @param  mixed $key
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return Collection
 */
class InsertAt
{
    public function __invoke()
    {
        $insertWithKey = function (Collection $collection, int $index, mixed $item, mixed $key) {
            $after = $collection->splice($index);
            return $collection->put($key, $item)->merge($after);
        };

        $insertWithoutKey = function (Collection $collection, int $index, mixed $item) {
            $after = $collection->splice($index);
            return $collection->push($item)->merge($after);
        };

        return function (int $index, mixed $item, mixed $key = null)
            use ($insertWithKey, $insertWithoutKey): Collection {
                $this->items = isset($key)
                    ? $insertWithKey($this, $index, $item, $key)->toArray()
                    : $insertWithoutKey($this, $index, $item)->toArray();
                return $this;
        };
    }
}
