<?php

namespace Zenify\NetteDatabaseFilters\Tests\Filter;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;


final class IgnoreCommentsByJakubFilter implements FilterInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function applyFilter(Selection $selection)
	{
		$tableName = $selection->getName();
		if ($tableName !== 'comment') {
		    return;
		}

		$selection->where('name != ?', 'Jakub');
	}

}
