<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Returns true if $callback returns true for every item. If $callback
 * is a string or an array, regard it as a validation rule.
 *
 * @param string|callable $callback
 **
 * @mixin \Illuminate\Support\Collection
 *
 * @return bool
 */
class Validate
{
    public function __invoke()
    {
        return function ($callback): bool {
            if (is_string($callback) || is_array($callback)) {
                $validationRule = $callback;

                $callback = function ($item) use ($validationRule) {
                    if (! is_array($item)) {
                        $item = ['default' => $item];
                    }

                    if (! is_array($validationRule)) {
                        $validationRule = ['default' => $validationRule];
                    }

                    return app('validator')->make($item, $validationRule)->passes();
                };
            }

            foreach ($this->items as $item) {
                if (! $callback($item)) {
                    return false;
                }
            }

            return true;
        };
    }
}
