<?php


it('will not execute the callable in catch when no exception was thrown', function () {
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->map(function ($letter) {
            return strtoupper($letter);
        })
        ->catch(function (Exception $exception) {
            $this->fail('caught unexpected exception: '.$exception->getMessage());
        });

    expect($collection->toArray())->toEqual(['A', 'B', 'C', 1, 2, 3]);
});

test('the catch method will handle a thrown exception', function () {
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->map(function ($letter) {
            throw new Exception('a catchable collection exception');
        })
        ->catch(function (Exception $exception) {
            expect($exception->getMessage())->toEqual('a catchable collection exception');
        });

    expect($collection->toArray())->toEqual(['a', 'b', 'c', 1, 2, 3]);
});

test('the catch method will catch exception of the right type', function () {
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->each(function () {
            throw new InvalidArgumentException('an exception thrown by each');
        })
        ->catch(function (InvalidArgumentException $exception) {
            expect($exception->getMessage())->toEqual('an exception thrown by each');
        }, function (UnexpectedValueException $exception) {
            $this->fail('the incorrect exception was caught');
        });

    expect($collection->toArray())->toEqual(['a', 'b', 'c', 1, 2, 3]);
});

test('the catch method will not handle unrelated exceptions', function () {
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

    expect($collection->toArray())->toEqual(['a', 'b', 'c', 1, 2, 3]);
});

test('when no typehint is used the catch method will catch all exceptions', function () {
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->map(function ($letter) {
            throw new Exception('catch me with no type-hint');
        })
        ->catch(function ($exception) {
            expect($exception->getMessage())->toEqual('catch me with no type-hint');
        });

    expect($collection->toArray())->toEqual(['a', 'b', 'c', 1, 2, 3]);
});

test('when no parameters are given to catch it will catch all exceptions', function () {
    $caught = false;
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->map(function ($letter) {
            throw new Exception('catch me with no parameters to catch');
        })
        ->catch(function () use (&$caught) {
            $caught = true;
        });

    expect($collection->toArray())->toEqual(['a', 'b', 'c', 1, 2, 3]);
    expect($caught)->toBeTrue();
});

test('the catch handle can receive the original collection', function () {
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->map(function ($letter) {
            return strtoupper($letter);
        })
        ->each(function ($letter) {
            throw new Exception('catch me');
        })
        ->catch(function (Exception $exception, $collection) {
            expect($exception->getMessage())->toEqual('catch me');
            expect($collection->toArray())->toEqual(['a', 'b', 'c', 1, 2, 3]);
        });

    expect($collection->toArray())->toEqual(['a', 'b', 'c', 1, 2, 3]);
});

test('the catch handler can return a collection', function () {
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->map(function ($letter) {
            throw new Exception('catch me');
        })
        ->catch(function (Exception $exception, $collection) {
            expect($exception->getMessage())->toEqual('catch me');

            return collect(['d', 'e', 'f']);
        });

    expect($collection->toArray())->toEqual(['d', 'e', 'f']);
});

test('any method after catch will receive the original collection when an exception was caught', function () {
    $collection = collect(['a', 'b', 'c', 1, 2, 3])
        ->try()
        ->map(function ($item) {
            throw new Exception('carry on');
        })
        ->catch(function (Exception $exception) {
            expect($exception->getMessage())->toEqual('carry on');
        })
        ->filter(function ($item) {
            return is_int($item);
        });

    expect($collection->toArray())->toEqual([3 => 1, 2, 3]);
});
