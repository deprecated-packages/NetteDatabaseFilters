<?php

declare(strict_types=1);

/*
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters\Sql;

use PHPSQLParser\PHPSQLParser;


final class SqlParser
{

	/**
	 * @var PHPSQLParser
	 */
	private $phpSqlParser;


	public function __construct(PHPSQLParser $phpSqlParser)
	{
		$this->phpSqlParser = $phpSqlParser;
	}


	public function parseTablesFromSql(string $sql) : array
	{
		$parsedSql = $this->phpSqlParser->parse($sql);

		$tables = [];
		foreach ($parsedSql['FROM'] as $table) {
			$tables[] = trim($table['table'], '[]');
		}

		return $tables;
	}

}
