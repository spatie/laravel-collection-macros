<?php

use Illuminate\Support\Collection;

/*
 * Map a collection, then filter the results.
 *
 * @param callable $mapper
 * @param callable $filter
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('filterMap', function ($mapper, $filter = null): Collection {
    return $this->map($mapper)->filter($filter);
});
