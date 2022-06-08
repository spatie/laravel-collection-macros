<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Determine if all items exist in the collection their values.
 *
 * @param  mixed  $values
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class ContainsAll
{
    public function __invoke()
    {
        return function ($values): bool {
            $values = (new Collection($values))->unique();

            return $this->intersect($values)->count() == $values->count();
        };
    }
}
