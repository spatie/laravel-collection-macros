<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Arr;
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
class PluckMany
{
    public function __invoke()
    {
        return function ($keys): Collection {
            // Allow passing multiple keys as multiple arguments
            $keys = is_array($keys) ? $keys : func_get_args();

            return $this->map(function ($item) use ($keys) {
                if ($item instanceof Collection) {
                    if (Arr::accessible($item->all())) {
                        return new static(pluckManyHelper($item->all(), $keys));
                    }

                    return $item->only($keys);
                }

                if (Arr::accessible($item)) {
                    return pluckManyHelper($item, $keys);
                }

                // ArrayAccess handling not required, Arr::accessible includes it.

                return (object) pluckManyHelper(get_object_vars($item), $keys);
            });
        };
    }
}

function pluckManyHelper($item, $keys): array
{
    $result = [];
    foreach ($keys as $key) {
        if (Arr::has($item, $key)) {
            $result[$key] = Arr::get($item, $key);
        }
    }

    return $result;
}
