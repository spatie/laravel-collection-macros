<?php

use Illuminate\Support\Collection;

/*
 * Move elements to the start of the collection.
 *
 * @param  callable  $callable
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('prioritize', function (callable $callable): Collection {
    $nonPrioritized = $this->reject($callable);

    return $this
        ->filter($callable)
        ->concat($nonPrioritized);
});
