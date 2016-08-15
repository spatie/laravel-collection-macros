<?php

use Illuminate\Support\Collection;

if (! Collection::hasMacro('dd')) {
    /*
     * Dump the contents of the collection and terminate the script.
     */
    Collection::macro('dd', function () {
        dd($this);
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

if (! Collection::hasMacro('split')) {
    /*
     * Split a collection into a certain number of groups.
     *
     * @param int $numberOfGroups
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('split', function (int $numberOfGroups): Collection {
        $groupSize = ceil($this->count() / $numberOfGroups);

        return $this->chunk($groupSize);
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

if (! Collection::hasMacro('toAssoc')) {
    /*
     * Transform a collection into an associative array form collection item.
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('toAssoc', function () {
        return $this->reduce(function ($assoc, array $keyValuePair): Collection {
            list($key, $value) = $keyValuePair;
            $assoc[$key] = $value;

            return $assoc;
        }, new static);
    });
}

if (! Collection::hasMacro('mapToAssoc')) {
    /*
     * Transform a collection into an associative array form collection item,
     * allowing you to pass a callback to customize its key and value
     * through a map operation.
     *
     * @param callable callback
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('mapToAssoc', function (callable $callback): Collection {
        return $this->map($callback)->toAssoc();
    });
}

if (! Collection::hasMacro('transpose')) {
    /*
     * Transpose an array.
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('transpose', function (): Collection {
        $items = array_map(function (...$items) {
            return $items;
        }, ...$this->values());

        return new static($items);
    });
}

if (! Collection::hasMacro('collectBy')) {
    /*
     * Split Array based on Condition.
     * 
     * @param  callback  $callback
     * @return \Illuminate\Support\Collection
     */
	Collection::macro("collectBy",function($callback): Collection {
        $newCollection = $this->reduce(function ($newCollection, $row) use ($callback) {
            $index = $callback($row) ? 0 : 1;
            $newCollection[$index][] = $row;
            return $newCollection;
        }, []);
		return new static($newCollection);
	});
}
