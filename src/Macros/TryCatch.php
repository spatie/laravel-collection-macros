<?php

namespace Spatie\CollectionMacros\Macros;

use Spatie\CollectionMacros\Helpers\CatchableCollectionProxy;

class TryCatch
{
    public function __invoke()
    {
        return function () {
            return new CatchableCollectionProxy($this);
        };
    }
}
