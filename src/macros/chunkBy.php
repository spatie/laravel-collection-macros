<?php

use Illuminate\Support\Collection;

/*
 * Separate a collection into chunks as long the given callback is met
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('chunkBy', function ($callback) {
    return $this->sliceBefore(function ($item, $prevItem) use ($callback) {
        return $callback($item) !== $callback($prevItem);
    });
});
