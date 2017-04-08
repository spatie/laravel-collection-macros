<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Debug\Dumper;

if (! Collection::hasMacro('dd')) {
    /*
     * Dump the contents of the collection and terminate the script.
     */
    Collection::macro('dd', function () {
        dd($this);
    });
}

if (! Collection::hasMacro('dump')) {
    /*
     * Dump the arguments given followed by the collection.
     */
    Collection::macro('dump', function () {
        Collection::make(func_get_args())
            ->push($this)
            ->each(function ($item) {
                (new Dumper)->dump($item);
            });

        return $this;
    });
}

if (! Collection::hasMacro('ifEmpty')) {
    /*
     * Execute a callable if the collection is empty, then return the collection.
     *
     * @param callable $callback
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('ifEmpty', function (callable $callback): Collection {
        if ($this->isEmpty()) {
            $callback($this);
        }

        return $this;
    });
}

if (! Collection::hasMacro('ifAny')) {
    /*
     * Execute a callable if the collection isn't empty, then return the collection.
     *
     * @param callable callback

     * @return \Illuminate\Support\Collection
     */
    Collection::macro('ifAny', function (callable $callback): Collection {
        if (! $this->isEmpty()) {
            $callback($this);
        }

        return $this;
    });
}

if (! Collection::hasMacro('range')) {
    /*
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

if (! Collection::hasMacro('withSize')) {
    /*
     * Create a new collection with the specified amount of items
     *
     * @param int $size
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('withSize', function (int $size): Collection {
        if ($size < 1) {
            return new Collection();
        }

        return new Collection(range(1, $size));
    });
}

if (! Collection::hasMacro('none')) {
    /*
     * Check whether a collection doesn't contain any occurrences of a given
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
        if (func_num_args() === 2) {
            return ! $this->contains($key, $value);
        }

        return ! $this->contains($key);
    });
}

if (! Collection::hasMacro('validate')) {
    /*
     * Returns true if $callback returns true for every item. If $callback
     * is a string or an array, regard it as a validation rule.
     *
     * @param string|callable $callback
     *
     * @return bool
     */
    Collection::macro('validate', function ($callback): bool {
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
    });
}

if (! Collection::hasMacro('groupByModel')) {
    /*
     * Group a collection by an Eloquent model.
     *
     * @param string|callable $callback
     * @param string $keyName
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('groupByModel', function ($callback, $keyName = 'model') {
        $callback = is_callable($callback) ? $callback : function ($item) use ($callback) {
            return $item[$callback];
        };

        return Collection::make($this->items)->map(function ($item) use ($callback) {
            return ['key' => $callback($item), 'item' => $item];
        })->groupBy(function (array $keyedItem) {
            return $keyedItem['key']->getKey();
        })->map(function (Collection $group) use ($keyName) {
            return $group->reduce(function (array $result, array $group) use ($keyName) {
                $result[$keyName] = $group['key'];
                $result['items'][] = $group['item'];

                return $result;
            }, []);
        })->map(function (array $group) {
            $group['items'] = Collection::make($group['items']);

            return $group;
        })->values();
    });
}

if (! Collection::hasMacro('fromPairs')) {
    /*
     * Transform a collection into an associative array form collection item.
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('fromPairs', function () {
        return $this->reduce(function ($assoc, array $keyValuePair): Collection {
            list($key, $value) = $keyValuePair;
            $assoc[$key] = $value;

            return $assoc;
        }, new static);
    });
}

if (! Collection::hasMacro('toPairs')) {
    /*
     * Transform a collection into an an array with pairs.
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('toPairs', function () {
        return $this->keys()->map(function ($key) {
            return [$key, $this->items[$key]];
        });
    });
}

if (! Collection::hasMacro('transpose')) {
    /*
     * Transpose an array.
     *
     * @return \Illuminate\Support\Collection
     *
     * @throws \LengthException
     */
    Collection::macro('transpose', function (): Collection {
        $values = $this->values();

        $expectedLength = count($this->first());
        $diffLength = count(array_intersect_key(...$values));

        if ($expectedLength !== $diffLength) {
            throw new \LengthException("Element's length must be equal.");
        }

        $items = array_map(function (...$items) {
            return new static($items);
        }, ...$values);

        return new static($items);
    });
}

if (! Collection::hasMacro('collect')) {
    /*
     * Get a new collection from the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $default
     *
     * @return static
     */
    Collection::macro('collect', function ($key, $default = null) {
        return new static($this->get($key, $default));
    });
}

if (! Collection::hasMacro('after')) {
    /*
     * Get the next item from the collection.
     *
     * @param mixed $currentItem
     * @param mixed $fallback
     *
     * @return mixed
     */
    Collection::macro('after', function ($currentItem, $fallback = null) {
        $currentKey = $this->search($currentItem, true);

        if ($currentKey === false) {
            return $fallback;
        }

        $currentOffset = $this->keys()->search($currentKey, true);

        $next = $this->slice($currentOffset, 2);

        if ($next->count() < 2) {
            return $fallback;
        }

        return $next->last();
    });
}

if (! Collection::hasMacro('before')) {
    /*
     * Get the previous item from the collection.
     *
     * @param mixed $currentItem
     * @param mixed $fallback
     *
     * @return mixed
     */
    Collection::macro('before', function ($currentItem, $fallback = null) {
        return $this->reverse()->after($currentItem, $fallback);
    });
}

if (! Collection::hasMacro('exists')) {
    /*
     * Check if value exists in collection.
     *
     * @param string $item
     * @param bool $strict
     *
     * @return string|bool
     */
    Collection::macro('exists', function ($item, $strict = false) {
            $inArrayRecursive = function ($needle, $haystack, $strict = false, $path = []) use (&$inArrayRecursive) {
                foreach ($haystack as $key => $value) {
                    if ($strict ? $value === $needle : $value == $needle) {
                        return implode('.', $path);
                    } else {
                        if (is_array($value)) {
                            $path[] = $key;
                            return $inArrayRecursive($needle, $value, $strict, $path);
                        }
                    }
                }

                return false;
            };

            return $inArrayRecursive($item, $this->items, $strict, []);
        });
}

if (! Collection::hasMacro('forgetAll')) {

    /*
     * The forgetAll method removes an item from the collection by its key(s).
     *
     * @param mixed $keys
     *
     * @return void
     */
    Collection::macro('forgetAll', function ($keys) {
        Arr::forget($this->items, $keys);
    });
}
