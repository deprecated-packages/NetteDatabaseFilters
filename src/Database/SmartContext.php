<?php

namespace Zenify\NetteDatabaseFilters\Database;

use Nette\Database\Context;
use Zenify\NetteDatabaseFilters\Contract\Database\ContextInterface;


final class SmartContext extends Context implements ContextInterface
{

    /**
     * {@inheritdoc}
     */
    public function table($table)
    {
        return parent::table($table);
    }

}
