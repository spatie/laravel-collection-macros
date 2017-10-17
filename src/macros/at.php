<?php

use Illuminate\Support\Collection;

/*
 * Get a single item from the collection by index.
 *
 * @param mixed $index
 *
 * @return mixed
 */
Collection::macro('at', function ($index) {
    return $this->slice($index, 1)->first();
});
