<?php

/**
 * @file classes/plugins/GatewayPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class GatewayPlugin
 * @ingroup plugins
 *
 * @brief Abstract class for gateway plugins
 */

import('lib.pkp.classes.plugins.Plugin');

abstract class GatewayPlugin extends Plugin {

	/**
	 * Handle fetch requests for this plugin.
	 * @param $args array
	 * @param $request object
	 */
	abstract function fetch($args, $request);

	/**
	 * Determine whether the plugin can be enabled.
	 * @return boolean
	 */
	function getCanEnable() {
		return true;
	}

	/**
	 * Determine whether the plugin can be disabled.
	 * @return boolean
	 */
	function getCanDisable() {
		return true;
	}

	/**
	 * Determine whether or not this plugin is currently enabled.
	 * @return boolean
	 */
	function getEnabled() {
		return $this->getSetting($this->getCurrentContextId(), 'enabled');
	}

	/**
	 * Set whether or not this plugin is currently enabled.
	 * @param $enabled boolean
	 */
	function setEnabled($enabled) {
		$this->updateSetting($this->getCurrentContextId(), 'enabled', $enabled, 'bool');
	}

	/**
	 * Get the current context ID or the site-wide context ID (0) if no context
	 * can be found.
	 */
	function getCurrentContextId() {
		$context = Application::get()->getRequest()->getContext();
		return is_null($context) ? 0 : $context->getId();
	}

	/**
	 * Get policies to the authorization process
	 * @param $request PKPRequest
	 * @return array Set of authorization policies
	 */

	function getPolicies($request) {
		return array();
	}

}
