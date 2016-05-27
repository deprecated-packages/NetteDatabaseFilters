<?php

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
     * @return Selection
     */
    public function applyFilters(Selection $selection)
    {
        foreach ($this->filters as $filter) {
            $filter->applyFilter($selection);
        }
        
        return $selection;
    }

}
