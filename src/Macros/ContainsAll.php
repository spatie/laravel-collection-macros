<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Returns true if the collection contains all of the given $otherValues
 *
 * @param  array|Collection  $otherValues
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class ContainsAll
{
    public function __invoke()
    {
        return function ($values = []): bool {
            $values = (new Collection($values))->unique();

            return $this->intersect($values)->count() == $values->count();
        };
    }
}
