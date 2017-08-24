<?php

use Illuminate\Support\Collection;

/*
 * Execute a callable if the collection isn't empty, then return the collection.
 *
 * @param callable callback

 * @return \Illuminate\Support\Collection
 */
Collection::macro('glob', function (string $pattern, int $flags = 0) {
    return Collection::make(glob($pattern, $flags));
});
