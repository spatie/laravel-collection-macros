<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class ToPairs
{
    /**
     * Transform a collection into an an array with pairs.
     *
     * @return \Illuminate\Support\Collection
     */
    public function toPairs()
    {
        return function (): Collection {
            return $this->keys()->map(function ($key) {
                return [$key, $this->items[$key]];
            });
        };
    }
}
