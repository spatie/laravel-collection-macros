<?php

namespace Spatie\CollectionMacros\Macros;

class After
{
    /**
     * Get the next item from the collection.
     *
     * @param mixed $currentItem
     * @param mixed $fallback
     *
     * @return mixed
     */
    public function after()
    {
        return function ($currentItem, $fallback = null) {
            $currentKey = $this->search($currentItem, true);

            if ($currentKey === false) {
                return $fallback;
            }

            $currentOffset = $this->keys()->search($currentKey, true);

            $next = $this->slice($currentOffset, 2);

            if ($next->count() < 2) {
                return $fallback;
            }

            return $next->last();
        };
    }
}
