<?php

/**
 * @file classes/core/PKPServices.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPServices
 * @ingroup core
 * @see Core
 *
 * @brief Pimple Dependency Injection Container.
 */

abstract class PKPServices {

	/** @var Pimple\Container Pimple Dependency Injection Container */
	private static $instance = null;

	protected $container = null;

	/**
	 * private constructor
	 */
	private function __construct() {
		$this->container = new Pimple\Container();
		$this->init();
	}

	/**
	 * container initialization
	 */
	abstract protected function init();

	/**
	 * A static method to register a service
	 * @param string $service
	 */
	public static function register(Pimple\ServiceProviderInterface $service) {
		self::_instance()->container->register($service);
	}

	/**
	 * A static method to get a service
	 * @param string $service
	 */
	public static function get($service) {
		return self::_instance()->_getFromContainer($service);
	}

	/**
	 * Returns the instance of the container
	 */
	private static function _instance() {
		if (is_null(self::$instance)) {
			self::$instance = new Services();
		}

		return self::$instance;
	}

	/**
	 * Gets the service from an instanced container.
	 * @param string $service
	 */
	private function _getFromContainer($service) {
		return $this->container[$service];
	}

}
