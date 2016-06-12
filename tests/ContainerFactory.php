<?php

namespace Zenify\NetteDatabaseFilters\Tests;

use Nette\Configurator;
use Nette\DI\Container;


final class ContainerFactory
{

	/**
	 * @return Container
	 */
	public function create()
	{
		return $this->createWithConfig(__DIR__ . '/config/default.neon');
	}


	/**
	 * @param string $config
	 * @return Container
	 */
	public function createWithConfig($config)
	{
		$configurator = new Configurator;
		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig($config);
		$container = $configurator->createContainer();

		return $container;
	}

}
