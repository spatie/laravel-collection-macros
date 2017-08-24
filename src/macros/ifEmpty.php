<?php

use Illuminate\Support\Collection;

/*
 * Execute a callable if the collection is empty, then return the collection.
 *
 * @param callable $callback
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('ifEmpty', function (callable $callback): Collection {
    if ($this->isEmpty()) {
        $callback($this);
    }

    return $this;
});
