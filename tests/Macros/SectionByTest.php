<?php


use Illuminate\Support\Collection;

it('can section a collection by key', function () {
    $expected = [
        ['Basics', [
            ['name' => 'Lesson 1', 'module' => 'Basics'],
            ['name' => 'Lesson 2', 'module' => 'Basics'],
        ]],
        ['Advanced', [
            ['name' => 'Lesson 3', 'module' => 'Advanced'],
            ['name' => 'Lesson 4', 'module' => 'Advanced'],
        ]],
        ['Basics', [
            ['name' => 'Lesson 5', 'module' => 'Basics'],
        ]],
    ];

    $sections = getDummyCollection()->sectionBy('module');

    expect($sections)->toHaveCount(3);

    foreach ($expected as $i => $section) {
        expect($sections[$i][0])->toEqual($section[0]);
        expect($sections[$i][1]->toArray())->toEqual($section[1]);
    }
});

it('can use custom keys for the section and items', function () {
    $collection = getDummyCollection();

    $sectioned = $collection->sectionBy('module', false, 'section', 'items');

    $expected = [
        [
            'section' => 'Basics',
            'items' => [
                ['name' => 'Lesson 1', 'module' => 'Basics'],
                ['name' => 'Lesson 2', 'module' => 'Basics'],
            ],
        ],
        [
            'section' => 'Advanced',
            'items' => [
                ['name' => 'Lesson 3', 'module' => 'Advanced'],
                ['name' => 'Lesson 4', 'module' => 'Advanced'],
            ],
        ],
        [
            'section' => 'Basics',
            'items' => [
                ['name' => 'Lesson 5', 'module' => 'Basics'],
            ],
        ],
    ];

    expect($sectioned->map(function ($section) {
        $section['items'] = $section['items']->toArray();

        return $section;
    })->toArray())->toEqual($expected);
});

it('can preserve keys', function () {
    $collection = getDummyCollection();

    $sectioned = $collection->sectionBy('module', true, 'module', 'items');

    $expected = [
        [
            'module' => 'Basics',
            'items' => [
                'lesson1' => ['name' => 'Lesson 1', 'module' => 'Basics'],
                'lesson2' => ['name' => 'Lesson 2', 'module' => 'Basics'],
            ],
        ],
        [
            'module' => 'Advanced',
            'items' => [
                'lesson3' => ['name' => 'Lesson 3', 'module' => 'Advanced'],
                'lesson4' => ['name' => 'Lesson 4', 'module' => 'Advanced'],
            ],
        ],
        [
            'module' => 'Basics',
            'items' => [
                'lesson5' => ['name' => 'Lesson 5', 'module' => 'Basics'],
            ],
        ],
    ];

    expect($sectioned->map(function ($section) {
        $section['items'] = $section['items']->toArray();

        return $section;
    })->toArray())->toEqual($expected);
});

function getDummyCollection() : Collection
{
    return Collection::make([
        'lesson1' => ['name' => 'Lesson 1', 'module' => 'Basics'],
        'lesson2' => ['name' => 'Lesson 2', 'module' => 'Basics'],
        'lesson3' => ['name' => 'Lesson 3', 'module' => 'Advanced'],
        'lesson4' => ['name' => 'Lesson 4', 'module' => 'Advanced'],
        'lesson5' => ['name' => 'Lesson 5', 'module' => 'Basics'],
    ]);
}
