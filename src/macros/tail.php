<?php

use Illuminate\Support\Collection;

/*
 * Get the tail of a collection, everything except the first item.
 *
 * @param bool $preserveKeys
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('tail', function (bool $preserveKeys = false): Collection {
    return ! $preserveKeys ? $this->slice(1)->values() : $this->slice(1);
});
