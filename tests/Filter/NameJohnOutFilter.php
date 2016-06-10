<?php

namespace Zenify\NetteDatabaseFilters\Tests\Filter;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;


final class NameJohnOutFilter implements FilterInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function applyFilter(Selection $selection)
	{
		$tableName = $selection->getName();

		if ($tableName !== 'user') {
		    return $selection;
        }
		$selection->where('name != ?', 'John');

		return $selection;
	}

}
