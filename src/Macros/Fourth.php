<?php

namespace Spatie\CollectionMacros\Macros;

class Fourth
{
    public function __invoke()
    {
        return function () {
            return $this->skip(3)->first();
        };
    }
}
