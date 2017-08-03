<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class SectionByTest extends TestCase
{
    /** @test */
    public function it_can_section_a_collection_by_key()
    {
        $collection = $this->getDummyCollection();

        $sectioned = $collection->sectionBy('module');

        $expected = [
             [
                 'module' => 'Basics',
                 'items' => [
                      ['name' => 'Lesson 1', 'module' => 'Basics'],
                      ['name' => 'Lesson 2', 'module' => 'Basics'],
                 ],
             ],
             [
                 'module' => 'Advanced',
                 'items' => [
                      ['name' => 'Lesson 3', 'module' => 'Advanced'],
                      ['name' => 'Lesson 4', 'module' => 'Advanced'],
                 ],
             ],
             [
                 'module' => 'Basics',
                 'items' => [
                      ['name' => 'Lesson 5', 'module' => 'Basics'],
                 ],
             ],
         ];

        $this->assertEquals($expected, $sectioned->map(function ($section) {
            $section['items'] = $section['items']->toArray();

            return $section;
        })->toArray());
    }

    /** @test */
    public function it_can_use_a_custom_key_for_section_value()
    {
        $collection = $this->getDummyCollection();

        $sectioned = $collection->sectionBy('module', 'section');

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

        $this->assertEquals($expected, $sectioned->map(function ($section) {
            $section['items'] = $section['items']->toArray();

            return $section;
        })->toArray());
    }

    /** @test */
    public function it_can_use_a_custom_key_for_section_items()
    {
        $collection = $this->getDummyCollection();

        $sectioned = $collection->sectionBy('module', null, 'data');

        $expected = [
             [
                 'module' => 'Basics',
                 'data' => [
                      ['name' => 'Lesson 1', 'module' => 'Basics'],
                      ['name' => 'Lesson 2', 'module' => 'Basics'],
                 ],
             ],
             [
                 'module' => 'Advanced',
                 'data' => [
                      ['name' => 'Lesson 3', 'module' => 'Advanced'],
                      ['name' => 'Lesson 4', 'module' => 'Advanced'],
                 ],
             ],
             [
                 'module' => 'Basics',
                 'data' => [
                      ['name' => 'Lesson 5', 'module' => 'Basics'],
                 ],
             ],
         ];

        $this->assertEquals($expected, $sectioned->map(function ($section) {
            $section['data'] = $section['data']->toArray();

            return $section;
        })->toArray());
    }

    /** @test */
    public function it_can_preserve_keys()
    {
        $collection = $this->getDummyCollection();

        $sectioned = $collection->sectionBy('module', null, 'items', true);

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

        $this->assertEquals($expected, $sectioned->map(function ($section) {
            $section['items'] = $section['items']->toArray();

            return $section;
        })->toArray());
    }

    protected function getDummyCollection(): Collection
    {
        return Collection::make([
            'lesson1' => ['name' => 'Lesson 1', 'module' => 'Basics'],
            'lesson2' => ['name' => 'Lesson 2', 'module' => 'Basics'],
            'lesson3' => ['name' => 'Lesson 3', 'module' => 'Advanced'],
            'lesson4' => ['name' => 'Lesson 4', 'module' => 'Advanced'],
            'lesson5' => ['name' => 'Lesson 5', 'module' => 'Basics'],
        ]);
    }
}
