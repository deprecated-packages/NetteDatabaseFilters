<?php

namespace Zenify\NetteDatabaseFilters\Tests\Database;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use PHPUnit_Framework_TestCase;
use Zenify\NetteDatabaseFilters\Database\Table\SmartSelection;
use Zenify\NetteDatabaseFilters\Tests\ContainerFactory;


final class SmartContextTest extends PHPUnit_Framework_TestCase
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


	public function testFetchAll()
	{
		$selection = $this->database->table('user');
		$this->assertInstanceOf(SmartSelection::class, $selection);

		$result = $selection->fetchAll();
		$this->assertCount(1, $result);
	}


	public function testFetch()
	{
		$selection = $this->database->table('user');
		$this->assertInstanceOf(ActiveRow::class, $selection->get(1));
		$this->assertFalse($selection->get(2));
	}

}
