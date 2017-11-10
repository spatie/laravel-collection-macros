<?php

use Illuminate\Support\Collection;

/*
 * Get the first item. Throws Exception when collection is empty.
 *
 * @return mixed
 */
Collection::macro('firstOrFail', function () {
    if (! is_null($item = $this->first())) {
        return $item;
    }

    throw new \Exception('No items found in collection.');
});
