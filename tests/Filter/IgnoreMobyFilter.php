<?php

namespace Zenify\NetteDatabaseFilters\Tests\Filter;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;


final class IgnoreMobyFilter implements FilterInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function applyFilter(Selection $selection)
	{
		$tableName = $selection->getName();

		if ($tableName !== 'albums') {
		    return $selection;
		}
		$selection->where('artist != ?', 'Moby');

		return $selection;
	}

}
