<?php

use Illuminate\Support\Collection;

/*
 * Create a new collection with the specified amount of items
 *
 * @param int $size
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('withSize', function (int $size): Collection {
    if ($size < 1) {
        return new Collection();
    }

    return new Collection(range(1, $size));
});
