<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters\DI;

use Nette\Database\Context;
use Nette\DI\CompilerExtension;
use Nette\DI\ServiceDefinition;
use Zenify\NetteDatabaseFilters\Contract\FilterInterface;
use Zenify\NetteDatabaseFilters\Contract\FilterManagerInterface;
use Zenify\NetteDatabaseFilters\Database\SmartContext;


final class NetteDatabaseFiltersExtension extends CompilerExtension
{

	/**
	 * {@inheritdoc}
	 */
	public function loadConfiguration()
	{
		$this->compiler->parseServices(
			$this->getContainerBuilder(),
			$this->loadFromFile(__DIR__ . '/../config/services.neon')
		);
	}


	/**
	 * {@inheritdoc}
	 */
	public function beforeCompile()
	{
		$this->replaceContextWithOwnClass();
		$this->collectFiltersToFilterManager();
	}


	public function replaceContextWithOwnClass()
	{
		$containerBuilder = $this->getContainerBuilder();

		foreach ($containerBuilder->findByType(Context::class) as $contextDefinition) {
			$contextDefinition->setFactory(SmartContext::class);
			$contextDefinition->setAutowired(TRUE);
		}
	}


	private function collectFiltersToFilterManager()
	{
		$containerBuilder = $this->getContainerBuilder();

		$filterManagerDefinition = $this->getDefinitionByType(FilterManagerInterface::class);
		foreach ($containerBuilder->findByType(FilterInterface::class) as $name => $definition) {
			$filterManagerDefinition->addSetup('addFilter', ['@' . $name]);
		}
	}


	/**
	 * @param string $type
	 * @return ServiceDefinition
	 */
	private function getDefinitionByType($type)
	{
		$containerBuilder = $this->getContainerBuilder();
		$serviceName = $containerBuilder->getByType($type);

		return $containerBuilder->getDefinition($serviceName);
	}

}
