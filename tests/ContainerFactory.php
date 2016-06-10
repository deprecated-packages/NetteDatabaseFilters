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
		$pdo->prepare('CREATE TABLE user (id NOT NULL, name VARCHAR, PRIMARY KEY (id));')
			->execute();
		$pdo->prepare('INSERT INTO user VALUES (1, "Tom");')
			->execute();
		$pdo->prepare('INSERT INTO user VALUES (2, "John");')
			->execute();
	}

}
