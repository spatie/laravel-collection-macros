# Changelog

All notable changes to `laravel-collection-macros` will be documented in this file

## 3.3.2 - 2017-10-30
- Fixed `transpose` when using an empty array
- Fixed `transpose` when using an `Arrayable`

## 3.3.1 - 2017-10-24
- Fixed `transpose` when using a single-row matrix

## 3.3.0 - 2017-10-17
- Added `at`

## 3.2.0 - 2017-10-11
- Added `rotate`

## 3.1.0 - 2017-09-28
- Added `filterMap`

## 3.0.0 - 2017-08-30
- Added support for Laravel 5.5, removed support for older versions
- Added `glob` macro
- Removed `dd` and `dump` macros
- Changed parameter order for `groupByModel` and `sectionBy`

## 2.7.0 - 2017-08-25
- Add `$itemsKey` and `$preserveKeys` parameters to `groupByModel`

## 2.6.0 - 2017-08-22

- Added `tail`, `eachCons`, `sliceBefore` and `chunkBy`

## 2.5.0 - 2017-08-03
- Added customization options for `sectionBy`

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

## 2.0.0 - 2017-01-24

**DO NOT USE, THIS RELEASE WAS WRONGLY TAGGED**

## 1.5.1 - 2016-01-24
- fixed tests

## 1.5.0 - 2016-11-29
- added `partition` method

## 1.4.4 - 2016-09-01
- `split` doesn't throw an error anymore when trying to split an empty collection

## 1.4.3 - 2016-08-30
- `version_compare` fix in 5.3 changes

## 1.4.2 - 2016-08-23
- updated for Laravel 5.3

## 1.4.1 - 2016-08-20

- maintenance release to kickstart Packagist after `composer.json` error

## 1.4.0 - 2016-08-20

- add `dump` macro

## 1.3.1 - 2016-08-16

- refactored `transpose` macro. It will throw an exception when invalid input is given and it'll return a collection of collections.

## 1.3.0 - 2016-08-12

- added `transpose` macro

## 1.2.0 - 2016-08-11

- added `assoc` and `toAssoc` macros

## 1.1.0 - 2016-08-10

- the collection will be passed to the callbacks of `ifAny` and `ifEmpty`

## 1.0.0 - 2016-08-09

- initial release
