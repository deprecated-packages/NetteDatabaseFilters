<?php

namespace Zenify\NetteDatabaseFilters\Contract\Database;

use Nette\Database\Table\Selection;


interface ContextInterface
{

    /**
     * @param string $name
     * @return Selection
     */
    public function table($name);

}