<?php

namespace Zenify\NetteDatabaseFilters\Tests\Database;

use Nette\Database\Context;
use Nette\Database\Table\Selection;
use Nette\DI\Container;
use PHPUnit_Framework_Assert;
use PHPUnit_Framework_TestCase;
use Zenify\NetteDatabaseFilters\Database\Table\SmartSelection;
use Zenify\NetteDatabaseFilters\Tests\ContainerFactory;


final class SmartContextTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Container
	 */
	private $container;


	protected function setUp()
	{
		$this->container = (new ContainerFactory)->create();
	}


	public function testApplyFilterFetch()
	{
		/** @var Context $database */
		$database = $this->container->getByType(Context::class);

		$selection = $database->table('user');
		$this->assertInstanceOf(SmartSelection::class, $selection);

//		$result = $database->table('user')
//			->fetchAll();

//		$this->assertCount(1, $result);
	}

}
