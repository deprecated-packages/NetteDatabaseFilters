<?php

namespace Zenify\NetteDatabaseFilters\Tests\Filter;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;


final class DummyFilter implements FilterInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function applyFilter(Selection $selection)
	{
	}

}
