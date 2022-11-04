<?php

use Spatie\CollectionMacros\Test\IntegrationTestCase;
use Spatie\CollectionMacros\Test\TestCase;

$integratonTestCaseFiles = ['SimplePaginateTest.php'];

$simpleTestCaseTests =  collect(scandir(__DIR__ . '/Macros'))
    ->filter(fn (string $item) => str($item)->endsWith('Test.php'))
    ->reject(fn (string $item) => in_array($item, $integratonTestCaseFiles))
    ->map(fn (string $item) => './Macros/' . $item)
    ->toArray();

$integratonTestCaseFiles = collect($integratonTestCaseFiles)
    ->map(fn (string $item) => './Macros/' . $item)
    ->toArray();

uses(TestCase::class)->in(...$simpleTestCaseTests);
uses(IntegrationTestCase::class)->in(...$integratonTestCaseFiles);
