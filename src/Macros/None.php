<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Check whether a collection doesn't contain any occurrences of a given
 * item, key-value pair, or passing truth test. `none` accepts the same
 * parameters as the `contains` collection method.
 *
 * @see \Illuminate\Support\Collection::contains
 *
 * @param mixed $key
 * @param mixed $value
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class None
{
    public function __invoke()
    {
        return function ($key, $value = null): bool {
            if (func_num_args() === 2) {
                return ! $this->contains($key, $value);
            }

            return ! $this->contains($key);
        };
    }
}
