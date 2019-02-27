<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/*
 * Move elements to the start of the collection.
 *
 * @param  callable  $callable
 *
 * @return \Illuminate\Support\Collection
 */
class Prioritize {
    public function __invoke() {
        return function (callable $callable): Collection {
            $nonPrioritized = $this->reject($callable);

            return $this
                ->filter($callable)
                ->concat($nonPrioritized);
        };
    }
}
