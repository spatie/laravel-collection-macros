<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Determines if a given key exists in the Collection and its value is not null.
 * (Uses the `has` and `get` collection methods.)
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class HasNotNull
{
    public function __invoke()
    {
        return function ($key): bool {
            return $this->has($key) && $this->get($key) != null;
        };
    }
}
