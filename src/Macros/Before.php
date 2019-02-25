<?php

namespace Spatie\CollectionMacros\Macros;

class Before
{
    /**
     * Get the previous item from the collection.
     *
     * @param mixed $currentItem
     * @param mixed $fallback
     *
     * @return mixed
     */
    public function before()
    {
        return function ($currentItem, $fallback = null) {
            return $this->reverse()->after($currentItem, $fallback);
        };
    }
}
