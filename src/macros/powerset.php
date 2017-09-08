<?php

use Illuminate\Support\Collection;

Collection::macro('powerset', function (): Collection {
    $keys = array_keys($this->items);
    $size = pow(2, $this->count());

    $subsets = new Collection;

    for ($i = 0; $i < $size; $i++) {
        $subset = new static;
        $code = $i ^ ($i >> 1);

        for ($j = 0; $j < $this->count(); $j++) {
            if (($code >> $j) & 1) {
                $subset[$keys[$j]] = $this->items[$keys[$j]];
            }
        }

        $subsets->push($subset);
    }

    return $subsets;
});
