<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class GroupByMultipleTest extends TestCase
{
    /** @test */
    public function testGroupByAttribute()
    {
        $data = new Collection([['rating' => 1, 'url' => '1'], ['rating' => 1, 'url' => '1'], ['rating' => 2, 'url' => '2']]);

        $expected = [1 => [['rating' => 1, 'url' => '1'], ['rating' => 1, 'url' => '1']], 2 => [['rating' => 2, 'url' => '2']]];
        $result = $data->groupByMultiple('rating');
        $this->assertEquals($expected, $result->toArray());

        $expected = [1 => [['rating' => 1, 'url' => '1'], ['rating' => 1, 'url' => '1']], 2 => [['rating' => 2, 'url' => '2']]];
        $result = $data->groupByMultiple('url');
        $this->assertEquals($expected, $result->toArray());
    }

    /** @test */
    public function testGroupByAttributePreservingKeys()
    {
        $data = new Collection([10 => ['rating' => 1, 'url' => '1'],  20 => ['rating' => 1, 'url' => '1'],  30 => ['rating' => 2, 'url' => '2']]);

        $result = $data->groupByMultiple('rating', true);

        $expected_result = [
          1 => [10 => ['rating' => 1, 'url' => '1'], 20 => ['rating' => 1, 'url' => '1']],
          2 => [30 => ['rating' => 2, 'url' => '2']],
        ];

        $this->assertEquals($expected_result, $result->toArray());
    }

    /** @test */
    public function testGroupByClosureWhereItemsHaveSingleGroup()
    {
        $data = new Collection([['rating' => 1, 'url' => '1'], ['rating' => 1, 'url' => '1'], ['rating' => 2, 'url' => '2']]);

        $callback = function ($item) {
            return $item['rating'];
        };
        $result = $data->groupByMultiple($callback);

        $expected = [1 => [['rating' => 1, 'url' => '1'], ['rating' => 1, 'url' => '1']], 2 => [['rating' => 2, 'url' => '2']]];
        $this->assertEquals($expected, $result->toArray());
    }

    /** @test */
    public function testGroupByClosureWhereItemsHaveSingleGroupPreservingKeys()
    {
        $data = new Collection([10 => ['rating' => 1, 'url' => '1'], 20 => ['rating' => 1, 'url' => '1'], 30 => ['rating' => 2, 'url' => '2']]);

        $callback = function ($item) {
            return $item['rating'];
        };
        $result = $data->groupByMultiple($callback, true);

        $expected_result = [
          1 => [10 => ['rating' => 1, 'url' => '1'], 20 => ['rating' => 1, 'url' => '1']],
          2 => [30 => ['rating' => 2, 'url' => '2']],
        ];

        $this->assertEquals($expected_result, $result->toArray());
    }

    /** @test */
    public function testGroupByClosureWhereItemsHaveMultipleGroups()
    {
        $data = new Collection([
          ['user' => 1, 'roles' => ['Role_1', 'Role_3']],
          ['user' => 2, 'roles' => ['Role_1', 'Role_2']],
          ['user' => 3, 'roles' => ['Role_1']],
        ]);

        $callback = function ($item) {
            return $item['roles'];
        };
        $result = $data->groupByMultiple($callback);

        $expected_result = [
          'Role_1' => [
            ['user' => 1, 'roles' => ['Role_1', 'Role_3']],
            ['user' => 2, 'roles' => ['Role_1', 'Role_2']],
            ['user' => 3, 'roles' => ['Role_1']],
          ],
          'Role_2' => [
            ['user' => 2, 'roles' => ['Role_1', 'Role_2']],
          ],
          'Role_3' => [
            ['user' => 1, 'roles' => ['Role_1', 'Role_3']],
          ],
        ];

        $this->assertEquals($expected_result, $result->toArray());
    }

    /** @test */
    public function testGroupByClosureWhereItemsHaveMultipleGroupsPreservingKeys()
    {
        $data = new Collection([
          10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3']],
          20 => ['user' => 2, 'roles' => ['Role_1', 'Role_2']],
          30 => ['user' => 3, 'roles' => ['Role_1']],
        ]);

        $callback = function ($item) {
            return $item['roles'];
        };
        $result = $data->groupByMultiple($callback, true);

        $expected_result = [
          'Role_1' => [
            10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3']],
            20 => ['user' => 2, 'roles' => ['Role_1', 'Role_2']],
            30 => ['user' => 3, 'roles' => ['Role_1']],
          ],
          'Role_2' => [
            20 => ['user' => 2, 'roles' => ['Role_1', 'Role_2']],
          ],
          'Role_3' => [
            10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3']],
          ],
        ];

        $this->assertEquals($expected_result, $result->toArray());
    }

    /** @test */
    public function testGroupByMultipleAttributes()
    {
        $data = new Collection([
          ['A' => 'foo', 'B' => 'bar',    'C' => 'baz',    'D' => 'thud'],
          ['A' => 'foo', 'B' => 'garply', 'C' => 'corge',  'D' => 'plugh'],
          ['A' => 'foo', 'B' => 'bar',    'C' => 'corge',  'D' => 'thud'],
          ['A' => 'foo', 'B' => 'bar',    'C' => 'corge',  'D' => 'waldo'],
          ['A' => 'qux', 'B' => 'garply', 'C' => 'xyzzy',  'D' => 'fred'],
          ['A' => 'qux', 'B' => 'grault', 'C' => 'garply', 'D' => 'quuz'],
        ]);
        $result = $data->groupByMultiple(['A', 'B', 'C', 'D']);
        $expected = [
          'foo' => [
            'bar' => [
              'baz' => [
                'thud' => [
                  ['A' => 'foo', 'B' => 'bar',    'C' => 'baz',    'D' => 'thud'],
                ],
              ],
              'corge' => [
                'thud' => [
                  ['A' => 'foo', 'B' => 'bar',    'C' => 'corge',  'D' => 'thud'],
                ],
                'waldo' => [
                  ['A' => 'foo', 'B' => 'bar',    'C' => 'corge',  'D' => 'waldo'],
                ],
              ],
            ],
            'garply' => [
              'corge' => [
                'plugh' => [
                  ['A' => 'foo', 'B' => 'garply', 'C' => 'corge',  'D' => 'plugh'],
                ],
              ],
            ],
          ],
          'qux' => [
            'garply' => [
              'xyzzy' => [
                'fred' => [
                  ['A' => 'qux', 'B' => 'garply', 'C' => 'xyzzy',  'D' => 'fred'],
                ],
              ],
            ],
            'grault' => [
              'garply' => [
                'quuz' => [
                  ['A' => 'qux', 'B' => 'grault', 'C' => 'garply', 'D' => 'quuz'],
                ],
              ],
            ],
          ],
        ];
        $this->assertEquals($expected, $result->toArray());
    }

    /** @test */
    public function testGroupByMultipleAttributePreservingKeys()
    {
        $data = new Collection([
          10 => ['rating' => 1, 'url' => 'a'],
          20 => ['rating' => 1, 'url' => 'a'],
          30 => ['rating' => 2, 'url' => 'b'],
          40 => ['rating' => 2, 'url' => 'a'],
          50 => ['rating' => 1, 'url' => 'b'],
          60 => ['rating' => 3, 'url' => 'c'],
        ]);

        $result = $data->groupByMultiple(['rating', 'url'], true);

        $expected = [
          1 => [
            'a' => [
              10 => ['rating' => 1, 'url' => 'a'],
              20 => ['rating' => 1, 'url' => 'a'],
            ],
            'b' => [
              50 => ['rating' => 1, 'url' => 'b'],
            ],
          ],
          2 => [
            'a' => [
              40 => ['rating' => 2, 'url' => 'a'],
            ],
            'b' => [
              30 => ['rating' => 2, 'url' => 'b'],
            ],
          ],
          3 => [
            'c' => [
              60 => ['rating' => 3, 'url' => 'c'],
            ],
          ],
        ];

        $this->assertEquals($expected, $result->toArray());
    }

    /** @test */
    public function testGroupByMultipleClosureWhereItemsHaveSingleGroup()
    {
        $data = new Collection([
          ['rating' => 1, 'url' => '1'],
          ['rating' => 1, 'url' => '1'],
          ['rating' => 2, 'url' => '2'],
          ['rating' => 1, 'url' => '3'],
        ]);

        $callback1 = function ($item) {
            return $item['rating'];
        };
        $callback2 = function ($item) {
            return $item['url'];
        };
        $result = $data->groupByMultiple([$callback1, $callback2]);

        $expected = [
          1 => [
            1 => [
              ['rating' => 1, 'url' => '1'],
              ['rating' => 1, 'url' => '1'],
            ],
            3 => [
              ['rating' => 1, 'url' => '3'],
            ],
          ],
          2 => [
            2 => [
              ['rating' => 2, 'url' => '2'],
            ],
          ],
        ];
        $this->assertEquals($expected, $result->toArray());
    }

    /** @test */
    public function testGroupByMultipleClosureWhereItemsHaveSingleGroupPreservingKeys()
    {
        $data = new Collection([
          10 => ['rating' => 1, 'url' => '1'],
          20 => ['rating' => 1, 'url' => '1'],
          30 => ['rating' => 2, 'url' => '2'],
          40 => ['rating' => 1, 'url' => '3'],
        ]);

        $callback1 = function ($item) {
            return $item['rating'];
        };
        $callback2 = function ($item) {
            return $item['url'];
        };
        $result = $data->groupByMultiple([$callback1, $callback2], true);

        $expected = [
          1 => [
            1 => [
              10 => ['rating' => 1, 'url' => '1'],
              20 => ['rating' => 1, 'url' => '1'],
            ],
            3 => [
              40 => ['rating' => 1, 'url' => '3'],
            ],
          ],
          2 => [
            2 => [
              30 => ['rating' => 2, 'url' => '2'],
            ],
          ],
        ];

        $this->assertEquals($expected, $result->toArray());
    }

    /** @test */
    public function testGroupByMultipleClosureWhereItemsHaveMultipleGroups()
    {
        $data = new Collection([
          ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
          ['user' => 2, 'roles' => ['Role_1', 'Role_2'], 'teams' => ['red']],
          ['user' => 3, 'roles' => ['Role_1'], 'teams' => ['yellow', 'blue']],
        ]);

        $callback1 = function ($item) {
            return $item['roles'];
        };
        $callback2 = function ($item) {
            return $item['teams'];
        };
        $result = $data->groupByMultiple([$callback1, $callback2]);

        $expected = [
          'Role_1' => [
            'red' => [
              ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
              ['user' => 2, 'roles' => ['Role_1', 'Role_2'], 'teams' => ['red']],
            ],
            'blue' => [
              ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
              ['user' => 3, 'roles' => ['Role_1'],           'teams' => ['yellow', 'blue']],
            ],
            'yellow' => [
              ['user' => 3, 'roles' => ['Role_1'],           'teams' => ['yellow', 'blue']],
            ],
          ],
          'Role_2' => [
            'red' => [
              ['user' => 2, 'roles' => ['Role_1', 'Role_2'], 'teams' => ['red']],
            ],
          ],
          'Role_3' => [
            'red' => [
              ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
            ],
            'blue' => [
              ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
            ],
          ],
        ];

        $this->assertEquals($expected, $result->toArray());
    }

    /** @test */
    public function testGroupByMultipleClosureWhereItemsHaveMultipleGroupsPreservingKeys()
    {
        $data = new Collection([
          10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
          20 => ['user' => 2, 'roles' => ['Role_1', 'Role_2'], 'teams' => ['red']],
          30 => ['user' => 3, 'roles' => ['Role_1'], 'teams' => ['yellow', 'blue']],
        ]);

        $callback1 = function ($item) {
            return $item['roles'];
        };
        $callback2 = function ($item) {
            return $item['teams'];
        };
        $result = $data->groupByMultiple([$callback1, $callback2], true);

        $expected = [
          'Role_1' => [
            'red' => [
              10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
              20 => ['user' => 2, 'roles' => ['Role_1', 'Role_2'], 'teams' => ['red']],
            ],
            'blue' => [
              10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
              30 => ['user' => 3, 'roles' => ['Role_1'],           'teams' => ['yellow', 'blue']],
            ],
            'yellow' => [
              30 => ['user' => 3, 'roles' => ['Role_1'],           'teams' => ['yellow', 'blue']],
            ],
          ],
          'Role_2' => [
            'red' => [
              20 => ['user' => 2, 'roles' => ['Role_1', 'Role_2'], 'teams' => ['red']],
            ],
          ],
          'Role_3' => [
            'red' => [
              10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
            ],
            'blue' => [
              10 => ['user' => 1, 'roles' => ['Role_1', 'Role_3'], 'teams' => ['red', 'blue']],
            ],
          ],
        ];

        $this->assertEquals($expected, $result->toArray());
    }
}
