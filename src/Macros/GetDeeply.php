<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Arr;

/***
 * Get the previous item from the collection.
 *
 * @param int $nth
 * @param mixed $fallback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class GetDeeply
{
    public function __invoke()
    {
        return function ($key, $default = null) {
            return Arr::get($this->items, $key, $default);
        };
    }
}
