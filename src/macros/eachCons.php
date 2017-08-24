<?php

use Illuminate\Support\Collection;

/*
 * Get the consecutive values in the collection defined by the given chunk size
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('eachCons', function ($chunkSize) {
    if ($this->count() < $chunkSize) {
        return new static();
    }

    return (new static([$this->take($chunkSize)->values()]))
        ->merge($this->tail()->eachCons($chunkSize));
});
