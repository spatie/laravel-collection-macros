<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class FromPairs
{
    /**
     * Transform a collection into an associative array form collection item.
     *
     * @return \Illuminate\Support\Collection
     */
    public function fromPairs()
    {
        return function (): Collection {
            return $this->reduce(function ($assoc, array $keyValuePair): Collection {
                list($key, $value) = $keyValuePair;
                $assoc[$key] = $value;

                return $assoc;
            }, new static);
        };
    }
}
