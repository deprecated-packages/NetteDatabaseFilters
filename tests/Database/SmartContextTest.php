<?php

namespace Zenify\NetteDatabaseFilters\Tests\Database;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use PHPUnit_Framework_TestCase;
use Zenify\NetteDatabaseFilters\Database\Table\SmartSelection;
use Zenify\NetteDatabaseFilters\Tests\ContainerFactory;


final class SmartContextTest extends PHPUnit_Framework_TestCase
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


	public function testFetchAll()
	{
		$this->assertInstanceOf(SmartSelection::class, $this->selection);

		$result = $this->selection->fetchAll();

		$this->assertCount(1, $result);
	}

	public function testGet()
	{
		$this->assertInstanceOf(ActiveRow::class, $this->selection->get(1));
		$this->assertFalse($this->selection->get(2));
	}


	public function testFetchPairs()
	{
		$pairs = $this->selection->fetchPairs('id', 'artist');

		$this->assertCount(1, $pairs);
		$this->assertSame([
			1 => 'Suzanne Vega'
		], $pairs);
	}


	public function testFetchIteration()
	{
		$userCount = 0;
		foreach ($this->selection as $user) {
			$userCount++;
		}
		$this->assertSame(1, $userCount);
	}


	public function testFetch()
	{
		$user = $this->selection->fetch();
		$this->assertInstanceOf(ActiveRow::class, $user);
		$this->assertSame('Suzanne Vega', $user['artist']);

		$user2 = $this->selection->fetch();
		$this->assertFalse($user2);
	}


	public function testCount()
	{
		$this->assertSame(1, $this->selection->count());
	}


	public function testWhere()
	{
		$this->selection->where('artist != ?', 'Suzanne Vega');
		$this->assertSame(0, $this->selection->count());
	}

}
