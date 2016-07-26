<?php

use Illuminate\Support\Collection;

if (!Collection::hasMacro('ifEmpty')) {
    /**
     * Execute a callable if the collection is empty, then return the collection.
     *
     * @param callable $callback
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('ifEmpty', function (callable $callback): Collection {
        if ($this->isEmpty()) {
            $callback();
        }
        return $this;
    });
}

if (!Collection::hasMacro('ifAny')) {
    /**
     * Execute a callable if the collection isn't empty, then return the collection.
     *
     * @param callable callback

     * @return \Illuminate\Support\Collection
     */
    Collection::macro('ifAny', function (callable $callback): Collection {
        if (!$this->isEmpty()) {
            $callback();
        }
        return $this;
    });
}

if (!Collection::hasMacro('range')) {
    /**
     * Create a new collection instance with a range of numbers. `range`
     * accepts the same parameters as PHP's standard `range` function.
     *
     * @see range
     *
     * @param mixed $start
     * @param mixed $end
     * @param int|float $step
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('range', function ($start, $end, $step = 1): Collection {
        return new Collection(range($start, $end, $step));
    });
}

if (!Collection::hasMacro('none')) {
    /**
     * Check whether a collection doesn't contain any occurences of a given
     * item, key-value pair, or passing truth test. `none` accepts the same
     * parameters as the `contains` collection method.
     *
     * @see \Illuminate\Support\Collection::contains
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return bool
     */
    Collection::macro('none', function ($key, $value = null): bool {
        if (func_num_args() == 2) {
            return !$this->contains($key, $value);
        }
        return !$this->contains($key);
    });
}
