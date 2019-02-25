<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class Prioritize
{
    /**
     * Move elements to the start of the collection.
     *
     * @param  callable  $callable
     *
     * @return \Illuminate\Support\Collection
     */
    public function prioritize()
    {
        return function (callable $callable): Collection {
            $nonPrioritized = $this->reject($callable);

            return $this->filter($callable)->concat($nonPrioritized);
        };
    }
}
