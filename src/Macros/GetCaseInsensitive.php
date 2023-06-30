<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Get the value of a given key. If $key is a string, we'll search for the
 * key using a case-insensitive comparison.
 *
 * @param string|callable $callback
 * @param bool $preserveKeys
 * @param mixed $modelKey
 * @param mixed $itemsKey
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class GetCaseInsensitive
{
    public function __invoke()
    {
        return function (mixed $key): mixed {
            $matchingKey = $this->search(function ($value, $collectionKey) use ($key) {
                return strcasecmp($collectionKey, $key) === 0;
            });

            if ($matchingKey === false) {
                return null;
            }

            return $this->get($matchingKey);
        };
    }
}
