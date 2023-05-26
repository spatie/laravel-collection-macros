<?php

namespace Spatie\CollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Recursivly convert arrays and objects within a multi-dimensional array to Collections
 *
 * @param float $maxDepth
 * @param int $depth
 * @param ?Closure $shouldExit
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class Recursive
{
    public function __invoke()
    {
        return function (
            float $maxDepth = INF,
            int $depth = 0,
            ?Closure $shouldExit = null,
        ): Collection {
            return $this->transform(function ($value, $key) use ($depth, $maxDepth, $shouldExit) {
                if (
                    ! ($depth > $maxDepth)
                    && ! ($value instanceof Closure)
                    && (is_array($value) || is_object($value))
                    && ! ($shouldExit && $shouldExit($value, $key, $depth, $maxDepth))
                ) {
                    $value = (new static($value))->recursive($maxDepth, $depth + 1, $shouldExit);
                }

                if (is_string($key)) {
                    $this->{$key} = $value;
                }

                return $value;
            });
        };
    }
}
