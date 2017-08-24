<?php

use Illuminate\Support\Collection;

/*
 * Slice a collection before a given callback is met into separate chunks
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('sliceBefore', function ($callback) {
    if ($this->isEmpty()) {
        return new static();
    }

    $sliced = new static([
        new static([$this->first()]),
    ]);

    return $this->eachCons(2)->reduce(function ($sliced, $previousAndCurrent) use ($callback) {
        list($previousItem, $item) = $previousAndCurrent;

        $callback($item, $previousItem)
            ? $sliced->push(new static([$item]))
            : $sliced->last()->push($item);

        return $sliced;
    }, $sliced);
});
