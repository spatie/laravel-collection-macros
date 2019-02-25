<?php

namespace Spatie\CollectionMacros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Macros\At;
use Illuminate\Support\ServiceProvider;
use Spatie\CollectionMacros\Macros\Glob;
use Spatie\CollectionMacros\Macros\Head;
use Spatie\CollectionMacros\Macros\None;
use Spatie\CollectionMacros\Macros\Tail;
use Spatie\CollectionMacros\Macros\After;
use Spatie\CollectionMacros\Macros\IfAny;
use Spatie\CollectionMacros\Macros\Before;
use Spatie\CollectionMacros\Macros\Rotate;
use Spatie\CollectionMacros\Macros\ChunkBy;
use Spatie\CollectionMacros\Macros\Collect;
use Spatie\CollectionMacros\Macros\Extract;
use Spatie\CollectionMacros\Macros\IfEmpty;
use Spatie\CollectionMacros\Macros\ToPairs;
use Spatie\CollectionMacros\Macros\EachCons;
use Spatie\CollectionMacros\Macros\Paginate;
use Spatie\CollectionMacros\Macros\Validate;
use Spatie\CollectionMacros\Macros\withSize;
use Spatie\CollectionMacros\Macros\FilterMap;
use Spatie\CollectionMacros\Macros\FromPairs;
use Spatie\CollectionMacros\Macros\SectionBy;
use Spatie\CollectionMacros\Macros\Transpose;
use Spatie\CollectionMacros\Macros\Prioritize;
use Spatie\CollectionMacros\Macros\FirstOrFail;
use Spatie\CollectionMacros\Macros\ParallelMap;
use Spatie\CollectionMacros\Macros\SliceBefore;
use Spatie\CollectionMacros\Macros\GroupByModel;
use Spatie\CollectionMacros\Macros\PluckToArray;
use Spatie\CollectionMacros\Macros\GetHumanCount;
use Spatie\CollectionMacros\Macros\SimplePaginate;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::mixin(new After);
        Collection::mixin(new At);
        Collection::mixin(new Before);
        Collection::mixin(new ChunkBy);
        Collection::mixin(new Collect);
        Collection::mixin(new EachCons);
        Collection::mixin(new Extract);
        Collection::mixin(new FilterMap);
        Collection::mixin(new FirstOrFail);
        Collection::mixin(new FromPairs);
        Collection::mixin(new GetHumanCount);
        Collection::mixin(new Glob);
        Collection::mixin(new GroupByModel);
        Collection::mixin(new Head);
        Collection::mixin(new IfAny);
        Collection::mixin(new IfEmpty);
        Collection::mixin(new None);
        Collection::mixin(new Paginate);
        Collection::mixin(new ParallelMap);
        Collection::mixin(new PluckToArray);
        Collection::mixin(new Prioritize);
        Collection::mixin(new Rotate);
        Collection::mixin(new SectionBy);
        Collection::mixin(new SimplePaginate);
        Collection::mixin(new SliceBefore);
        Collection::mixin(new Tail);
        Collection::mixin(new ToPairs);
        Collection::mixin(new Transpose);
        Collection::mixin(new Validate);
        Collection::mixin(new withSize);
    }
}
