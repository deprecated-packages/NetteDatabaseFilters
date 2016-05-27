<?php

namespace Zenify\NetteDatabaseFilters\Database;

use Nette\Caching\IStorage;
use Nette\Database\Connection;
use Nette\Database\Context;
use Nette\Database\IConventions;
use Nette\Database\IStructure;
use Zenify\NetteDatabaseFilters\Contract\Database\ContextInterface;
use Zenify\NetteDatabaseFilters\FilterManager;


final class SmartContext extends Context implements ContextInterface
{

    /**
     * @var FilterManager
     */
    private $filterManager;

    public function __construct(
        Connection $connection,
        IStructure $structure,
        IConventions $conventions = NULL,
        IStorage $cacheStorage = NULL,
        FilterManager $filterManager
    ) {
        parent::__construct($connection, $structure, $conventions, $cacheStorage);
        $this->filterManager = $filterManager;
    }

    /**
     * {@inheritdoc}
     */
    public function table($table)
    {
        $selection = parent::table($table);

        $this->filterManager->applyFilters($selection);

        return $selection;
    }

}
