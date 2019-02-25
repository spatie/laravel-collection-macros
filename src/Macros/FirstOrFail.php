<?php

namespace Spatie\CollectionMacros\Macros;

use Spatie\CollectionMacros\Exceptions\CollectionItemNotFound;

class FirstOrFail
{
    /**
     * Get the first item. Throws CollectionItemNotFound if the item was not found.
     *
     * @return mixed
     */
    public function firstOrFail()
    {
        return function () {
            if (! is_null($item = $this->first())) {
                return $item;
            }

            throw new CollectionItemNotFound('No items found in collection.');
        };
    }
}
