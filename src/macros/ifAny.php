<?php

use Illuminate\Support\Collection;

/*
 * Execute a callable if the collection isn't empty, then return the collection.
 *
 * @param callable callback
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('ifAny', function (callable $callback): Collection {
    if (! $this->isEmpty()) {
        $callback($this);
    }

    return $this;
});
