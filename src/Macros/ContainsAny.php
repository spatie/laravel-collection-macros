<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Returns true if the collection contains one of the given $values
 *
 * @param  array|Collection  $values
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class ContainsAny
{
    public function __invoke()
    {
        return function ($values = []): bool {
            $values = (new Collection($values))->unique();

            return $this->intersect($values)->count() > 0;
        };
    }
}
