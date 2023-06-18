<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Creates properties from the (string) keys of the collection
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class KeysToProperties
{
    public function __invoke()
    {
        return function (): Collection {
            return $this->transform(function ($value, $key) {
                if (is_string($key)) {
                    $this->{$key} = $value;
                }

                return $value;
            });
        };
    }
}
