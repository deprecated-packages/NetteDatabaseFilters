<?php

namespace Zenify\NetteDatabaseFilters\Tests\Database;

use Nette\Database\Context;
use PHPUnit\Framework\TestCase;
use Zenify\NetteDatabaseFilters\Tests\ContainerFactory;


final class SmartSelectionTest extends TestCase
{

	/**
	 * @var Context
	 */
	private $database;


	protected function setUp()
	{
		$container = (new ContainerFactory)->create();

		$this->database = $container->getByType(Context::class);
	}


	public function testRelated()
	{
		$article = $this->database->table('article')
			->get(2);

		$this->assertCount(4, $article->related('comment'));
	}

}
