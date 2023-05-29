<?php

namespace Spatie\CollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Recursively convert arrays and objects within a multi-dimensional array to Collections
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
            $transformValue = function (
                mixed $value,
                mixed $key,
                float $maxDepth = INF,
                int $depth = 0,
                ?Closure $shouldExit = null,
            ): mixed {
                if ($depth > $maxDepth) {
                    return $value;
                }

                if ($value instanceof Closure) {
                    return $value;
                }

                if (! (is_array($value) || is_object($value))) {
                    return $value;
                }

                if ($shouldExit && $shouldExit($value, $key, $depth, $maxDepth)) {
                    return $value;
                }

                return (new static($value))->recursive($maxDepth, $depth + 1, $shouldExit);
            };

            return $this->transform(function ($value, $key) use ($depth, $maxDepth, $shouldExit, $transformValue) {
                $value = $transformValue($value, $key, $maxDepth, $depth, $shouldExit);

                if (is_string($key)) {
                    $this->{$key} = $value;
                }

                return $value;
            });
        };
    }
}
