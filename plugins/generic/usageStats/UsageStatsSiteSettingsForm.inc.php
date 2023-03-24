<?php

/**
 * @file plugins/generic/usageStats/UsageStatsSiteSettingsForm.inc.php
 *
 * Copyright (c) 2013-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UsageStatsSiteSettingsForm
 * @ingroup plugins_generic_usageStats
 *
 * @brief Form for journal managers to modify usage statistics plugin settings.
 */

import('lib.pkp.classes.form.Form');

class UsageStatsSiteSettingsForm extends Form {

	/** @var $plugin UsageStatsPlugin */
	var $plugin;

	/**
	 * Constructor
	 * @param $plugin UsageStatsPlugin
	 */
	function __construct($plugin) {
		$this->plugin = $plugin;

		parent::__construct($plugin->getTemplateResource('usageStatsSiteSettingsForm.tpl'));
		$this->addCheck(new FormValidatorCustom($this, 'dataPrivacyOption', FORM_VALIDATOR_OPTIONAL_VALUE, 'plugins.generic.usageStats.settings.dataPrivacyOption.requiresSalt', array(&$this, '_dependentFormFieldIsSet'), array(&$this, 'saltFilepath')));
		$this->addCheck(new FormValidatorCustom($this, 'dataPrivacyOption', FORM_VALIDATOR_OPTIONAL_VALUE, 'plugins.generic.usageStats.settings.dataPrivacyOption.excludesRegion', array(&$this, '_dependentFormFieldIsSet'), array(&$this, 'selectedOptionalColumns', STATISTICS_DIMENSION_REGION), true));
		$this->addCheck(new FormValidatorCustom($this, 'dataPrivacyOption', FORM_VALIDATOR_OPTIONAL_VALUE, 'plugins.generic.usageStats.settings.dataPrivacyOption.excludesCity', array(&$this, '_dependentFormFieldIsSet'), array(&$this, 'selectedOptionalColumns', STATISTICS_DIMENSION_CITY), true));
		$this->addCheck(new FormValidatorCustom($this, 'saltFilepath', FORM_VALIDATOR_OPTIONAL_VALUE, 'plugins.generic.usageStats.settings.dataPrivacyOption.saltFilepath.invalid', array(&$plugin, 'validateSaltpath')));
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}

