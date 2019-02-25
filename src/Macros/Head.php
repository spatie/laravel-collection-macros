<?php

namespace Spatie\CollectionMacros\Macros;

class Head
{
    /**
     * Get the first item from the collection.
     *
     * @return mixed
     */
    public function head()
    {
        return function () {
            return $this->first();
        };
    }
}
