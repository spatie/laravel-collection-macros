<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Group a collection by an Eloquent model.
 *
 * @param string|callable $callback
 * @param bool $preserveKeys
 * @param mixed $modelKey
 * @param mixed $itemsKey
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class GroupByModel
{
    public function __invoke()
    {
        return function ($callback, bool $preserveKeys = false, $modelKey = 0, $itemsKey = 1): Collection {
            $callback = $this->valueRetriever($callback);

            return $this->groupBy(function ($item) use ($callback) {
                return $callback($item)->getKey();
            }, $preserveKeys)->map(function (Collection $items) use ($callback, $modelKey, $itemsKey) {
                return [
                    $modelKey => $callback($items->first()),
                    $itemsKey => $items,
                ];
            })->values();
        };
    }
}
