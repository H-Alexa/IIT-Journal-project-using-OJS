<?php

/**
 * @file AddThisPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class AddThisPlugin
 *
 * @brief This plugin provides the AddThis social media sharing options for submissions.
 */


import('lib.pkp.classes.plugins.GenericPlugin');

class AddThisPlugin extends GenericPlugin {
	/**
	 * @copydoc Plugin::register()
	 */
	function register($category, $path, $mainContextId = null) {
		if (parent::register($category, $path, $mainContextId)) {
			if ($this->getEnabled()) {
				HookRegistry::register('Schema::get::context', array($this, 'addToSchema'));
				HookRegistry::register('Templates::Catalog::Book::Details', array($this, 'callbackSharingDisplay')); // OMP
				HookRegistry::register('Templates::Article::Details', array($this, 'callbackSharingDisplay')); // OJS
				HookRegistry::register('Templates::Preprint::Details', array($this, 'callbackSharingDisplay')); // OPS
				// Register the components this plugin implements
				HookRegistry::register('LoadComponentHandler', array($this, 'setupGridHandler'));
				$this->_registerTemplateResource();
			}
			return true;
		}
		return false;
	}

	/**
	 * Add properties to the context schema
	 *
	 * @param $hookName string `Schema::get::context`
	 * @param $args [[
	 * 	@option object Context schema
	 * ]]
	 */
	public function addToSchema($hookName, $args) {
		$schema = $args[0];
		$prop = '{
			"type": "string",
			"apiSummary": true,
			"validation": [
				"nullable"
			]
		}';
		$schema->properties->addThisProfileId = json_decode($prop);
		$schema->properties->addThisUsername = json_decode($prop);
		$schema->properties->addThisPassword = json_decode($prop);
		$schema->properties->addThisDisplayStyle = json_decode($prop);
	}

	/**
	 * Permit requests to the statistics grid handler
	 * @param $hookName string The name of the hook being invoked
	 * @param $args array The parameters to the invoked hook
	 */
	function setupGridHandler($hookName, $params) {
		$component =& $params[0];
		if ($component == 'plugins.generic.addThis.controllers.grid.AddThisStatisticsGridHandler') {
			// Allow the static page grid handler to get the plugin object
			import($component);
			AddThisStatisticsGridHandler::setPlugin($this);
			return true;
		}
		return false;
	}

	/**
	 * Get the name of the settings file to be installed on new press
	 * creation.
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}

	/**
	 * @copydoc PKPPlugin::getDisplayName()
	 */
	function getDisplayName() {
		return __('plugins.generic.addThis.displayName');
	}

	/**
	 * @copydoc PKPPlugin::getDescription()
	 */
	function getDescription() {
		return __('plugins.generic.addThis.description');
	}

	/**
	 * @copydoc Plugin::getActions()
	 */
	function getActions($request, $actionArgs) {
		$router = $request->getRouter();
		import('lib.pkp.classes.linkAction.request.AjaxModal');
		return array_merge(
			$this->getEnabled()?array(
				new LinkAction(
					'settings',
					new AjaxModal(
						$router->url($request, null, null, 'manage', null, array_merge($actionArgs, array('verb' => 'settings'))),
						$this->getDisplayName()
					),
					__('manager.plugins.settings'),
					null
				),
			):array(),
			parent::getActions($request, $actionArgs)
		);
	}

	/**
	 * @copydoc PKPPlugin::manage()
	 */
	function manage($args, $request) {
		$context = $request->getContext();
		$templateMgr = TemplateManager::getManager($request);

		switch ($request->getUserVar('verb')) {
			case 'showTab':
				switch ($request->getUserVar('tab')) {
					case 'settings':
						$this->import('AddThisSettingsForm');
						$form = new AddThisSettingsForm($this, $context);
						if ($request->getUserVar('save')) {
							$form->readInputData();
							if ($form->validate()) {
								$form->execute();
								return new JSONMessage();
							}
						} else {
							$form->initData();
						}
						return new JSONMessage(true, $form->fetch($request));
					case 'statistics':
						return $templateMgr->fetchJson($this->getTemplateResource('statistics.tpl'));
					default: assert(false);
				}
			case 'settings':
				$templateMgr->assign('statsConfigured', $this->statsConfigured($context));
				$templateMgr->assign('pluginName', $this->getName());
				return $templateMgr->fetchJson($this->getTemplateResource('settingsTabs.tpl'));

		}
		return parent::manage($args, $request);
	}

	/**
	 * Hook against Templates::Catalog::Book::BookInfo::Sharing, for including the
	 * addThis code on submission display.
	 * @param $hookName string
	 * @param $params array
	 */
	function callbackSharingDisplay($hookName, $params) {
		$templateMgr = $params[1];
		$output =& $params[2];

		$request = $this->getRequest();
		$context = $request->getContext();

		$templateMgr->assign('addThisProfileId', $context->getData('addThisProfileId'));
		$templateMgr->assign('addThisUsername', $context->getData('addThisUsername'));
		$templateMgr->assign('addThisPassword', $context->getData('addThisPassword'));
		$templateMgr->assign('addThisDisplayStyle', $context->getData('addThisDisplayStyle'));

		$output .= $templateMgr->fetch($this->getTemplateResource('addThis.tpl'));
		return false;
	}

	/**
	 * Determines if statistics settings have been enabled for this plugin.
	 * @param $context Context
	 * @return boolean
	 */
	function statsConfigured($context) {
		$addThisUsername = $context->getData('addThisUsername');
		$addThisPassword = $context->getData('addThisPassword');
		$addThisProfileId = $context->getData('addThisProfileId');
		return (isset($addThisUsername) && isset($addThisPassword) && isset($addThisProfileId));
	}
}

