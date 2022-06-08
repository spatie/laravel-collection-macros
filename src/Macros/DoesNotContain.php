<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Determine if none of the items exist in the collection their values.
 *
 * @param  mixed  $values
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class DoesNotContain
{
    public function __invoke()
    {
        return function ($values): bool {
            return ! $this->containsAny(...func_get_args());
        };
    }
}
