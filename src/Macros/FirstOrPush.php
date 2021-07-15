<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Enumerable;

/**
 * Retrieve the first item that passes the given callback, or push
 * the resolved callable into the collection and return it if
 * no matching value is found. You may specify the collection
 * instance to push into as a third parameter.
 *
 * @param callable $callable
 * @param callable|mixed $value
 * @param Enumerable|null $instance
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class FirstOrPush
{
    public function __invoke()
    {
        return function ($callback, $value, $instance = null) {
            return $this->first($callback) ?? tap(
                value($value),
                fn ($resolved) => ($instance ?? $this)->push($resolved)
            );
        };
    }
}
