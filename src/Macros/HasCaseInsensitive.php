<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Determine if the collection contains a key with a given name.
 * If $key is a string, we'll search for the key using a case-insensitive comparison.
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
class HasCaseInsensitive
{
    public function __invoke()
    {
        return function (mixed $key): bool {
            $matchingKey = $this->search(function ($value, $collectionKey) use ($key) {
                return strcasecmp($collectionKey, $key) === 0;
            });

            return $matchingKey !== false;
        };
    }
}
