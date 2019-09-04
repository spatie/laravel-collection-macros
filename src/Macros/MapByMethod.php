<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Map a collection of objects by a method on the objects.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class MapByMethod
{
    public function __invoke()
    {
        return function (string $method, ...$args) : Collection {
            return $this->map(function ($obj) use ($method, $args) {
                return $obj->$method(...$args);
            });
        };
    }
}
