<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Determine if none of the items exist in the collection their values.
 *
 * @param  array  $values
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class ContainsAnyNone
{
    public function __invoke()
    {
        return function ($values): bool {

            return ! $this->containsAny($values);
        };
    }
}
