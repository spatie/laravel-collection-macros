<?php

namespace Spatie\CollectionMacros\MacroClasses;

class AfterMacro
{
    /**
     * Get the next item from the collection.
     *
     * @return \Closure
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
