<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/*
 * Get a new collection from the collection by key.
 *
 * @param  mixed  $key
 * @param  mixed  $default
 *
 * @return static
 */
class Collect {
    public function __invoke() {
        return function ($key, $default = null): Collection {
            return new static($this->get($key, $default));
        };
    }
}
