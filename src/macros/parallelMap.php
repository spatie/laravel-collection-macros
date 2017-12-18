<?php

use function Amp\Promise\wait;
use Illuminate\Support\Collection;
use function Amp\ParallelFunctions\parallelMap;

/*
 * Idential to map but each item will be processed in parallel.
 *
 * This function requires the installation of amphp/parallel-functions
 *
 * @param callable $callback
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('parallelMap', function (callable $callback): Collection {
    $promises = parallelMap($this->items, $callback);

    $this->items = wait($promises);

    return $this;
});
