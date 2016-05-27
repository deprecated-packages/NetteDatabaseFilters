<?php

namespace Zenify\NetteDatabaseFilters\Contract;


interface FilterManagerInterface
{

    /**
     * Adds filter.
     */
    public function addFilter(FilterInterface $filter);

}