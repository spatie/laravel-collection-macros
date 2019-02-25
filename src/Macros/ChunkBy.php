<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class ChunkBy
{
    /**
     * Separate a collection into chunks as long as the given callback returns true.
     *
     * @param callable $callback
     * @param bool $preserveKeys
     *
     * @return \Illuminate\Support\Collection
     */
    public function chunkBy()
    {
        return function ($callback, bool $preserveKeys = false): Collection {
            return $this->sliceBefore(function ($item, $prevItem) use ($callback) {
                return $callback($item) !== $callback($prevItem);
            }, $preserveKeys);
        };
    }
}
