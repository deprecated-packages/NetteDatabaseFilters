<?php

namespace Zenify\NetteDatabaseFilters\Tests\Database;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
use PHPUnit\Framework\TestCase;
use Zenify\NetteDatabaseFilters\Tests\ContainerFactory;
use Zenify\NetteDatabaseFilters\Tests\Filter\IgnoreArticleWithId9Filter;


final class FiltersAwareSelectionTest extends TestCase
{

	/**
	 * @var Context
	 */
	private $database;


	protected function setUp()
	{
		$container = (new ContainerFactory)->create();

		$this->database = $container->getByType(Context::class);
	}


	public function testRelated()
	{
		$article = $this->database->table('article')
			->get(2);

		$this->assertCount(4, $article->related('comment'));
	}


	public function testReferenced()
	{
		$comment = $this->database->table('comment')
			->get(31);

		$article = $comment->ref('article');
		$this->assertNull($article);
	}

}
