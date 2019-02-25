<?php

namespace Spatie\CollectionMacros\MacroClasses;

class AtMacro
{
    /**
     * Get a single item from the collection by index.
     *
     * @return \Closure
     */
    public function at()
    {
        return function ($index) {
            return $this->slice($index, 1)->first();
        };
    }
}
