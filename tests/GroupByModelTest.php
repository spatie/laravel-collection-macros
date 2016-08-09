<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Mockery;

class GroupByModelTest extends TestCase
{
    /** @test */
    public function it_can_group_a_collection_by_a_model_with_a_callable()
    {
        list($model1, $model2, $collection) = $this->getDummies();

        $grouped = $collection->groupByModel(function ($item) {
            return $item['model'];
        });

        $expected = [
            [
                'model' => $model1,
                'items' => [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'model' => $model2,
                'items' => [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['items'] = $group['items']->toArray();
            return $group;
        })->toArray());
    }

    /** @test */
    public function it_can_group_a_collection_by_a_model_with_a_callable_and_a_custom_key_name()
    {
        list($model1, $model2, $collection) = $this->getDummies();

        $grouped = $collection->groupByModel(function ($item) {
            return $item['model'];
        }, 'myKey');

        $expected = [
            [
                'myKey' => $model1,
                'items' => [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'myKey' => $model2,
                'items' => [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['items'] = $group['items']->toArray();
            return $group;
        })->toArray());
    }

    /** @test */
    public function it_can_group_a_collection_by_a_model_with_a_key()
    {
        list($model1, $model2, $collection) = $this->getDummies();

        $grouped = $collection->groupByModel('model');

        $expected = [
            [
                'model' => $model1,
                'items' => [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'model' => $model2,
                'items' => [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['items'] = $group['items']->toArray();
            return $group;
        })->toArray());
    }

    /** @test */
    public function it_can_group_a_collection_by_a_model_with_a_key_and_a_custom_key_name()
    {
        list($model1, $model2, $collection) = $this->getDummies();

        $grouped = $collection->groupByModel('model', 'myKey');

        $expected = [
            [
                'myKey' => $model1,
                'items' => [
                    ['model' => $model1, 'foo' => 'bar'],
                    ['model' => $model1, 'foo' => 'baz'],
                ],
            ],
            [
                'myKey' => $model2,
                'items' => [
                    ['model' => $model2, 'foo' => 'qux'],
                ],
            ],
        ];

        $this->assertEquals($expected, $grouped->map(function ($group) {
            $group['items'] = $group['items']->toArray();
            return $group;
        })->toArray());
    }

    protected function getDummies(): array
    {
        $model1 = Mockery::mock(Model::class);
        $model1->shouldReceive('getKey')->andReturn(1);

        $model2 = Mockery::mock(Model::class);
        $model2->shouldReceive('getKey')->andReturn(2);

        $collection = Collection::make([
            ['model' => $model1, 'foo' => 'bar'],
            ['model' => $model1, 'foo' => 'baz'],
            ['model' => $model2, 'foo' => 'qux'],
        ]);

        return [$model1, $model2, $collection];
    }
}
