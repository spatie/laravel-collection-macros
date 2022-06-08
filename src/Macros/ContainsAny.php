<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Determine if any of the items exist in the collection their values.
 *
 * @param  mixed  $values
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class ContainsAny
{
    public function __invoke()
    {
        return function ($values): bool {
            $values = (new Collection($values))->unique();

            return $this->intersect($values)->count() > 0;
        };
    }
}
