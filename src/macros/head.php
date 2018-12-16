<?php

use Illuminate\Support\Collection;

/*
 * Get the first item from the collection.
 *
 * @return mixed
 */
Collection::macro('head', function () {
    return $this->first();
});
