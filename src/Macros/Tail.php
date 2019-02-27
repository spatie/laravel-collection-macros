<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Get the tail of a collection, everything except the first item.
 *
 * @param bool $preserveKeys
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class Tail
{
    public function __invoke()
    {
        return function (bool $preserveKeys = false): Collection {
            return ! $preserveKeys ? $this->slice(1)->values() : $this->slice(1);
        };
    }
}
