<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class Collect
{
    /**
     * Get a new collection from the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $default
     *
     * @return static
     */
    public function collect()
    {
        return function ($key, $default = null): Collection {
            return new static($this->get($key, $default));
        };
    }
}
