<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class CollectByTest extends TestCase
{
    /** @test */
    public function it_can_group_by_condition()
    {
        $this->assertEquals([
            ['name' => 'Ahmed Ashraf', 'email' => 'ahmed@speakol.com'],
            ['name' => 'Mohamed Fergany', 'email' => 'fergany@speakol.com'],
            ],
            Collection::make([
                ['name' => 'Ahmed Ashraf', 'email' => 'ahmed@speakol.com'],
                ['name' => 'Mahmoud Ashraf', 'email' => 'mahmoud@gmail.com'],
                ['name' => 'Mohamed Fergany', 'email' => 'fergany@speakol.com'],
                ['name' => 'Mohamed Tayee', 'email' => 'me@tayee.com'],
            ])->collectBy(function ($row) {
                return strpos($row['email'], '@speakol') !== false ? true : false;
            })->toArray()[0]
        );
    }
}
