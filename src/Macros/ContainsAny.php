<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Determine if any of the items exist in the collection their values.
 *
 * @param  array  $values
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

            $values = new Collection(array_unique($values));

            return $this->intersect($values)->count() > 0;
        };
    }
}
