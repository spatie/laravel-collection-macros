<?php

namespace Spatie\CollectionMacros\Macros;

use ArrayAccess;
use Illuminate\Support\Collection;

/**
 * Checks whether a collection has blank
 * values and sets the values null if so.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 *
 */
class Nullify
{
    public function __invoke()
    {
        return function () {
            return $this->map(
                fn ($value) => ! blank($value)
                    ? (function () use ($value) {
                        if ((is_array($value) || $value instanceof \ArrayAccess) && is_iterable($value)) {
                            foreach ($value as $key => $nestedValue) {
                                if ($nestedValue instanceof Collection) {
                                    $value[$key] = $nestedValue->nullify();
                                }

                                if (blank($nestedValue)) {
                                    $value[$key] = null;
                                }
                            }
                        }

                        return $value;
                    })()
                    : null
            );
        };
    }
}
