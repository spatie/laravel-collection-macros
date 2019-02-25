<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class IfAny
{
    /**
     * Execute a callable if the collection isn't empty, then return the collection.
     *
     * @param callable callback
     *
     * @return \Illuminate\Support\Collection
     */
    public function ifAny()
    {
        return function (callable $callback): Collection {
            if (! $this->isEmpty()) {
                $callback($this);
            }

            return $this;
        };
    }
}
