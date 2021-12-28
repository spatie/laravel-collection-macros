<?php

namespace Spatie\CollectionMacros\Macros;

use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionProperty;
use Spatie\CollectionMacros\Exceptions\CollectionItemNotSetable;

class Set
{
    public function __invoke(?array $defaultItems = null)
    {
        $instance = $this;

        return function ($key, $value, $items = null, $depth = 0) use ($defaultItems, $instance) {

            $items ??= $defaultItems ?? $this->items;

            $this->items = $instance->run($key, $value, $items, $depth);

            return $this;
        };
    }

    /**
     * @throws CollectionItemNotSetable
     */
    public function run($key, $value, $items, $depth = 0): array
    {
        $instance = $this;

        $path = explode('.', $key);

        $parts = count($path);

        // Last part of the path
        if ($parts === 1) {
            $items[$path[0]] = $value;

            return $items;
        }

        foreach ($path as $pathKey => $pathItem) {
            
            unset($path[$pathKey]);

            if (! $item ??= $items[$pathItem]) {
                return $items;
            }

            if (is_array($item)) {
                Arr::set($items, $key, $value);

                return $items;
            }

            if ($item instanceof Arrayable) {
                $data = $item->toArray();

                Arr::set($data, implode('.', $path), $value);

                foreach ($item->getAttributes() as $dataKey => $dataValue) {
                    $currentPath = $path;

                    if (($key = array_search($dataKey, $currentPath)) !== false) {
                        unset($currentPath[$key]);
                    }

                    if (is_array($dataValue)) {
                        $item->$dataKey = $data[$dataKey];

                        continue;
                    }

                    if ($dataValue instanceof Arrayable) {
                        $result = $instance($dataValue->toArray())(
                            key: implode('.', $currentPath),
                            value: $value,
                            depth: $depth + 1,
                        );

                        foreach ($result->items as $resultKey => $resultValue) {
                            $dataValue[$resultKey] = $resultValue;
                        }

                        break;
                    }
                }

                return $items;
            }

            if ($item instanceof \StdClass
                || is_object($item)
            ) {
                // Retrieve the StdClass attributes
                $values = [];
                foreach ($item as $itemKey => $itemValue) {
                    $values[$itemKey] = $itemValue;
                }

                $result = $instance($values)(
                    key: implode('.', $path),
                    value: $value,
                    depth: $depth + 1,
                );

                foreach ($result->items as $resultKey => $resultValue) {
                    $item->$resultKey = $resultValue;
                }

                if ($depth === 1) {
                    $items[$pathItem] = $item;
                }

                return $items;
            }

            if (is_array($item)) {
                Arr::set($items, $key, $value);

                return $items;
            }

            throw new CollectionItemNotSetable(sprintf(
                'Model %s is not %s',
                get_class($item),
                Arrayable::class,
            ));
        }

        return $items;
    }
}
