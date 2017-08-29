<?php

use Illuminate\Support\Collection;

/*
 * Group a collection by an Eloquent model.
 *
 * @param string|callable $callback
 * @param bool $preserveKeys
 * @param mixed $modelKey
 * @param mixed $itemsKey
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('groupByModel', function ($callback, bool $preserveKeys = false, $modelKey = 0, $itemsKey = 1): Collection {
    $callback = $this->valueRetriever($callback);

    return $this->groupBy(function ($item) use ($callback) {
        return $callback($item)->getKey();
    }, $preserveKeys)->map(function (Collection $items) use ($callback, $modelKey, $itemsKey) {
        return [
            $modelKey => $callback($items->first()),
            $itemsKey => $items,
        ];
    })->values();
});
