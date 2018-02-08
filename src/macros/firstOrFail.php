<?php

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Exceptions\CollectionItemNotFound;

/*
 * Get the first item. Throws CollectionItemNotFound if the item was not found.
 *
 * @return mixed
 */
Collection::macro('firstOrFail', function () {
    if (! is_null($item = $this->first())) {
        return collect($item);
    }

    throw new CollectionItemNotFound('No items found in collection.');
});
