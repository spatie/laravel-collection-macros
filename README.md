# A set of useful Laravel collection macros

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/laravel-collection-macros/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-collection-macros)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/659f58d2-5324-4bb9-b2ff-8873c7a82d10.svg?style=flat-square)](https://insight.sensiolabs.com/projects/659f58d2-5324-4bb9-b2ff-8873c7a82d10)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-collection-macros.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-collection-macros)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-collection-macros.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-collection-macros)

This repository contains some useful macro collections.

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

### `groupByModel`

Similar to `groupBy`, but groups the collection by an Eloquent model. Since the key is an object instead of an integer or string, the results are divided into separate arrays.

```php
$collection = Collection::make([
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
collect()->ifAny(function() { // empty collection so this won't get called
   echo 'Hello';
});

collect([1, 2, 3])->ifAny(function() { // non-empty collection so this will get called
   echo 'Hello';
});
```

### `ifEmpty`

Executes the passed callable if the collection is empty. The entire collection will be returned.

```php
collect()->ifEmpty(function() { // empty collection so this will called
   echo 'Hello';
});

collect([1, 2, 3])->ifEmpty(function() { // non-empty collection so this won't get called
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

### `range`

Creates a new collection instance with a range of numbers. This functions accepts the same parameters as PHP's standard `range` function.

```php
collect()->range(1, 3)->toArray(); //returns [1,2,3]
```

### `split`

Splits a collection into a the given number of groups.

```php
$collection = collect(['a', 'b', 'c', 'd', 'e', 'f'])->split(3);

$collection->count(); // returns 3

$collection->first(); // returns a collection with 'a' and 'b';
$collection->last(); // returns a collection with 'e' and 'f';
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
