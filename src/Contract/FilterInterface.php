<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters\Contract;

use Nette\Database\Table\Selection;


interface FilterInterface
{

	/**
	 * @return Selection
	 */
	function applyFilter(Selection $selection);

}
