<?php

namespace Zenify\NetteDatabaseFilters\Tests\Database;

use Nette\Database\Context;
use Nette\Database\Table\Selection;
use PHPUnit\Framework\TestCase;
use Zenify\NetteDatabaseFilters\Tests\ContainerFactory;


final class SmartSelectionTest extends TestCase
{

	/**
	 * @var Selection
	 */
	private $selection;


	protected function setUp()
	{
		$container = (new ContainerFactory)->create();

		/** @var Context $database */
		$database = $container->getByType(Context::class);
		$this->selection = $database->table('albums');
	}


	public function testJoin()
	{
		$album = $this->selection->fetch();
//		var_dump($album);
	}

}