	/**
	 * @copydoc Form::initData()
	 */
	function initData() {
		$plugin = $this->plugin;

		$this->setData('createLogFiles', $plugin->getSetting(CONTEXT_ID_NONE, 'createLogFiles'));
		$this->setData('accessLogFileParseRegex', $plugin->getSetting(CONTEXT_ID_NONE, 'accessLogFileParseRegex'));
		$this->setData('dataPrivacyOption', $plugin->getSetting(CONTEXT_ID_NONE, 'dataPrivacyOption'));
		$this->setData('saltFilepath', $plugin->getSaltPath());
		$this->setData('selectedOptionalColumns', $plugin->getSetting(CONTEXT_ID_NONE, 'optionalColumns'));
		$this->setData('compressArchives', $plugin->getSetting(CONTEXT_ID_NONE, 'compressArchives'));

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
			'createLogFiles',
			'accessLogFileParseRegex',
			'dataPrivacyOption',
			'optionalColumns',
			'compressArchives',
			'saltFilepath',
			'displayStatistics',
			'chartType',
			'datasetMaxCount'
		));
		$this->setData('selectedOptionalColumns', $this->getData('optionalColumns'));
	}

	/**
	 * @copydoc Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$templateMgr = TemplateManager::getManager($request);
		$saltFilepath = Config::getVar('usageStats', 'salt_filepath');
		$application = Application::get();
		$templateMgr->assign(array(
			'chartTypes' => array(
				'bar' => __('plugins.generic.usageStats.settings.statsDisplayOptions.chartType.bar'),
				'line' => __('plugins.generic.usageStats.settings.statsDisplayOptions.chartType.line'),
			),
			'pluginName' => $this->plugin->getName(),
			'saltFilepath' => $saltFilepath && file_exists($saltFilepath) && is_writable($saltFilepath),
			'optionalColumnsOptions' => $this->getOptionalColumnsList(),
			'applicationName' => $application->getName(),
		));
		if (!$this->getData('selectedOptionalColumns')) {
			$this->setData('selectedOptionalColumns', array());
		}
		return parent::fetch($request, $template, $display);
	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute(...$functionArgs) {
		$plugin = $this->plugin;

		$plugin->updateSetting(CONTEXT_ID_NONE, 'createLogFiles', $this->getData('createLogFiles'), 'bool');
		$plugin->updateSetting(CONTEXT_ID_NONE, 'accessLogFileParseRegex', $this->getData('accessLogFileParseRegex'));
		$plugin->updateSetting(CONTEXT_ID_NONE, 'dataPrivacyOption', $this->getData('dataPrivacyOption'), 'bool');
		$plugin->updateSetting(CONTEXT_ID_NONE, 'compressArchives', $this->getData('compressArchives'), 'bool');
		$plugin->updateSetting(CONTEXT_ID_NONE, 'saltFilepath', $this->getData('saltFilepath'));

		$request = Application::get()->getRequest();
		$context = $request->getContext();
		$contextId = $context ? $context->getId() : CONTEXT_ID_NONE;
		$plugin->updateSetting($contextId, 'displayStatistics', $this->getData('displayStatistics'), 'bool');
		$plugin->updateSetting($contextId, 'chartType', $this->getData('chartType'));
		$plugin->updateSetting($contextId, 'datasetMaxCount', $this->getData('datasetMaxCount'));

		$optionalColumns = $this->getData('optionalColumns');
		// Make sure optional columns data makes sense.
		if ($optionalColumns && in_array(STATISTICS_DIMENSION_CITY, $optionalColumns) && !in_array(STATISTICS_DIMENSION_REGION, $optionalColumns)) {
			$user = $request->getUser();
			import('classes.notification.NotificationManager');
			$notificationManager = new NotificationManager();
			$notificationManager->createTrivialNotification(
				$user->getId(), NOTIFICATION_TYPE_WARNING, array('contents' => __('plugins.generic.usageStats.settings.optionalColumns.cityRequiresRegion'))
			);
			$optionalColumns[] = STATISTICS_DIMENSION_REGION;
			$optionalColumns[] = STATISTICS_DIMENSION_REGION;
		}
		$plugin->updateSetting(CONTEXT_ID_NONE, 'optionalColumns', $optionalColumns);

		parent::execute(...$functionArgs);
	}

	/**
	 * Get optional columns list.
	 * @return array
	 */
	function getOptionalColumnsList() {
		import('classes.statistics.StatisticsHelper');
		$statsHelper = new StatisticsHelper();
		$plugin = $this->plugin;
		$reportPlugin = $plugin->getReportPlugin();
		$metricType = $reportPlugin->getMetricTypes();
		$optionalColumns = $reportPlugin->getOptionalColumns($metricType);
		$columnsList = array();
		foreach ($optionalColumns as $column) {
			$columnsList[$column] = $statsHelper->getColumnNames($column);
		}
		return $columnsList;
	}

	/**
	 * Check for the presence of dependent fields if a field value is set
	 * The Complement call will enforce a dependent value as unset if a field value is set
	 * @param $fieldValue mixed the value of the field being checked
	 * @param $form object a reference to this form
	 * @param $dependentFieldName string the name of the dependent field
	 * @param $expectedValue mixed if provided, the expected value which must be in the dependent field
	 * @return boolean
	 */
	function _dependentFormFieldIsSet($fieldValue, $form, $dependentFieldName, $expectedValue = null) {
		if ($fieldValue) {
			$dependentValue = $form->getData($dependentFieldName);
			if ($dependentValue) {
				if ($expectedValue) {
					// Check the expected value against the dependent value
					if (is_array($dependentValue)) {
						return in_array($expectedValue, $dependentValue, true);
					} else {
						return $dependentValue === $expectedValue;
					}
				} else {
					// Field was set and any dependent value is allowed
					return true;
				}
			} else {
				// Field was set but no dependent value was set
				return false;
			}
		} else {
			// This is false so the complement call will be true when checking a negative dependency
			// e.g., if $fieldValue, $dependentFieldName can't contain $expectedValue
			return false;
		}
	}
}

