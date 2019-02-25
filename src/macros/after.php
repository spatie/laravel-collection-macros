<?php

use Illuminate\Support\Collection;

/*
 * Get the next item from the collection.
 *
 * @param mixed $currentItem
 * @param mixed $fallback
 *
 * @return mixed
 */
Collection::macro('after', function ($currentItem, $fallback = null) {
    $flat = $this->flatten();
    $currentKey = $flat->search($currentItem);

    if ($currentKey === false || $currentKey == ($flat->count() - 1)) {
        return $fallback;
    }

    return $flat[$currentKey + 1];
});
