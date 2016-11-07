# A set of useful Laravel collection macros

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/64222176/shield)](https://styleci.io/repos/64222176)
[![Build Status](https://img.shields.io/travis/spatie/laravel-collection-macros/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-collection-macros)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/659f58d2-5324-4bb9-b2ff-8873c7a82d10.svg?style=flat-square)](https://insight.sensiolabs.com/projects/659f58d2-5324-4bb9-b2ff-8873c7a82d10)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-collection-macros.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-collection-macros)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)

This repository contains some useful collection macros.

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

This service provider must be installed.

```php
// config/app.php
'providers' => [
    ...
    Spatie\CollectionMacros\CollectionMacroServiceProvider::class,
];
```


## Usage

These macro's will be added to the `Illuminate\Support\Collection` class.

### `dd`

Dumps the contents of the collection and terminates the script. This macro makes debugging a collection [much easier](https://murze.be/2016/06/debugging-collections/).

```php
collect([1,2,3])->dd();
```

### `dump`

Dumps the given arguments together with the current collection. This macro makes debugging a chain of collection functions much easier.

```php
collect([1,2,3])
    ->dump('original')
    ->map(function(int $number) {
        return $number * 2;
    })
    ->dump('modified')
    ->dd();
```

### `groupByModel`

Similar to `groupBy`, but groups the collection by an Eloquent model. Since the key is an object instead of an integer or string, the results are divided into separate arrays.

```php
$collection = collect([
    ['model' => $model1, 'foo' => 'bar'],
    ['model' => $model1, 'foo' => 'baz'],
    ['model' => $model2, 'foo' => 'qux'],
]);

$collection->groupByModel('model');

// [
//     [
//         'model' => $model1,
//         'items' => [
//             ['model' => $model1, 'foo' => 'bar'],
//             ['model' => $model1, 'foo' => 'baz'],
//         ],
//     ],
//     [
//         'model' => $model2,
//         'items' => [
//             ['model' => $model2, 'foo' => 'qux'],
//         ],
//     ],
// ];
```

You can also use a callable for more flexibility:

```php
$collection->groupByModel(function ($item) {
    return $item['model']
});
```

If you want to specify the model key's name, you can pass it as the second parameter:

```php
$collection->groupByModel('model', 'myModel');

// [
//     [
//         'myModel' => $model1,
//         'items' => [
//             ['model' => $model1, 'foo' => 'bar'],
//             ['model' => $model1, 'foo' => 'baz'],
//         ],
//     ],
//     [
//         'myModel' => $model2,
//         'items' => [
//             ['model' => $model2, 'foo' => 'qux'],
//         ],
//     ],
// ];
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

> Note: When using a callable as argument, ``Collection::none` be`haves differently in Laravel 5.3 and higher. In 5.2, the parameter order is `$key, $value`, and in 5.3+ the parameter order is `$value, $key`. 

### `range`

Creates a new collection instance with a range of numbers. This functions accepts the same parameters as PHP's standard `range` function.

```php
collect()->range(1, 3)->toArray(); //returns [1,2,3]
```

### `split`

Splits a collection into the given number of groups.

```php
$collection = collect(['a', 'b', 'c', 'd', 'e', 'f'])->split(3);

$collection->count(); // returns 3

$collection->first(); // returns a collection with 'a' and 'b';
$collection->last(); // returns a collection with 'e' and 'f';
```

### `pad`

Pads a collection with the given minimum number of items with the specified value.

```php
$collection = collect(['a', 'b', 'c', 'd', 'e', 'f'])->pad(7, 'g');

$collection->count(); // returns 7

$collection->dump(); // dumps ['a', 'b', 'c', 'd', 'e', 'f', 'g']
```

If the collection has more values than the minimum number to pad, then it will not add extra values.

```php
$collection = collect(['a', 'b', 'c', 'd', 'e', 'f'])->pad(3, 'x');

$collection->count(); // returns 6

$collection->dump(); // dumps ['a', 'b', 'c', 'd', 'e', 'f']
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


### `toAssoc`

Transform a collection into an associative array form collection item.

```php
$collection = collect(['a', 'b'], ['c', 'd'], ['e', 'f'])->toAssoc();

$collection->toArray(); // returns ['a' => 'b', 'c' => 'd', 'e' => 'f']
```

### `mapToAssoc`

Transform a collection into an associative array form collection item, allowing you to pass a callback to customize its key and value through a map operation.

```php
$employees = collect([
    [
        'name' => 'John',
        'department' => 'Sales',
        'email' => 'john@example.com',
    ],
    [
        'name' => 'Jane',
        'department' => 'Marketing',
        'email' => 'jane@example.com',
    ],
]);

$employees->mapToAssoc(function ($employee) {
    return [$employee['email'], $employee['name']];
});

$employees->toArray(); // returns ['john@example.com' => 'John', 'jane@example.com' => 'Jane']
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
