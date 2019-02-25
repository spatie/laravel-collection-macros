<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class FilterMap
{
    /**
     * Map a collection, then filter the results.
     *
     * @param callable $callback
     *
     * @return \Illuminate\Support\Collection
     */
    public function filterMap()
    {
        return function (callable $callback): Collection {
            return $this->map($callback)->filter();
        };
    }
}
