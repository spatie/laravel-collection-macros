<?php

use Illuminate\Support\Collection;

/*
 * Get the array of values of a given key.
 *
 * @param  string|array  $value
 * @param  string|null  $key
 *
 * @return array
 */
Collection::macro('pluckToArray', function ($value, $key = null): array {
    return $this->pluck($value, $key)->toArray();
});
