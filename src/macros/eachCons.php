<?php

use Illuminate\Support\Collection;

/*
 * Get the consecutive values in the collection defined by the given chunk size.
 *
 * @param int $chunkSize
 * @param bool $preserveKeys
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('eachCons', function ($chunkSize, $preserveKeys = false) {
    if ($this->count() < $chunkSize) {
        return new static();
    }

    return (new static([$preserveKeys ? $this->take($chunkSize) : $this->take($chunkSize)->values()]))
        ->merge($this->tail($preserveKeys)->eachCons($chunkSize, $preserveKeys));
});
