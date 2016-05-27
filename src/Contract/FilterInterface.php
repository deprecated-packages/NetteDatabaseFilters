<?php

namespace Zenify\NetteDatabaseFilters\Contract;


use Nette\Database\Table\Selection;

interface FilterInterface
{

    /**
     * @return Selection
     */
    public function applyFilter(Selection $selection);

}