# A set of useful Laravel collection macros

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)
[![StyleCI](https://styleci.io/repos/64222176/shield)](https://styleci.io/repos/64222176)
[![Build Status](https://img.shields.io/travis/spatie/laravel-collection-macros/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-collection-macros)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/659f58d2-5324-4bb9-b2ff-8873c7a82d10.svg?style=flat-square)](https://insight.sensiolabs.com/projects/659f58d2-5324-4bb9-b2ff-8873c7a82d10)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-collection-macros.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-collection-macros)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)

This repository contains some useful collection macros.

This version is targeted at Laravel 5.5. & 5.6 For Laravel 5.2 or 5.3, take a look at [the v1 branch](https://github.com/spatie/laravel-collection-macros/tree/v1). For 5.4 [the v2 branch](https://github.com/spatie/laravel-collection-macros/tree/v2).

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment you are required to send us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

The best postcards will get published on the open source page on our website.

## Installation

You can pull in the package via composer:

``` bash
composer require spatie/laravel-collection-macros
```

The package will automatically register itself.


## Macros

- [`after`](#after)
- [`at`](#at)
- [`before`](#before)
- [`chunkBy`](#chunkby)
- [`collect`](#collect)
- [`eachCons`](#eachcons)
- [`extract`](#extract)
- [`filterMap`](#filtermap)
- [`firstOrFail`](#firstorfail)
- [`fromPairs`](#frompairs)
- [`glob`](#glob)
- [`groupByModel`](#groupbymodel)
- [`ifAny`](#ifany)
- [`ifEmpty`](#ifempty)
- [`none`](#none)
- [`paginate`](#paginate)
- [`parallelMap`](#parallelmap)
- [`pluckToArray`](#plucktoarray)
- [`range`](#range)
- [`rotate`](#rotate)
- [`sectionBy`](#sectionby)
- [`simplePaginate`](#simplepaginate)
- [`sliceBefore`](#slicebefore)
- [`tail`](#tail)
- [`toPairs`](#topairs)
- [`transpose`](#transpose)
- [`validate`](#validate)
- [`withSize`](#withsize)

### `after`

Get the next item from the collection.

```php
$collection = collect([1,2,3]);

$currentItem = 2;

$currentItem = $collection->after($currentItem); // return 3;
$collection->after($currentItem); // return null;

$currentItem = $collection->after(function($item) {
    return $item > 1;
}); // return 3;
```

You can also pass a second parameter to be used as a fallback.

```php
$collection = collect([1,2,3]);

$currentItem = 3;

$collection->after($currentItem, $collection->first()); // return 1;
```

### `at`

Retrieve an item at an index.

```php
$data = new Collection([1, 2, 3]);

$data->at(0); // 1
$data->at(1); // 2
$data->at(-1); // 3
```

### `before`

Get the previous item from the collection.

```php
$collection = collect([1,2,3]);

$currentItem = 2;

$currentItem = $collection->before($currentItem); // return 1;
$collection->before($currentItem); // return null;

$currentItem = $collection->before(function($item) {
    return $item > 2;
}); // return 2;
```

You can also pass a second parameter to be used as a fallback.

```php
$collection = collect([1,2,3]);

$currentItem = 1;

$collection->before($currentItem, $collection->last()); // return 3;
```

### `chunkBy`

Chunks the values from a collection into groups as long the given callback is true. If the optional parameter `$preserveKeys` as `true` is passed, it will preserve the original keys.

```php
collect(['A', 'A', 'B', 'A'])->chunkBy(function($item) {
    return $item == 'A';
}); // return Collection([['A', 'A'],['B'], ['A']])
```

### `collect`

Get an item at a given key, and collect it.

```php
$collection = collect([
    'foo' => [1, 2, 3],
    'bar' => [4, 5, 6],
]);

$collection->collect('foo'); // Collection([1, 2, 3])
```

You can also pass a second parameter to be used as a fallback.

```php
$collection = collect([
    'foo' => [1, 2, 3],
    'bar' => [4, 5, 6],
]);

$collection->collect('baz', ['Nope']); // Collection(['Nope'])
```

### `eachCons`

Get the following consecutive neighbours in a collection from a given chunk size. If the optional parameter `$preserveKeys` as `true` is passed, it will preserve the original keys.

```php
collect([1, 2, 3, 4])->eachCons(2); // return collect([[1, 2], [2, 3], [3, 4]])
```

### `extract`

Extract keys from a collection. This is very similar to `only`, with two key differences:

- `extract` returns an array of values, not an associative array
- If a value doesn't exist, it will fill the value with `null` instead of omitting it

`extract` is useful when using PHP 7.1 short `list()` syntax.

```php
[$name, $role] = collect($user)->extract('name', 'role.name');
```

### `filterMap`

Map a collection and remove falsy values in one go.

```php
$collection = collect([1, 2, 3, 4, 5, 6])->filterMap(function ($number) {
    $quotient = $number / 3;

    return is_integer($quotient) ? $quotient : null;
});

$collection->toArray(); // returns [1, 2]
```

### `firstOrfail`

Get the first item. Throws `Spatie\CollectionMacros\Exceptions\CollectionItemNotFound` if the item was not found.

```php
$collection = collect([1, 2, 3, 4, 5, 6])->firstOrFail();

$collection->toArray(); // returns [1]

collect([])->firstOrFail(); // throws Spatie\CollectionMacros\Exceptions\CollectionItemNotFound
```

### `fromPairs`

Transform a collection into an associative array form collection item.

```php
$collection = collect(['a', 'b'], ['c', 'd'], ['e', 'f'])->fromPairs();

$collection->toArray(); // returns ['a' => 'b', 'c' => 'd', 'e' => 'f']
```

### `glob`

Returns a collection of a `glob()` result.

```php
Collection::glob('config/*.php');
```

### `groupByModel`

Similar to `groupBy`, but groups the collection by an Eloquent model. Since the key is an object instead of an integer or string, the results are divided into separate arrays.

```php
$posts->groupByModel('category');

// [
//     [$categoryA, [/*...$posts*/]],
//     [$categoryB, [/*...$posts*/]],
// ];
```

Full signature: `groupByModel($callback, $preserveKeys, $modelKey, $itemsKey)`

### `ifAny`

Executes the passed callable if the collection isn't empty. The entire collection will be returned.

```php
collect()->ifAny(function(Collection $collection) { // empty collection so this won't get called
   echo 'Hello';
});

collect([1, 2, 3])->ifAny(function(Collection $collection) { // non-empty collection so this will get called
   echo 'Hello';
});
```

### `ifEmpty`

Executes the passed callable if the collection is empty. The entire collection will be returned.

```php
collect()->ifEmpty(function(Collection $collection) { // empty collection so this will called
   echo 'Hello';
});

collect([1, 2, 3])->ifEmpty(function(Collection $collection) { // non-empty collection so this won't get called
   echo 'Hello';
});
```

### `none`

Checks whether a collection doesn't contain any occurrences of a given item, key-value pair, or passing truth test. The function accepts the same parameters as the `contains` collection method.

```php
collect(['foo'])->none('bar'); // returns true
collect(['foo'])->none('foo'); // returns false

collect([['name' => 'foo']])->none('name', 'bar'); // returns true
collect([['name' => 'foo']])->none('name', 'foo'); // returns false

collect(['name' => 'foo'])->none(function ($key, $value) {
   return $key === 'name' && $value === 'bar';
}); // returns true
```

### `paginate`

Create a `LengthAwarePaginator` instance for the items in the collection.

```php
collect($posts)->paginate(5);
```

This paginates the contents of `$posts` with 5 items per page. `paginate` accepts quite some options, head over to [the Laravel docs](https://laravel.com/docs/5.4/pagination) for an in-depth guide.

```
paginate(int $perPage = 15, string $pageName = 'page', int $page = null, int $total = null, array $options = [])
```

### `parallelMap`

Identical to `map` but each item in the collection will be processed in parallel. Before using this macro you should pull in the `amphp/parallel-functions` package.

```bash
composer require amphp/parallel-functions
```

Be aware that under the hood some overhead is introduced to make the parallel procession possible. When your `$callable` is only a simple operation it's probably better to use `map` instead. Also keep in mind that `parallelMap` can be memory intensive. 

```php
$pageSources = collect($urls)->parallelMap(function($url) {
    return file_get_contents($url);
});
```

The page contents of the given `$urls` will be fetched at the same time. The underlying `amp` sets a maximum of `32` concurrent processes by default.

There is a second (optional) parameter, through which you can define a custom parallel processing pool. It looks like this:

```php
use Amp\Parallel\Worker\DefaultPool;

$pool = new DefaultPool(8);

$pageSources = collect($urls)->parallelMap(function($url) {
    return file_get_contents($url);
}, $pool);
```

If you don't need to extend the worker pool, or can't be bothered creating the new pool yourself; you can use an integer the the number of workers you'd like to use. A new `DefaultPool` will be created for you:

```php
$pageSources = collect($urls)->parallelMap(function($url) {
    return file_get_contents($url);
}, 8);
```

This helps to reduce the memory overhead, as the default worker pool limit is `32` (as defined in `amphp/parallel`). Using fewer worker threads can significantly reduce memory and processing overhead, in many cases. Benchmark and customise the worker thread limit to suit your particular use-case.

### `pluckToArray`

Returns array of values of a given key. 

```php
$collection = collect([ 
    ['a' => 1, 'b' => 10], 
    ['a' => 2, 'b' => 20], 
    ['a' => 3, 'b' => 30] 
]);
    
$collection->pluckToArray('a'); // returns [1, 2, 3]
```

### `range`

Creates a new collection instance with a range of numbers. This functions accepts the same parameters as PHP's standard `range` function.

```php
collect()->range(1, 3)->toArray(); //returns [1,2,3]
```

### `rotate`

Rotate the items in the collection with given offset

```php
$collection = collect([1, 2, 3, 4, 5, 6]);

$rotate = $collection->rotate(1);

$rotate->toArray();

// [2, 3, 4, 5, 6, 1]
```

### `sectionBy`

Splits a collection into sections grouped by a given key. Similar to `groupBy` but respects the order of the items in the collection and reuses existing keys.

```php
$collection = collect([
    ['name' => 'Lesson 1', 'module' => 'Basics'],
    ['name' => 'Lesson 2', 'module' => 'Basics'],
    ['name' => 'Lesson 3', 'module' => 'Advanced'],
    ['name' => 'Lesson 4', 'module' => 'Advanced'],
    ['name' => 'Lesson 5', 'module' => 'Basics'],
]);

$collection->sectionBy('module');

// [
//     ['Basics', [
//         ['name' => 'Lesson 1', 'module' => 'Basics'],
//         ['name' => 'Lesson 2', 'module' => 'Basics'],
//     ]],
//     ['Advanced', [
//         ['name' => 'Lesson 3', 'module' => 'Advanced'],
//         ['name' => 'Lesson 4', 'module' => 'Advanced'],
//     ]],
//     ['Basics', [
//         ['name' => 'Lesson 5', 'module' => 'Basics'],
//     ]],
// ];
```

Full signature: `sectionBy($callback, $preserveKeys, $sectionKey, $itemsKey)`

### `simplePaginate`

Create a `Paginator` instance for the items in the collection.

```php
collect($posts)->simplePaginate(5);
```

This paginates the contents of `$posts` with 5 items per page. `simplePaginate` accepts quite some options, head over to [the Laravel docs](https://laravel.com/docs/5.4/pagination) for an in-depth guide.

```
simplePaginate(int $perPage = 15, string $pageName = 'page', int $page = null, int $total = null, array $options = [])
```

For a in-depth guide on pagination, check out [the Laravel docs](https://laravel.com/docs/5.4/pagination).

### `sliceBefore`

Slice the values out from a collection before the given callback is true. If the optional parameter `$preserveKeys` as `true` is passed, it will preserve the original keys.

```php
collect([20, 51, 10, 50, 66])->sliceBefore(function($item) {
    return $item > 50;
}); // return collect([[20],[51, 10, 50], [66])
```

### `tail`

Extract the tail from a collection. So everything except the first element. It's a shorthand for `slice(1)->values()`, but nevertheless very handy. It's a shorthand for `slice(1)->values()`. If the optional parameter `$preserveKeys` as `true` is passed, it will preserve the keys and fallback to `slice(1)`.

```php
collect([1, 2, 3])->tail(); // return collect([2, 3])
```

### `toPairs`

Transform a collection in to a array with pairs.

```php
$collection = collect(['a' => 'b', 'c' => 'd', 'e' => 'f'])->toPairs();

$collection->toArray(); // returns ['a', 'b'], ['c', 'd'], ['e', 'f']
```

### `transpose`

The goal of transpose is to rotate a multidimensional array, turning the rows into columns and the columns into rows.

```php
collect([
    ['Jane', 'Bob', 'Mary'],
    ['jane@example.com', 'bob@example.com', 'mary@example.com'],
    ['Doctor', 'Plumber', 'Dentist'],
])->transpose()->toArray();

// [
//     ['Jane', 'jane@example.com', 'Doctor'],
//     ['Bob', 'bob@example.com', 'Plumber'],
//     ['Mary', 'mary@example.com', 'Dentist'],
// ]
```

### `validate`

Returns `true` if the given `$callback` returns true for every item. If `$callback` is a string or an array, regard it as a validation rule.

```php
collect(['foo', 'foo'])->validate(function ($item) {
   return $item === 'foo';
}); // returns true


collect(['sebastian@spatie.be', 'bla'])->validate('email'); // returns false
collect(['sebastian@spatie.be', 'freek@spatie.be'])->validate('email'); // returns true
```

### `withSize`

Create a new collection with the specified amount of items.

```php
Collection::withSize(1)->toArray(); // return [1];
Collection::withSize(5)->toArray(); // return [1,2,3,4,5];
```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## About Spatie
Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
