# A set of useful Laravel collection macros

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)
![Run tests](https://github.com/spatie/laravel-collection-macros/workflows/Run%20tests/badge.svg)
![Check & fix styling](https://github.com/spatie/laravel-collection-macros/workflows/Check%20&%20fix%20styling/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)

This repository contains some useful collection macros.

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-collection-macros.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-collection-macros)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can pull in the package via composer:

``` bash
composer require spatie/laravel-collection-macros
```

The package will automatically register itself.

## Macros

- [`after`](#after)
- [`at`](#at)
    - [`second`](#second)
    - [`third`](#third)
    - [`fourth`](#fourth)
    - [`fifth`](#fifth)
    - [`sixth`](#sixth)
    - [`seventh`](#seventh)
    - [`eighth`](#eighth)
    - [`ninth`](#ninth)
    - [`tenth`](#tenth)
    - [`getNth`](#getNth)
- [`before`](#before)
- [`catch`](#catch)
- [`chunkBy`](#chunkby)
- [`collectBy`](#collectBy)
- [`containsAny`](#containsAny)
- [`containsAll`](#containsAll)
- [`eachCons`](#eachcons)
- [`extract`](#extract)
- [`filterMap`](#filtermap)
- [`firstOrFail`](#firstorfail)
- [`firstOrPush`](#firstorpush)
- [`fromPairs`](#frompairs)
- [`getCaseInsensitive`](#getcaseinsensitive)
- [`glob`](#glob)
- [`groupByModel`](#groupbymodel)
- [`hasCaseInsensitive`](#hascaseinsensitive)
- [`head`](#head)
- [`if`](#if)
- [`ifAny`](#ifany)
- [`ifEmpty`](#ifempty)
- [`insertAfter`](#insertafter)
- [`insertAfterKey`](#insertafterkey)
- [`insertAt`](#insertat)
- [`insertBefore`](#insertbefore)
- [`insertBeforeKey`](#insertbeforekey)
- [`none`](#none)
- [`paginate`](#paginate)
- [`parallelMap`](#parallelmap)
- [`path`](#path)
- [`pluckMany`](#pluckmany)
- [`pluckManyValues`](#pluckmanyvalues)
- [`pluckToArray`](#plucktoarray)
- [`prioritize`](#prioritize)
- [`recursive`](#recursive)
- [`rotate`](#rotate)
- [`sectionBy`](#sectionby)
- [`simplePaginate`](#simplepaginate)
- [`sliceBefore`](#slicebefore)
- [`tail`](#tail)
- [`try`](#try)
- [`toPairs`](#topairs)
- [`transpose`](#transpose)
- [`validate`](#validate)
- [`weightedRandom`](#weightedRandom)
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

### `second`
Retrieve item at the second index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->second(); // 2
```

### `third`
Retrieve item at the third index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->third(); // 3
```

### `fourth`
Retrieve item at the fourth index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->fourth(); // 4
```

### `fifth`
Retrieve item at the fifth index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->fifth(); // 5
```

### `sixth`
Retrieve item at the sixth index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->sixth(); // 6
```

### `seventh`
Retrieve item at the seventh index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->seventh(); // 7
```

### `eighth`
Retrieve item at the eighth index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->eighth(); // 8
```

### `ninth`
Retrieve item at the ninth index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->ninth(); // 9
```

### `tenth`
Retrieve item at the tenth index.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$data->tenth(); // 10
```

### `getNth`
Retrieve item at the nth item.

```php
$data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

$data->getNth(11); // 11
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

### `catch`

See [`Try`](#try)

### `chunkBy`

Chunks the values from a collection into groups as long the given callback is true. If the optional parameter `$preserveKeys` as `true` is passed, it will preserve the original keys.

```php
collect(['A', 'A', 'B', 'A'])->chunkBy(function($item) {
    return $item == 'A';
}); // return Collection([['A', 'A'],['B'], ['A']])
```

### `collectBy`

Get an item at a given key, and collect it.

```php
$collection = collect([
    'foo' => [1, 2, 3],
    'bar' => [4, 5, 6],
]);

$collection->collectBy('foo'); // Collection([1, 2, 3])
```

You can also pass a second parameter to be used as a fallback.

```php
$collection = collect([
    'foo' => [1, 2, 3],
    'bar' => [4, 5, 6],
]);

$collection->collectBy('baz', ['Nope']); // Collection(['Nope'])
```

### `containsAny`

Will return `true` if one or more of the given values exist in the collection.

```php
$collection = collect(['a', 'b', 'c']);

$collection->containsAny(['b', 'c', 'd']); // returns true
$collection->containsAny(['c', 'd', 'e']); // returns true
$collection->containsAny(['d', 'e', 'f']); // returns false
$collection->containsAny([]); // returns false
```

### `containsAll`

Will return `true` if all given values exist in the collection.

```php
$collection = collect(['a', 'b', 'c']);

$collection->containsAll(['b', 'c',]); // returns true
$collection->containsAll(['c', 'd']); // returns false
$collection->containsAll(['d', 'e']); // returns false
$collection->containsAll([]); // returns true
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

### `firstOrFail`

Get the first item. Throws `Spatie\CollectionMacros\Exceptions\CollectionItemNotFound` if the item was not found.

```php
$collection = collect([1, 2, 3, 4, 5, 6])->firstOrFail();

$collection->toArray(); // returns [1]

collect([])->firstOrFail(); // throws Spatie\CollectionMacros\Exceptions\CollectionItemNotFound
```

### `firstOrPush`

Retrieve the first item using the callable given as the first parameter. If no value exists, push the value of the second
parameter into the collection. You can pass a callable as the second parameter.

This method is really useful when dealing with cached class properties, where you want to store a value retrieved from an API or computationally expensive function in a collection to be used multiple times.

```php
$collection = collect([1, 2, 3])->firstOrPush(fn($item) => $item === 4, 4);

$collection->toArray(); // returns [1, 2, 3, 4]
```

Occasionally, you'll want to specify the target collection to be pushed to. You may pass this as a third parameter.

```php
$collection = collect([1, 2, 3]);
$collection->filter()->firstOrPush(fn($item) => $item === 4, 4, $collection);

$collection->toArray(); // returns [1, 2, 3, 4]
```

### `fromPairs`

Transform a collection into an associative array form collection item.

```php
$collection = collect([['a', 'b'], ['c', 'd'], ['e', 'f']])->fromPairs();

$collection->toArray(); // returns ['a' => 'b', 'c' => 'd', 'e' => 'f']
```

### `getCaseInsensitive`

Get the value of a given key. 

If the key is a string, we'll search for the key using a case-insensitive comparison.

```php
$collection = collect([
    'foo' => 'bar',
]);

$collection->getCaseInsensitive('Foo'); // returns 'bar';
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

### `hasCaseInsensitive`

Determine if the collection contains a key with a given name.

If $key is a string, we'll search for the key using a case-insensitive comparison.

```php
$collection = collect([
    'foo' => 'bar',
]);

$collection->hasCaseInsensitive('Foo'); // returns true;
```

### `head`

Retrieves first item from the collection.

```php
$collection = collect([1,2,3]);

$collection->head(); // return 1

$collection = collect([]);

$collection->head(); // return null
```

### `if`

The `if` macro can help  branch collection chains. This is the signature of this macro: 

```php
if(mixed $if, mixed $then = null, mixed $else = null): mixed
```

`$if`, `$then` and `$else` can be any type. If a closure is passed to any of these parameters, then that closure will be executed and the macro will use its results.

When `$if` returns a truthy value, then `$then` will be returned, otherwise `$else` will be returned.

Here are some examples:

```php
collect()->if(true, then: true, else: false); // returns true
collect()->if(false, then: true, else: false); // returns false
```

When a closure is passed to `$if`, `$then` or `$else`, the entire collection will be passed as an argument to that closure.

```php
// the `then` closure will be executed
// the first element of the returned collection now contains "THIS IS THE VALUE"
$collection = collect(['this is a value'])
    ->if(
        fn(Collection $collection) => $collection->contains('this is a value'),
        then: fn(Collection $collection) => $collection->map(fn(string $item) => strtoupper($item)),
        else: fn(Collection $collection) => $collection->map(fn(string $item) => Str::kebab($item))
    );

// the `else` closure will be executed
// the first element of the returned collection now contains "this-is-another-value"
$collection = collect(['this is another value'])
    ->if(
        fn(Collection $collection) => $collection->contains('this is a value'),
        then: fn(Collection $collection) => $collection->map(fn(string $item) => strtoupper($item)),
        else: fn(Collection $collection) => $collection->map(fn(string $item) => Str::kebab($item))
    );
```

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

### `insertAfter`

Inserts an item after the first occurrence of a given item and returns the updated Collection instance.
Optionally a key can be given.

```php
collect(['zero', 'two', 'three'])->insertAfter('zero', 'one');
// Collection contains ['zero', 'one', 'two', 'three']

collect(['zero' => 0, 'two' => 2, 'three' => 3]->insertAfter(0, 5, 'five');
// Collection contains ['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]
```

### `insertAfterKey`

Inserts an item after a given key and returns the updated Collection instance.
Optionally a key for the new item can be given.

```php
collect(['zero', 'two', 'three'])->insertAfterKey(0, 'one');
// Collection contains ['zero', 'one', 'two', 'three']

collect(['zero' => 0, 'two' => 2, 'three' => 3]->insertAfterKey('zero', 5, 'five');
// Collection contains ['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]
```

### `insertAt`

Inserts an item at a given index and returns the updated Collection instance. Optionally a key can be given.

```php
collect(['zero', 'two', 'three'])->insertAt(1, 'one');
// Collection contains ['zero', 'one', 'two', 'three']

collect(['zero' => 0, 'two' => 2, 'three' => 3]->insertAt(1, 5, 'five');
// Collection contains ['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]
```

### `insertBefore`

Inserts an item before the first occurrence of a given item and returns the updated Collection instance.
Optionally a key can be given.

```php
collect(['zero', 'two', 'three'])->insertBefore('two', 'one');
// Collection contains ['zero', 'one', 'two', 'three']

collect(['zero' => 0, 'two' => 2, 'three' => 3]->insertBefore(2, 5, 'five');
// Collection contains ['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]
```

### `insertBeforeKey`

Inserts an item before a given key and returns the updated Collection instance.
Optionally a key for the new item can be given.

```php
collect(['zero', 'two', 'three'])->insertBeforeKey(1, 'one');
// Collection contains ['zero', 'one', 'two', 'three']

collect(['zero' => 0, 'two' => 2, 'three' => 3]->insertBeforeKey('two', 5, 'five');
// Collection contains ['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]
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

Be aware that under the hood some overhead is introduced to make the parallel processing possible. When your `$callable` is only a simple operation it's probably better to use `map` instead. Also keep in mind that `parallelMap` can be memory intensive.

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

### `path`

Returns an item from the collection with multidimensional data using "dot" notation.
Works the same way as native Collection's `pull` method, but without removing an item from the collection.

```php
$collection = new Collection([
    'foo' => [
        'bar' => [
            'baz' => 'value',
        ]
    ]
]);

$collection->path('foo.bar.baz') // 'value'
```

### `pluckMany`

Returns a collection with only the specified keys.

```php
$collection = collect([
    ['a' => 1, 'b' => 10, 'c' => 100],
    ['a' => 2, 'b' => 20, 'c' => 200],
]);

$collection->pluckMany(['a', 'b']);

// returns
// collect([
//     ['a' => 1, 'b' => 10],
//     ['a' => 2, 'b' => 20],
// ]);
```

### `pluckManyValues`

Returns a collection with only the specified keys' values.

```php
$collection = collect([
    ['a' => 1, 'b' => 10, 'c' => 100],
    ['a' => 2, 'b' => 20, 'c' => 200],
]);

$collection->pluckMany(['a', 'b']);

// returns
// collect([
//     [1, 10],
//     [2, 20],
// ]);
```

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

### `prioritize`

Move elements to the start of the collection.

```php
$collection = collect([
    ['id' => 1],
    ['id' => 2],
    ['id' => 3],
]);

$collection
   ->prioritize(function(array $item) {
      return $item['id'] === 2;
   })
   ->pluck('id')
   ->toArray(); // returns [2, 1, 3]
```

### `recursive`

Convert an array and its children to collection using recursion.

```php
collect([
  'item' => [
     'children' => []
  ]   
])->recursive();

// subsequent arrays are now collections
```

In some cases you may not want to turn all the children into a collection. You can convert only to a certain depth by providing a number to the recursive method.

```php
collect([
  'item' => [
     'children' => [
        'one' => [1],
        'two' => [2]
     ]
  ]   
])->recursive(1); // Collection(['item' => Collection(['children' => ['one' => [1], 'two' => [2]]])])
```

This can be useful when you know that at a certain depth it'll not be necessary or that it may break your code.

```php
collect([
  'item' => [
     'children' => [
        'one' => [1],
        'two' => [2]
     ]
  ]   
])
  ->recursive(1)
  ->map(function ($item) {
    return $item->map(function ($children) {
      return $children->mapInto(Model::class);
    });
  }); // Collection(['item' => Collection(['children' => ['one' => Model(), 'two' => Model()]])])

// If we do not pass a max depth we will get the error "Argument #1 ($attributes) must be of type array"
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

Extract the tail from a collection. So everything except the first element. It's a shorthand for `slice(1)->values()`, but nevertheless very handy. If the optional parameter `$preserveKeys` as `true` is passed, it will preserve the keys and fallback to `slice(1)`.

```php
collect([1, 2, 3])->tail(); // return collect([2, 3])
```

### `toPairs`

Transform a collection into an array with pairs.

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

### `try`

If any of the methods between `try` and `catch` throw an exception, then the exception can be handled in `catch`.

```php
collect(['a', 'b', 'c', 1, 2, 3])
    ->try()
    ->map(fn ($letter) => strtoupper($letter))
    ->each(function() {
        throw new Exception('Explosions in the sky');
    })
    ->catch(function (Exception $exception) {
        // handle exception here
    })
    ->map(function() {
        // further operations can be done, if the exception wasn't rethrow in the `catch`
    });
```

While the methods are named `try`/`catch` for familiarity with PHP, the collection itself behaves more like a database transaction. So when an exception is thrown, the original collection (before the try) is returned.

You may gain access to the collection within catch by adding a second parameter to your handler. You may also manipulate the collection within catch by returning a value.

```php
$collection = collect(['a', 'b', 'c', 1, 2, 3])
    ->try()
    ->map(function ($item) {
        throw new Exception();
    })
    ->catch(function (Exception $exception, $collection) {
        return collect(['d', 'e', 'f']);
    })
    ->map(function ($item) {
        return strtoupper($item);
    });

// ['D', 'E', 'F']
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

### `weightedRandom`

Returns a random item by a weight. In this example, the item with `a` has the most chance to get picked, and the item with `c` the least.

```php
// pass the field name that should be used as a weight

$randomItem = collect([
    ['value' => 'a', 'weight' => 30],
    ['value' => 'b', 'weight' => 20],
    ['value' => 'c', 'weight' => 10],
])->weightedRandom('weight');
```

Alternatively, you can pass a callable to get the weight.

```php
$randomItem = collect([
    ['value' => 'a', 'weight' => 30],
    ['value' => 'b', 'weight' => 20],
    ['value' => 'c', 'weight' => 10],
])->weightedRandom(function(array $item) {
   return $item['weight'];
});
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

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security

If you've found a bug regarding security please mail [security@spatie.be](mailto:security@spatie.be) instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## About Spatie
Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
