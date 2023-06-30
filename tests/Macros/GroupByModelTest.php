<?php


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

it('can group a collection by a model with a callable', function () {
    [$model1, $model2, $collection] = getDummies();

    $expected = [
        [$model1, [
            ['model' => $model1, 'foo' => 'bar'],
            ['model' => $model1, 'foo' => 'baz'],
        ]],
        [$model2, [
            ['model' => $model2, 'foo' => 'qux'],
        ]],
    ];

    $grouped = $collection->groupByModel(function ($item) {
        return $item['model'];
    });

    expect($grouped)->toHaveCount(2);

    foreach ($expected as $i => $group) {
        expect($grouped[$i][0])->toEqual($group[0]);
        expect($grouped[$i][1]->toArray())->toEqual($group[1]);
    }
});

it('can group a collection by a model with a callable and custom key names', function () {
    [$model1, $model2, $collection] = getDummies();

    $grouped = $collection->groupByModel(function ($item) {
        return $item['model'];
    }, false, 'myKey', 'items');

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

    expect($grouped->map(function ($group) {
        $group['items'] = $group['items']->toArray();

        return $group;
    })->toArray())->toEqual($expected);
});

it('can group a collection by a model with a key', function () {
    [$model1, $model2, $collection] = getDummies();

    $grouped = $collection->groupByModel('model');

    $expected = [
        [$model1, [
            ['model' => $model1, 'foo' => 'bar'],
            ['model' => $model1, 'foo' => 'baz'],
        ]],
        [$model2, [
            ['model' => $model2, 'foo' => 'qux'],
        ]],
    ];

    expect($grouped)->toHaveCount(2);

    foreach ($expected as $i => $group) {
        expect($grouped[$i][0])->toEqual($group[0]);
        expect($grouped[$i][1]->toArray())->toEqual($group[1]);
    }
});

it('can group a collection by a model with a key and custom key names', function () {
    [$model1, $model2, $collection] = getDummies();

    $grouped = $collection->groupByModel('model', false, 'myKey', 'items');

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

    expect($grouped->map(function ($group) {
        $group['items'] = $group['items']->toArray();

        return $group;
    })->toArray())->toEqual($expected);
});

it('can group a collection by a model with a key and a custom items key', function () {
    [$model1, $model2, $collection] = getDummies();

    $grouped = $collection->groupByModel('model', false, 'model', 'myItems');

    $expected = [
        [
            'model' => $model1,
            'myItems' => [
                ['model' => $model1, 'foo' => 'bar'],
                ['model' => $model1, 'foo' => 'baz'],
            ],
        ],
        [
            'model' => $model2,
            'myItems' => [
                ['model' => $model2, 'foo' => 'qux'],
            ],
        ],
    ];

    expect($grouped->map(function ($group) {
        $group['myItems'] = $group['myItems']->toArray();

        return $group;
    })->toArray())->toEqual($expected);
});

it('can group a collection by a model and preserve keys', function () {
    [$model1, $model2, $collection] = getDummies();

    $grouped = $collection->groupByModel('model', true, 'model', 'items');

    $expected = [
        [
            'model' => $model1,
            'items' => [
                'dummy1' => ['model' => $model1, 'foo' => 'bar'],
                'dummy2' => ['model' => $model1, 'foo' => 'baz'],
            ],
        ],
        [
            'model' => $model2,
            'items' => [
                'dummy3' => ['model' => $model2, 'foo' => 'qux'],
            ],
        ],
    ];

    expect($grouped->map(function ($group) {
        $group['items'] = $group['items']->toArray();

        return $group;
    })->toArray())->toEqual($expected);
});

function getDummies(): array
{
    $model1 = Mockery::mock(Model::class);
    $model1->shouldReceive('getKey')->andReturn(1);

    $model2 = Mockery::mock(Model::class);
    $model2->shouldReceive('getKey')->andReturn(2);

    $collection = Collection::make([
        'dummy1' => ['model' => $model1, 'foo' => 'bar'],
        'dummy2' => ['model' => $model1, 'foo' => 'baz'],
        'dummy3' => ['model' => $model2, 'foo' => 'qux'],
    ]);

    return [$model1, $model2, $collection];
}
