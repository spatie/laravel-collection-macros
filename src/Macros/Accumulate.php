<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Accumulate values through the collection.
 *
 * @param callable|string|null $callback
 * @param mixed $initial
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Accumulate
{
    public function __invoke()
    {
        return function ($callback = null, $initial = null) {
            if (is_null($callback)) {
                $callback = function ($value) {
                    return $value;
                };
            } else {
                $callback = $this->valueRetriever($callback);
            }

            $tally = $initial;

            return $this->map(function ($item) use (&$tally, $callback) {;
                return $tally += $callback($item);
            });
        };
    }
}
