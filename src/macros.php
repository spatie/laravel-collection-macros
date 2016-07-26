<?php

use Illuminate\Support\Collection;

if (!Collection::hasMacro('ifEmpty')) {
    Collection::macro('ifEmpty', function ($callback) {
        if ($this->isEmpty()) {
            $callback();
        }
        return $this;
    });
}

if (!Collection::hasMacro('ifAny')) {
    Collection::macro('ifAny', function ($callback) {
        if (!$this->isEmpty()) {
            $callback();
        }
        return $this;
    });
}
