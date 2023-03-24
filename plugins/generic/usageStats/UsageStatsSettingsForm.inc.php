<?php

/**
 * @file plugins/generic/usageStats/UsageStatsSettingsForm.inc.php
 *
 * Copyright (c) 2013-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UsageStatsSettingsForm
 * @ingroup plugins_generic_usageStats
 *
 * @brief Form for journal managers to modify usage statistics plugin settings.
 */

import('lib.pkp.classes.form.Form');

class UsageStatsSettingsForm extends Form {

	/** @var $plugin UsageStatsPlugin */
	var $plugin;

	/**
	 * Constructor
	 * @param $plugin UsageStatsPlugin
	 */
	function __construct($plugin) {
		$this->plugin = $plugin;

		parent::__construct($plugin->getTemplateResource('usageStatsSettingsForm.tpl'));
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}

	/**
	 * @copydoc Form::initData()
	 */
	function initData() {
		$plugin = $this->plugin;
		$request = Application::get()->getRequest();
		$context = $request->getContext();
		$this->setData('displayStatistics', $plugin->_getPluginSetting($context, 'displayStatistics'));
		$this->setData('datasetMaxCount', $plugin->_getPluginSetting($context, 'datasetMaxCount'));
		$this->setData('chartType', $plugin->_getPluginSetting($context, 'chartType'));
	}

	/**
	 * @copydoc Form::readInputData()
	 */
	function readInputData() {
		$this->readUserVars(array(
			'displayStatistics',
			'chartType',
			'datasetMaxCount'
		));
	}

	/**
	 * @copydoc Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$templateMgr = TemplateManager::getManager($request);
		$application = Application::get();
		$templateMgr->assign(array(
			'chartTypes' => array(
				'bar' => __('plugins.generic.usageStats.settings.statsDisplayOptions.chartType.bar'),
				'line' => __('plugins.generic.usageStats.settings.statsDisplayOptions.chartType.line'),
			),
			'pluginName' => $this->plugin->getName(),
			'applicationName' => $application->getName(),
		));
		return parent::fetch($request, $template, $display);
	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute(...$functionArgs) {
		$plugin = $this->plugin;

		$request = Application::get()->getRequest();
		$context = $request->getContext();
		$contextId = $context ? $context->getId() : CONTEXT_ID_NONE;
		$plugin->updateSetting($contextId, 'displayStatistics', $this->getData('displayStatistics'), 'bool');
		$plugin->updateSetting($contextId, 'chartType', $this->getData('chartType'));
		$plugin->updateSetting($contextId, 'datasetMaxCount', $this->getData('datasetMaxCount'));

		parent::execute(...$functionArgs);
	}
}
