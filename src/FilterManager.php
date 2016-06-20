<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;
use Zenify\NetteDatabaseFilters\Contract\FilterManagerInterface;


final class FilterManager implements FilterManagerInterface
{

	/**
	 * @var FilterInterface[]
	 */
	private $filters = [];


	/**
	 * {@inheritdoc}
	 */
	public function addFilter(FilterInterface $filter)
	{
		$this->filters[] = $filter;
	}


	/**
	 * {@inheritdoc}
	 */
	public function applyFilters(Selection $selection, $targetTable)
	{
		foreach ($this->filters as $filter) {
			$filter->applyFilter($selection, $targetTable);
		}

		return $selection;
	}

}
