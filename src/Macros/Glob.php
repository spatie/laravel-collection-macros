<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/*
 * Execute a callable if the collection isn't empty, then return the collection.
 */
class Glob
{
    public function __invoke()
    {
        return function (string $pattern, int $flags = 0): Collection {
            return Collection::make(glob($pattern, $flags));
        };
    }
}
