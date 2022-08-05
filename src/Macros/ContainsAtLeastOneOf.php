<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Returns true if the collection contains one of the given $otherValues
 *
 * @param  array|Collection  $otherValues
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class ContainsAtLeastOneOf
{
    public function __invoke()
    {
        return function ($otherValues = []): bool {
            $intersectingItems = array_intersect($this->items, $otherValues);

            return count($intersectingItems) > 0;
        };
    }
}
