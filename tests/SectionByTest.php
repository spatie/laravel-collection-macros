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

    protected function getDummyCollection(): Collection
    {
        return Collection::make([
            ['name' => 'Lesson 1', 'module' => 'Basics'],
            ['name' => 'Lesson 2', 'module' => 'Basics'],
            ['name' => 'Lesson 3', 'module' => 'Advanced'],
            ['name' => 'Lesson 4', 'module' => 'Advanced'],
            ['name' => 'Lesson 5', 'module' => 'Basics'],
        ]);
    }
}
