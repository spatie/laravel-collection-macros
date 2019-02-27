<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Get the first item from the collection.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Head
{
    public function __invoke()
    {
        return function () {
            return $this->first();
        };
    }
}
