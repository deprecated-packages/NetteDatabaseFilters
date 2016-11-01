<?php

declare(strict_types=1);

/*
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters\Contract;

use Nette\Database\Table\Selection;


interface FilterManagerInterface
{

	function addFilter(FilterInterface $filter);


	function applyFilters(Selection $selection, string $targetTable) : Selection;

}
