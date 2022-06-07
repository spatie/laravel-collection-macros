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
                fn ($value) => blank($value) ? null : (function () use ($value) {
                    if (is_iterable($value)) {
                        foreach ($value as $key => $nested) {
                            if (blank($nested)) {
                                $value[$key] = null;
                            }

                            if ($nested instanceof Collection) {
                                $value[$key] = $nested->nullify();
                            }
                        }
                    }

                    return $value;
                })()
            );
        };
    }
}
