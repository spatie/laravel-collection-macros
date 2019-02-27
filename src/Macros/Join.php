<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/*
 * Join all items from the collection using a string. The final items can use a separate glue string.
 *
 */
class Join
{
    public function __invoke()
    {
        return function (string $glue, string $finalGlue = ''): string {
            if ($finalGlue === '') {
                return $this->implode($glue);
            }

            if ($this->count() === 0) {
                return '';
            }

            if ($this->count() === 1) {
                return $this->last();
            }

            $collection = new Collection($this->items);

            $finalItem = $collection->pop();

            return $collection->implode($glue).$finalGlue.$finalItem;
        };
    }
}
