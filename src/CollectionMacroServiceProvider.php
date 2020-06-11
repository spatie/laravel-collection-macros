<?php

namespace Spatie\CollectionMacros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::make(glob(__DIR__.'/Macros/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro, $path) {
                $class = 'Spatie\\CollectionMacros\\Macros\\'.$macro;

                $macro = Str::camel($macro);

                if ($macro === 'tryCatch') {
                    $macro = 'try';
                }

                Collection::macro($macro, app($class)());
            });
    }
}
