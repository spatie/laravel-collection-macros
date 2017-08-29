<?php

use Illuminate\Support\Collection;

/*
 * Transform a collection into an an array with pairs.
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('toPairs', function (): Collection {
    return $this->keys()->map(function ($key) {
        return [$key, $this->items[$key]];
    });
});
