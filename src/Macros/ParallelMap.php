<?php

namespace Spatie\CollectionMacros\Macros;

use Amp\Parallel\Worker\DefaultPool;
use Amp\Parallel\Worker\Pool;

use function Amp\ParallelFunctions\parallelMap;
use function Amp\Promise\wait;

use Illuminate\Support\Collection;

/**
 * @deprecated This function will be removed in the next major release.
 *
 * Identical to map but each item will be processed in parallel.
 *
 * This function requires the installation of amphp/parallel-functions
 *
 * @param callable $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class ParallelMap
{
    public function __invoke()
    {
        return function (callable $callback, $workers = null): Collection {
            $pool = null;

            if ($workers instanceof Pool) {
                $pool = $workers;
            }

            if (is_int($workers)) {
                $pool = new DefaultPool($workers);
            }

            $promises = parallelMap($this->items, $callback, $pool);

            return new static(wait($promises));
        };
    }
}
