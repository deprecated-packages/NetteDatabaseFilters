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
use PHPSQLParser\PHPSQLParser;
use Zenify\NetteDatabaseFilters\Contract\FilterManagerInterface;
use Zenify\NetteDatabaseFilters\Sql\SqlParser;


final class FiltersAwareSelection extends Selection
{

	/**
	 * @var FilterManagerInterface
	 */
	private $filterManager;

	/**
	 * @var SqlParser
	 */
	private $sqlParser;


	/**
	 * @param FilterManagerInterface $filterManager
	 * @param SqlParser $sqlParser
	 * @param Context $context
	 * @param IConventions $conventions
	 * @param string $tableName
	 * @param IStorage|NULL $cacheStorage
	 */
	public function __construct(
		FilterManagerInterface $filterManager,
		SqlParser $sqlParser,
		Context $context,
		IConventions $conventions,
		$tableName,
		IStorage $cacheStorage = NULL
	) {
		$this->filterManager = $filterManager;
		$this->sqlParser = $sqlParser;
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


	/**
	 * {@inheritdoc}
	 */
	public function select($columns, ...$params)
	{
		$selection = parent::select($columns, ...$params);

		$tables = $this->sqlParser->parseTablesFromSql($selection->getSql());
		foreach ($tables as $table) {
			$this->filterManager->applyFilters($selection, $table);
		}

		return $selection;
	}

}

