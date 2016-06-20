<?php

namespace Zenify\NetteDatabaseFilters\Tests\Filter;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;


final class IgnoreArticleWithId9Filter implements FilterInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function applyFilter(Selection $selection, $targetTable)
	{
		if ($targetTable !== 'article') {
		    return;
		}

		$selection->where('article.id != ?', 9);
	}

}
