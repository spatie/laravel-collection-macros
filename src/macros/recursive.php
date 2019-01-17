<?php

use Illuminate\Support\Collection;

/*
 * Transform recursive all arrays and objects into a collection.
 *
 * @return \Illuminate\Support\Collection
 */
Collection::macro('recursive', function () {
	return $this->map(function ($value) {
		if (is_array($value) || is_object($value)) {
			return collect($value)->recursive();
		}

		return $value;
	});
});
