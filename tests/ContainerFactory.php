<?php

namespace Zenify\NetteDatabaseFilters\Tests;

use Nette\Configurator;
use Nette\Database\Connection;
use Nette\DI\Container;


final class ContainerFactory
{

	/**
	 * @return Container
	 */
	public function create()
	{
		$configurator = new Configurator;
		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig(__DIR__ . '/config/default.neon');
		$container = $configurator->createContainer();

		$this->prepareDatabase($container);

		return $container;
	}


	private function prepareDatabase(Container $container)
	{
		/** @var Connection $connection */
		$connection = $container->getByType(Connection::class);
		$pdo = $connection->getPdo();

		// 1. create table user + fill some data
		$pdo->prepare('CREATE TABLE user (name VARCHAR);')
			->execute();
		$pdo->prepare('INSERT INTO user VALUES ("Tom");')
			->execute();
		$pdo->prepare('INSERT INTO user VALUES ("John");')
			->execute();
	}

}
