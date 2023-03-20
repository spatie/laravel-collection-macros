<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Recursivly convert arrays and objects within a multi-dimensional array to Collections
 *
 * @param float $maxDepth
 * @param int $depth
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class Recursive
{
    public function __invoke()
    {
        return function (float $maxDepth = INF, int $depth = 0): Collection {
            return $this->map(function ($value) use ($depth, $maxDepth) {
                if ($depth > $maxDepth) {
                    return $value;
                }

                if (is_array($value) || is_object($value)) {
                    return collect($value)->recursive($maxDepth, $depth + 1);
                }

                return $value;
            });
        };
    }
}
