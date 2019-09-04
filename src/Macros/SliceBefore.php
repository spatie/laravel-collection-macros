<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Slice a collection before a given callback is met into separate chunks.
 *
 * @param callable $callback
 * @param bool $preserveKeys
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Support\Collection
 */
class SliceBefore
{
    public function __invoke()
    {
        return function ($callback, bool $preserveKeys = false): Collection {
            if ($this->isEmpty()) {
                return new static();
            }

            if (! $preserveKeys) {
                $sliced = new static([
                    new static([$this->first()]),
                ]);

                return $this->eachCons(2)->reduce(function ($sliced, $previousAndCurrent) use ($callback) {
                    [$previousItem, $item] = $previousAndCurrent;

                    $callback($item, $previousItem)
                        ? $sliced->push(new static([$item]))
                        : $sliced->last()->push($item);

                    return $sliced;
                }, $sliced);
            }

            $sliced = new static([$this->take(1)]);

            return $this->eachCons(2, $preserveKeys)->reduce(function ($sliced, $previousAndCurrent) use ($callback) {
                $previousItem = $previousAndCurrent->take(1);
                $item = $previousAndCurrent->take(-1);

                $itemKey = $item->keys()->first();
                $valuesItem = $item->first();
                $valuesPreviousItem = $previousItem->first();

                $callback($valuesItem, $valuesPreviousItem)
                    ? $sliced->push($item)
                    : $sliced->last()->put($itemKey, $valuesItem);

                return $sliced;
            }, $sliced);
        };
    }
}
