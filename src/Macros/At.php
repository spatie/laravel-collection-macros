<?php

namespace Spatie\CollectionMacros\Macros;

class At
{
    /**
     * Get a single item from the collection by index.
     *
     * @param mixed $index
     *
     * @return mixed
     */
    public function at()
    {
        return function ($index) {
            return $this->slice($index, 1)->first();
        };
    }
}
