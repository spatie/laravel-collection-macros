<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Get a Collection with only the specified keys.
 *
 * @param  array  $keys
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return Collection
 */
class PluckManyValues
{
    public function __invoke()
    {
        return function ($keys): Collection {
            // Allow passing multiple keys as multiple arguments
            $keys = is_array($keys) ? $keys : func_get_args();

            return $this->pluckMany($keys)->map(function ($item) {
                if ($item instanceof Collection) {
                    return $item->values();
                }

                if (is_array($item)) {
                    return array_values($item);
                }

                return (object) array_values(get_object_vars($item));
            });
        };
    }
}
