<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Map a collection, then filter the results.
 *
 * @param callable $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class FilterMap
{
    public function __invoke()
    {
        return function (callable $callback): Collection {
            return $this->map($callback)->filter();
        };
    }
}
