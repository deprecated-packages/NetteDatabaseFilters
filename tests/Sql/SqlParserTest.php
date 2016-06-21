<?php

namespace Zenify\NetteDatabaseFilters\Tests\Sql;

use PHPSQLParser\PHPSQLParser;
use PHPUnit_Framework_TestCase;
use Zenify\NetteDatabaseFilters\Sql\SqlParser;


final class SqlParserTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var SqlParser
	 */
	private $sqlParser;


	protected function setUp()
	{
		$this->sqlParser = new SqlParser(new PHPSQLParser);
	}


	public function testParseTables()
	{
		$tables = $this->sqlParser->parseTablesFromSql(
			'SELECT [comment].* FROM [article] LEFT JOIN [comment] ON [article].[id] '
			. '= [comment].[article_id] WHERE ([article].[id] != ?)'
		);

		$this->assertSame(['article', 'comment'], $tables);
	}

}
