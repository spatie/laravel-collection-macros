<?php

namespace Spatie\CollectionMacros\Macros;

class PluckToArray
{
    /**
     * Get the array of values of a given key.
     *
     * @param  string|array  $value
     * @param  string|null  $key
     *
     * @return array
     */
    public function pluckToArray()
    {
        return function ($value, $key = null): array {
            return $this->pluck($value, $key)->toArray();
        };
    }
}
