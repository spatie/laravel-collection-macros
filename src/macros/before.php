<?php

use Illuminate\Support\Collection;

/*
 * Get the previous item from the collection.
 *
 * @param mixed $currentItem
 * @param mixed $fallback
 *
 * @return mixed
 */
Collection::macro('before', function ($currentItem, $fallback = null) {
    return $this->reverse()->after($currentItem, $fallback);
});
