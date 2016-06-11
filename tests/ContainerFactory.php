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
		$configurator = new Configurator;
		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig(__DIR__ . '/config/default.neon');
		$container = $configurator->createContainer();

		return $container;
	}

}
