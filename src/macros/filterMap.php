<?php

use Illuminate\Support\Collection;

/*
 * Map a collection, then filter the results.
 *
 * @param callable $callback
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('filterMap', function (callable $callback): Collection {
    return $this->map($callback)->filter();
});
