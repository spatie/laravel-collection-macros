<?php

use Illuminate\Support\Collection;

if (!Collection::hasMacro('ifEmpty')) {
    Collection::macro('ifEmpty', function ($callback): Collection {
        if ($this->isEmpty()) {
            $callback();
        }
        return $this;
    });
}

if (!Collection::hasMacro('ifAny')) {
    Collection::macro('ifAny', function ($callback): Collection {
        if (!$this->isEmpty()) {
            $callback();
        }
        return $this;
    });
}

if (!Collection::hasMacro('range')) {
    Collection::macro('range', function ($low, $high, $step = 1): Collection {
        return new Collection(range($low, $high, $step));
    });
}

if (!Collection::hasMacro('none')) {
    Collection::macro('none', function ($key, $value = null): bool {
        if (func_num_args() == 2) {
            return !$this->contains($key, $value);
        }
        return !$this->contains($key);
    });
}
