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
		$this->setFilterManagerToContexts();
		$this->collectFiltersToFilterManager();
	}


	public function replaceContextWithOwnClass()
	{
		foreach ($this->getContainerBuilder()->findByType(Context::class) as $contextDefinition) {
			$contextDefinition->setFactory(SmartContext::class);
		}
	}


	private function setFilterManagerToContexts()
	{
		$filterManagerDefinition = $this->getDefinitionByType(FilterManagerInterface::class);

		foreach ($this->getContainerBuilder()->findByType(Context::class) as $contextDefinition) {
			$contextDefinition->setFactory(SmartContext::class);
			$contextDefinition->addSetup('setFilterManager', ['@' . $filterManagerDefinition->getClass()]);
		}
	}


	private function collectFiltersToFilterManager()
	{
		$filterManagerDefinition = $this->getDefinitionByType(FilterManagerInterface::class);

		foreach ($this->getContainerBuilder()->findByType(FilterInterface::class) as $name => $definition) {
			$filterManagerDefinition->addSetup('addFilter', ['@' . $name]);
		}
	}


	/**
	 * @param string $type
	 * @return ServiceDefinition
	 */
	private function getDefinitionByType($type)
	{
		$definitionsByType = $this->getContainerBuilder()
			->findByType($type);

		return array_pop($definitionsByType);
	}

}
