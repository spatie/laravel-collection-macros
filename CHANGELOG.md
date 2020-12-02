# Changelog

All notable changes to `laravel-collection-macros` will be documented in this file

## 7.1.0 - 2020-12-02

- add support for PHP 8

## 7.0.3 - 2020-09-08

- add support for Laravel 8

## 7.0.2 - 2020-07-03

- improve second, third, ... marcros

## 7.0.1 - 2020-06-11

- use registry over file scan + string manipulation (#179)

## 7.0.0 - 2020-06-11

- drop support for Laravel 6
- drop support for PHP 7.3 and below

## 6.2.0 - 2020-06-11

- add `try` and `catch` macros

## 6.1.0 - 2020-03-03

- Laravel 7 support

## 6.0.0 - 2019-09-04

- Laravel 6 support
- Renamed `collect()` macro to `collectBy()` to resolve Laravel 6 compatibility

## 5.0.2 - 2019-0319

- require laravel 5.8.4
- remove `join` method as the same implementation has been added to Laravel

## 5.0.1 - 2019-03-07
- fix `paginate` for pages other than 1

## 5.0.0 - 2019-02-27
- `prioritize` will keep the keys of the original item
- drop support for Laravel 5.7 and below
- drop support for PHP 7.1 and below

## 4.3.2 - 2019-03-07
- fix `paginate` for pages other than 1

## 4.3.1 - 2019-02-27
- add support for Laravel 5.8

## 4.3.0 - 2019-02-25
- add `join` macro

## 4.2.0 - 2018-12-16
- add `head` macro

## 4.1.0 - 2018-11-29
- add methods to get items by human named indexes

## 4.0.1 - 2018-10-19
- `parallels` macro tests fix

## 4.0.0 - 2018-08-28
- `firstOrFail` will return the item instead of a collection
- support for Laravel 5.7
- removed `range` macro

## 3.8.1 - 2018-02-23
- Fixed: maximum function nesting reached error in `eachCons`

## 3.8.0 - 2018-02-08
- Added: Laravel 5.6 compatibility

## 3.7.0 - 2018-01-18
- Added: `pluckToArray`

## 3.6.2 - 2018-01-14
- Fixed: Make `parallelMap` return a new collection

## 3.6.1 - 2018-01-07
- Fixed: Count warning/exception php7.2 in `Transpose`

## 3.6.0 - 2017-12-18
- Added: Allow worker pool of `parallelMap` to be configured

## 3.5.0 - 2017-12-18
- Added: `parallelMap`

## 3.4.0 - 2017-11-13
- Added: `findOrFail`

## 3.3.2 - 2017-10-30
- Fixed: `transpose` when using an empty array
- Fixed: `transpose` when using an `Arrayable`

## 3.3.1 - 2017-10-24
- Fixed: `transpose` when using a single-row matrix

## 3.3.0 - 2017-10-17
- Added: `at`

## 3.2.0 - 2017-10-11
- Added: `rotate`

## 3.1.0 - 2017-09-28
- Added: `filterMap`

## 3.0.0 - 2017-08-30
- Added: support for Laravel 5.5, removed support for older versions
- Added: `glob` macro
- Removed: `dd` and `dump` macros
- Changed: Parameter order for `groupByModel` and `sectionBy`

## 2.7.0 - 2017-08-25
- Added: `$itemsKey` and `$preserveKeys` parameters to `groupByModel`

## 2.6.0 - 2017-08-22

- Added: `tail`, `eachCons`, `sliceBefore` and `chunkBy`

## 2.5.0 - 2017-08-03
- Added: customization options for `sectionBy`

## 2.4.0 - 2017-08-02
- Added: `sectionBy`

## 2.3.1 - 2017-07-11
- Fixed: `extract` now returns an instance of the current collection type

## 2.3.0 - 2017-07-11
- Added: `extract`

## 2.2.0 - 2017-07-04
- Added: `paginate` and `simplePaginate`

## 2.1.0 - 2017-02-10
- Added: `before` and `after`
- Added: `collect`

## 2.0.1 - 2017-01-24

- Added: `toPairs` and `withSize`
- Removed: `split`, `partition` and `mapToAssoc`
- Renamed: `toAssoc` to `fromPairs`

## 1.5.1 - 2016-01-24
- Fixed: Tests

## 1.5.0 - 2016-11-29
- Added: `partition` method

## 1.4.4 - 2016-09-01
- Fixed: `split` doesn't throw an error anymore when trying to split an empty collection

## 1.4.3 - 2016-08-30
- Fixed: `version_compare` fix in 5.3 changes

## 1.4.2 - 2016-08-23
- Added: Laravel 5.3 compatibility

## 1.4.1 - 2016-08-20
- _Maintenance release to kickstart Packagist after `composer.json` error_

## 1.4.0 - 2016-08-20
- Added: `dump` macro

## 1.3.1 - 2016-08-16
- Changed: `transpose` will throw an exception when invalid input is given and it'll return a collection of collections

## 1.3.0 - 2016-08-12
- Added: `transpose` macro

## 1.2.0 - 2016-08-11
- Added: `assoc` and `toAssoc` macros

## 1.1.0 - 2016-08-10
- Changed: The collection will be passed to the callbacks of `ifAny` and `ifEmpty`

## 1.0.0 - 2016-08-09
- Initial release
