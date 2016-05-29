<?php

namespace Zenify\NetteDatabaseFilters\Tests\Database;

use Nette\Database\Context;
use Nette\DI\Container;
use PHPUnit_Framework_Assert;
use PHPUnit_Framework_TestCase;
use Zenify\NetteDatabaseFilters\Contract\FilterManagerInterface;
use Zenify\NetteDatabaseFilters\Database\SmartContext;
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

		$database->table('user')
			->fetchAll();
		// ...
	}

}
