<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Convert an array and its children to collection using recursion.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class Recursive
{
    public function __invoke()
    {
        return function () {
            return $this->map(
                static function ($value) {
                    if (is_array($value) || is_object($value)) {
                        return collect($value)->recursive();
                    }

                    return $value;
                }
            );
        };
    }
}
