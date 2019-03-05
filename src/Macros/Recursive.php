<?php

namespace Spatie\CollectionMacros\Macros;

/**
 * Use to deep collect multi-dimensional associative arrays.
 */
class Recursive
{
	public function __invoke()
	{
		return function () {
			return $this->map(function ($value) {
				if (is_array($value) || is_object($value)) {
					return collect($value)->recursive();
				}

				return $value;
			});
		};
	}
}