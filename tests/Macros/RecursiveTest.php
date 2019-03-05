<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\IntegrationTestCase;

class RecursiveTest extends IntegrationTestCase
{

	/** @test **/
	public function can_collect_recursively()
	{

		$data = [
			['alpha', 'beta', 'charlie'],
			['one' => [1], 'two' => [1, 2]],
		];

		$data = collect($data)->recursive();

		$deep = $data->get(1)->get('two');
		$this->assertInstanceOf(Collection::class, $deep);

	}

}