<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Mockery;

class GroupByModelTest extends TestCase
{
    /** @test */
    public function it_can_group_a_collection_by_an_model()
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

        $grouped = $collection->groupByModel(function ($item) {
            return $item['model'];
        }, 'model');

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
}
