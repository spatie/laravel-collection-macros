<?php

namespace Spatie\CollectionMacros;

use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        require_once __DIR__.'/macros.php';
    }
}
