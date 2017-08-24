<?php

use Illuminate\Support\Collection;

/*
 * Get the tail of a collection, so everything except the first item
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('tail', function () {
    return $this->slice(1)->values();
});
