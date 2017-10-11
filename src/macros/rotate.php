<?php

use Illuminate\Support\Collection;

/*
 * Rotate the items in the collection with given offset
 *
 * @param int $offset
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('rotate', function (int $offset): Collection {
    if ($this->isEmpty()) {
        return new static;
    }

    $count = $this->count();

    $offset %= $count;

    if ($offset < 0) {
        $offset += $count;
    }

    return new static($this->slice($offset)->merge($this->take($offset)));
});
