<?php

namespace Spatie\CollectionMacros\Macros;

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
class GetNth
{
    public function __invoke()
    {
        return function (int $nth) {
            return $this->slice($nth - 1, 1)->first();
        };
    }
}
