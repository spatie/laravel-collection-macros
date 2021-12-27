<?php

namespace Spatie\CollectionMacros\Macros;

use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Exceptions\CollectionItemNotSetable;

class Set
{
    public function __invoke(?array $defaultItems = null)
    {
        $instance = $this;

        return function ($key, $value, $items = null) use ($defaultItems, $instance) {

            $items ??= $defaultItems ?? $this->items;

            $this->items = $instance->run($key, $value, $items);

            return $this;
        };
    }

    /**
     * @throws CollectionItemNotSetable
     */
    public function run($key, $value, $items): array
    {
        $instance = $this;

        $path = explode('.', $key);
        $breadcrumb = [];

        $parts = count($path);

        // Last part of the path
        if ($parts === 1) {
            $items[$path[0]] = $value;

            return $items;
        }

        foreach ($path as $pathKey => $pathItem) {
            $breadcrumb[] = $pathItem;

            unset($path[$pathKey]);

            if (! $item ??= $items[$pathItem]) {
                return $items;
            }

            if (count($path) === 1) {
                Arr::set($items, $key, $value);

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
                            implode('.', $currentPath),
                            $value
                        );

                        foreach ($result->items as $resultKey => $resultValue) {
                            $dataValue[$resultKey] = $resultValue;
                        }

                        break;
                    }
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
