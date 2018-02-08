<?php

use Amp\Parallel\Worker\Pool;
use function Amp\Promise\wait;
use Illuminate\Support\Collection;
use Amp\Parallel\Worker\DefaultPool;
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
Collection::macro('parallelMap', function (callable $callback, $workers = null): Collection {
    $pool = null;

    if ($workers instanceof Pool) {
        $pool = $workers;
    }

    if (is_int($workers)) {
        $pool = new DefaultPool($workers);
    }

    $promises = parallelMap($this->items, $callback, $pool);

    return new static(wait($promises));
});
