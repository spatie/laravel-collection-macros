<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Get a new collection from the collection by key.
 *
 * @param  mixed  $key
 * @param  mixed  $default
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return static
 */
class CollectBy
{
    public function __invoke()
    {
        return function ($key, $default = null): Collection {
            return new static(Arr::get($this->items, $key, $default));
        };
    }
}
