<?php

use Illuminate\Support\Collection;

/*
 * Group a collection by an Eloquent model.
 *
 * @param string|callable $callback
 * @param mixed $modelKey
 * @param mixed $itemsKey
 * @param bool $preserveKeys
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('groupByModel', function ($callback, $modelKey = 0, $itemsKey = 1, bool $preserveKeys = false): Collection {
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
