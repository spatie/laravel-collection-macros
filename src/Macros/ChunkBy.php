<?php

namespace Spatie\CollectionMacros\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Separate a collection into chunks as long as the given callback returns true.

 * @mixin \Illuminate\Support\Collection
 */
class ChunkBy
{
    public function __invoke()
    {
        return function (Closure $callback, bool $preserveKeys = false): Collection {
            return $this->sliceBefore(function ($item, $prevItem) use ($callback) {
                return $callback($item) !== $callback($prevItem);
            }, $preserveKeys);
        };
    }
}
