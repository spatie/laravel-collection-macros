<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;

/*
 * Sort the values in a collection by a datetime value.
 *
 * @param mixed $key
 *
 * @return Collection
 */
Collection::macro('sortByDate', function ($key = null) {

    return $this->sortBy(function($item) use ($key) {

        if (is_callable($key) && !is_string($key)) {
            return $key($item);
        }

        $date = $key === null ? $item : $item[$key];

        if ($date instanceof Carbon) {
            return $date->getTimestamp();
        }

        try {
            return Carbon::parse($date)->getTimestamp();
        } catch (Exception $e) {}

        return 0;

    })->values();
});

/*
 * Sort the values in a collection by a datetime value in reversed order.
 *
 * @param mixed $key
 *
 * @return mixed
 */
Collection::macro('sortByDateDesc', function ($key = null) {
    return $this->sortByDate($key)->reverse();
});
