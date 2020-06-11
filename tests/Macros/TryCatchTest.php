<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Exception;
use InvalidArgumentException;
use Spatie\CollectionMacros\Test\TestCase;
use UnexpectedValueException;

class TryCatchTest extends TestCase
{
    public function testCatchableCollection()
    {
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($letter) {
                return strtoupper($letter);
            })
            ->catch(function (Exception $exception) {
                $this->fail('caught unexpected exception: '.$exception->getMessage());
            });

        $this->assertEquals(['A', 'B', 'C', 1, 2, 3], $collection->toArray());
    }

    public function testCatchableCollectionHandlesException()
    {
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($letter) {
                throw new Exception('a catchable collection exception');
            })
            ->catch(function (Exception $exception) {
                $this->assertEquals('a catchable collection exception', $exception->getMessage());
            });

        $this->assertEquals(['a', 'b', 'c', 1, 2, 3], $collection->toArray());
    }

    public function testCatchableCollectionHandlesCorrectException()
    {
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->each(function () {
                throw new InvalidArgumentException('an exception thrown by each');
            })
            ->catch(function (InvalidArgumentException $exception) {
                $this->assertEquals('an exception thrown by each', $exception->getMessage());
            }, function (UnexpectedValueException $exception) {
                $this->fail('the incorrect exception was caught');
            });

        $this->assertEquals(['a', 'b', 'c', 1, 2, 3], $collection->toArray());
    }

    public function testCatchableCollectionRethrowsUnhandledException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('rethrow me');

        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($letter) {
                throw new Exception('rethrow me');
            })
            ->catch(function (InvalidArgumentException $exception) {
                $this->fail('the incorrect exception was caught');
            });

        $this->assertEquals(['a', 'b', 'c', 1, 2, 3], $collection->toArray());
    }

    public function testCatchableCollectionDefaultsToCatchAll()
    {
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($letter) {
                throw new Exception('catch me with no type-hint');
            })
            ->catch(function ($exception) {
                $this->assertEquals('catch me with no type-hint', $exception->getMessage());
            });

        $this->assertEquals(['a', 'b', 'c', 1, 2, 3], $collection->toArray());
    }

    public function testCatchableCollectionDoesNotRequireParameters()
    {
        $caught = false;
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($letter) {
                throw new Exception('catch me with no parameters to catch');
            })
            ->catch(function () use (&$caught) {
                $caught = true;
            });

        $this->assertEquals(['a', 'b', 'c', 1, 2, 3], $collection->toArray());
        $this->assertTrue($caught);
    }

    public function testCatchableCollectionAllowsHandlerToReceiveOriginalCollection()
    {
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($letter) {
                return strtoupper($letter);
            })
            ->each(function ($letter) {
                throw new Exception('catch me');
            })
            ->catch(function (Exception $exception, $collection) {
                $this->assertEquals('catch me', $exception->getMessage());
                $this->assertEquals(['a', 'b', 'c', 1, 2, 3], $collection->toArray());
            });

        $this->assertEquals(['a', 'b', 'c', 1, 2, 3], $collection->toArray());
    }

    public function testCatchableCollectionAllowsHandlerToReturnCollection()
    {
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($letter) {
                throw new Exception('catch me');
            })
            ->catch(function (Exception $exception, $collection) {
                $this->assertEquals('catch me', $exception->getMessage());

                return collect(['d', 'e', 'f']);
            });

        $this->assertEquals(['d', 'e', 'f'], $collection->toArray());
    }

    public function testCatchableCollectionContinuesWithOriginalCollectionAfterException()
    {
        $collection = collect(['a', 'b', 'c', 1, 2, 3])
            ->try()
            ->map(function ($item) {
                throw new Exception('carry on');
            })
            ->catch(function (Exception $exception) {
                $this->assertEquals('carry on', $exception->getMessage());
            })
            ->filter(function ($item) {
                return is_int($item);
            });

        $this->assertEquals([3 => 1, 2, 3], $collection->toArray());
    }
}
