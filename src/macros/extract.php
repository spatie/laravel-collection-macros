<?php

use Illuminate\Support\Collection;

/*
 * Extract keys from a collection, like `only`, except:
 * - If a value doesn't exist, it returns null instead of omitting it
 * - It returns a collection without keys, so `list()` can be used.
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('extract', function ($keys): Collection {
    $keys = is_array($keys) ? $keys : func_get_args();

    return array_reduce($keys, function ($extracted, $key) {
        return $extracted->push(
            data_get($this->items, $key)
        );
    }, new static());
});
