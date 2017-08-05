<?php

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Debug\Dumper;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param mixed $modelKey
     * @param mixed $itemsKey
     * @param bool $preserveKeys
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('groupByModel', function ($callback, $modelKey = 'model', $itemsKey = 'items', bool $preserveKeys = false): Collection {
        $callback = $this->valueRetriever($callback);

        return $this->groupBy(function ($item) use ($callback) {
            return $callback($item)->getKey();
        }, $preserveKeys)->map(function (Collection $items) use ($callback, $modelKey, $itemsKey) {
            return [
                $modelKey => $callback($items->first()),
                $itemsKey => $items,
            ];
        })->values();
    });
}

if (! Collection::hasMacro('sectionBy')) {
    /*
     * Splits a collection into sections grouped by a given key.
     *
     * @param mixed $key
     * @param mixed $sectionKey
     * @param mixed $itemsKey
     * @param bool $preserveKeys
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('sectionBy', function ($key, $sectionKey = null, $itemsKey = 'items', $preserveKeys = false): Collection {
        $sectionKey = $sectionKey ?? $key;
        $sectionNameRetriever = $this->valueRetriever($key);

        $results = new Collection();

        foreach ($this->items as $key => $value) {
            $sectionName = $sectionNameRetriever($value);

            if (! $results->last() || $results->last()->get($sectionKey) !== $sectionName) {
                $results->push(new Collection([
                    $sectionKey => $sectionName,
                    $itemsKey => new Collection(),
                ]));
            }

            $results->last()->get($itemsKey)->offsetSet($preserveKeys ? $key : null, $value);
        }

        return $results;
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

if (! Collection::hasMacro('paginate')) {
    /*
     * Paginate the given collection
     *
     * @param int $perPage
     * @param int $total
     * @param int $page
     * @param string $pageName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    Collection::macro('paginate', function (int $perPage = 15, string $pageName = 'page', int $page = null, int $total = null, array $options = []): LengthAwarePaginator {
        $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
        $results = $this->forPage($page, $perPage);
        $total = $total ?: $this->count();
        $options += [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ];

        return new LengthAwarePaginator($results, $total, $perPage, $page, $options);
    });
}

if (! Collection::hasMacro('simplePaginate')) {
    /*
     * Paginate the collection into a simple paginator
     *
     * @param int $perPage
     * @param int $page
     * @param string $pageName
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    Collection::macro('simplePaginate', function (int $perPage = 15, string $pageName = 'page', int $page = null, array $options = []): Paginator {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);
        $results = $this->slice(($page - 1) * $perPage)->take($perPage + 1);
        $options += [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ];

        return new Paginator($results, $perPage, $page, $options);
    });
}

if (! Collection::hasMacro('extract')) {
    /*
     * Extract keys from a collection, like `only`, except:
     * - If a value doesn't exist, it returns null instead of omitting it
     * - It returns a collection without keys, so `list()` can be used.
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('extract', function ($keys) {
        $keys = is_array($keys) ? $keys : func_get_args();

        return array_reduce($keys, function ($extracted, $key) {
            return $extracted->push(
                data_get($this->items, $key)
            );
        }, new static());
    });
}
