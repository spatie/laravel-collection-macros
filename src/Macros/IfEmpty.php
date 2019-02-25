<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class IfEmpty
{
    /**
     * Execute a callable if the collection is empty, then return the collection.
     *
     * @param callable $callback
     *
     * @return \Illuminate\Support\Collection
     */
    public function ifEmpty()
    {
        return function (callable $callback): Collection {
            if ($this->isEmpty()) {
                $callback($this);
            }

            return $this;
        };
    }
}
