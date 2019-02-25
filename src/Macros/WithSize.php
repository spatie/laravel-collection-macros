<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

class WithSize
{
    /**
     * Create a new collection with the specified amount of items.
     *
     * @param int $size
     *
     * @return \Illuminate\Support\Collection
     */
    public function withSize()
    {
        return function (int $size): Collection {
            if ($size < 1) {
                return new Collection();
            }

            return new Collection(range(1, $size));
        };
    }
}
