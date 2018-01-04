<?php

namespace Spatie\CollectionMacros\Test;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class SortByDateTest extends TestCase
{
    /** @test */
    public function it_sorts_dates_in_a_list()
    {
        $data = new Collection([
            '2018-01-04',
            '1995-07-15',
            '2000-01-01',
        ]);

        $this->assertEquals('1995-07-15', $data->sortByDate()->first());
        $this->assertEquals('2018-01-04', $data->sortByDate()->last());
    }

    /** @test */
    public function it_sorts_dates_in_a_list_in_descending_order()
    {
        $data = new Collection([
            '2018-01-04',
            '1995-07-15',
            '2000-01-01',
        ]);

        $this->assertEquals('2018-01-04', $data->sortByDateDesc()->first());
        $this->assertEquals('1995-07-15', $data->sortByDateDesc()->last());
    }

    /** @test */
    public function it_will_treat_a_non_date_value_as_a_timestamp_of_zero()
    {
        $data = new Collection([
            '2018-01-04',
            '1995-07-15',
            'Taylor Otwell',
            '2000-01-01',
        ]);

        $this->assertEquals('Taylor Otwell', $data->sortByDate()->first());
        $this->assertEquals('2018-01-04', $data->sortByDate()->last());
    }

    /** @test */
    public function it_sorts_dates_as_a_key()
    {
        $data = new Collection([
            ['date' => '2018-01-04', 'name' => 'Banana'],
            ['date' => '1995-07-15', 'name' => 'Apple'],
            ['date' => '2000-01-01', 'name' => 'Orange'],
        ]);

        $this->assertEquals('Apple', $data->sortByDate('date')->first()['name']);
        $this->assertEquals('Banana', $data->sortByDate('date')->last()['name']);
    }

    /** @test */
    public function it_sorts_carbon_objects()
    {
        $data = new Collection([
            Carbon::parse('2018-01-04'),
            Carbon::parse('1995-07-15'),
            Carbon::parse('2000-01-01'),
        ]);

        $this->assertEquals('1995-07-15', $data->sortByDate()->first()->format('Y-m-d'));
        $this->assertEquals('2018-01-04', $data->sortByDate()->last()->format('Y-m-d'));
    }

    /** @test */
    public function it_sorts_using_callbacks()
    {
        $data = new Collection([
            [
                'name' => 'Banana',
                'dates' => [
                    'from' => '2018-01-04',
                    'to' => '2019-01-01',
                ],
            ],
            [
                'name' => 'Apple',
                'dates' => [
                    'from' => '1995-07-15',
                    'to' => '2019-06-12',
                ],
            ],
            [
                'name' => 'Orange',
                'dates' => [
                    'from' => '2000-01-01',
                    'to' => '2020-04-31',
                ],
            ],
        ]);

        $this->assertEquals('Apple', $data->sortByDate(function ($item) {
            return $item['dates']['from'];
        })->first()['name']);
    }
}
