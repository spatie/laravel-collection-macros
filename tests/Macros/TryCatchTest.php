<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Exception;
use InvalidArgumentException;
use Spatie\CollectionMacros\Test\TestCase;
use UnexpectedValueException;

class TryCatchTest extends TestCase
{
    /** @test */
    public function it_will_not_execute_the_callable_in_catch_when_no_exception_was_thrown()
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

    /** @test */
    public function the_catch_method_will_handle_a_thrown_exception()
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

    /** @test */
    public function the_catch_method_will_catch_exception_of_the_right_type()
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

    /** @test */
    public function the_catch_method_will_not_handle_unrelated_exceptions()
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

    /** @test */
    public function when_no_typehint_is_used_the_catch_method_will_catch_all_exceptions()
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

    /** @test */
    public function when_no_parameters_are_given_to_catch_it_will_catch_all_exceptions()
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

    /** @test */
    public function the_catch_handle_can_receive_the_original_collection()
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

    /** @test */
    public function the_catch_handler_can_return_a_collection()
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

    /** @test */
    public function any_method_after_catch_will_receive_the_original_collection_when_an_exception_was_caught()
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
