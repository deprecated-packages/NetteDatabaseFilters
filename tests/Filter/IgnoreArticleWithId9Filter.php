<?php

namespace Zenify\NetteDatabaseFilters\Tests\Filter;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;


final class IgnoreArticleWithId9Filter implements FilterInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function applyFilter(Selection $selection)
	{
		$tableName = $selection->getName();
		if ($tableName !== 'article') {
		    return;
		}

		$selection->where('id != ?', 9);
	}

}
