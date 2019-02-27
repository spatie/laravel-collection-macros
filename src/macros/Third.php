<?php

namespace Spatie\CollectionMacros\Macros;

class Third {
    public function __invoke() {
        return function () {
            return $this->get(2);
        };
    }
}
