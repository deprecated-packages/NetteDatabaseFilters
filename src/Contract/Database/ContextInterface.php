<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters\Contract\Database;

use Nette\Database\Table\Selection;


interface ContextInterface
{

	/**
	 * @param string $name
	 * @return Selection
	 */
	function table($name);

}
