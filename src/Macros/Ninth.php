<?php

namespace Spatie\CollectionMacros\Macros;

class Ninth
{
    public function __invoke() {
        return function () {
            return $this->get(8);
        };
    }
}
