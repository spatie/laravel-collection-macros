<?php

use Illuminate\Support\Collection;

/*
 * Separate a collection into chunks as long the given callback is met.
 *
 * @param callable $callback
 * @param bool $preserveKeys
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('chunkBy', function ($callback, bool $preserveKeys = false): Collection {
    return $this->sliceBefore(function ($item, $prevItem) use ($callback) {
        return $callback($item) !== $callback($prevItem);
    }, $preserveKeys);
});
