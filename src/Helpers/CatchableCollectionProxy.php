<?php

namespace Spatie\CollectionMacros\Helpers;

use Exception;
use Illuminate\Support\Enumerable;
use ReflectionFunction;

/**
 * @mixin \Illuminate\Support\Enumerable
 */
class CatchableCollectionProxy
{
    /** @var \Illuminate\Support\Enumerable */
    protected $collection;

    /** @var array */
    protected $calledMethods = [];

    public function __construct(Enumerable $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param  string  $method
     * @param  array  $parameters
     *
     * @return $this
     */
    public function __call($method, $parameters)
    {
        $this->calledMethods[] = ['name' => $method, 'parameters' => $parameters];

        return $this;
    }

    /**
     * @param \Closure[] $handlers
     *
     * @return \Illuminate\Support\Enumerable
     * @throws \Exception
     */
    public function catch(...$handlers)
    {
        $originalCollection = $this->collection;

        try {
            foreach ($this->calledMethods as $calledMethod) {
                $this->collection = $this->collection->{$calledMethod['name']}(...$calledMethod['parameters']);
            }
        } catch (Exception $exception) {
            foreach ($handlers as $callable) {
                $type = $this->exceptionType($callable);
                if ($exception instanceof $type) {
                    return $callable($exception, $originalCollection) ?? $originalCollection;
                }
            }

            throw $exception;
        }

        return $this->collection;
    }

    private function exceptionType($callable)
    {
        $reflection = new ReflectionFunction($callable);

        if (empty($reflection->getParameters())) {
            return Exception::class;
        }

        return optional($reflection->getParameters()[0]->getType())->getName() ?? Exception::class;
    }
}
