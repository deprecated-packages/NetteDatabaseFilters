<?php

namespace Zenify\NetteDatabaseFilters;

use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;


final class SimpleFilter implements FilterInterface
{

    /**
     * {@inheritdoc}
     */
    public function applyFilter(Selection $selection)
    {
        $tableName = $selection->getName();
        if ($tableName !== 'user') {
            return $selection;
        }

        $selection->where('name != ?', 'Tom');

        return $selection;
    }

}
