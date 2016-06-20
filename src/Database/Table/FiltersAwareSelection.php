<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters\Database\Table;

use Nette\Caching\IStorage;
use Nette\Database\Context;
use Nette\Database\IConventions;
use Nette\Database\Table\Selection;
use Zenify\NetteDatabaseFilters\Contract\FilterManagerInterface;


final class FiltersAwareSelection extends Selection
{

	/**
	 * @var FilterManagerInterface
	 */
	private $filterManager;


	/**
	 * @param FilterManagerInterface $filterManager
	 * @param Context $context
	 * @param IConventions $conventions
	 * @param string $tableName
	 * @param IStorage|NULL $cacheStorage
	 */
	public function __construct(
		FilterManagerInterface $filterManager,
		Context $context,
		IConventions $conventions,
		$tableName,
		IStorage $cacheStorage = NULL
	) {
		$this->filterManager = $filterManager;
		parent::__construct($context, $conventions, $tableName, $cacheStorage);
	}


	/**
	 * {@inheritdoc}
	 */
	public function getReferencingTable($table, $column, $active = NULL)
	{
		$referencingTable = parent::getReferencingTable($table, $column, $active);

		$this->filterManager->applyFilters($referencingTable, $referencingTable->getName());

		return $referencingTable;
	}


	/**
	 * {@inheritdoc}
	 */
	public function createSelectionInstance($table = NULL)
	{
		$selection = parent::createSelectionInstance($table);

		$this->filterManager->applyFilters($selection, $selection->getName());

		return $selection;
	}

}
