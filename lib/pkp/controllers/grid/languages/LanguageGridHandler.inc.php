<?php

/**
 * @file controllers/grid/languages/LanguageGridHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class LanguageGridHandler
 * @ingroup classes_controllers_grid_languages
 *
 * @brief Handle language grid requests.
 */

import('lib.pkp.classes.controllers.grid.GridHandler');
import('lib.pkp.controllers.grid.languages.LanguageGridRow');
import('lib.pkp.controllers.grid.languages.LanguageGridCellProvider');

class LanguageGridHandler extends GridHandler {
	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
		$this->addRoleAssignment(
			ROLE_ID_MANAGER,
			array('saveLanguageSetting', 'setContextPrimaryLocale')
		);
	}


	//
	// Implement template methods from PKPHandler.
	//
	/**
	 * @copydoc GridHandler::initialize()
	 */
	function initialize($request, $args = null) {
		parent::initialize($request, $args);

		// Load user-related translations.
		AppLocale::requireComponents(
			LOCALE_COMPONENT_PKP_USER,
			LOCALE_COMPONENT_PKP_MANAGER
		);

		// Basic grid configuration.
		$this->setTitle('common.languages');
	}

	/**
	 * @copydoc GridHandler::getRowInstance()
	 */
	protected function getRowInstance() {
		return new LanguageGridRow();
	}

	//
	// Public handler methods.
	//
	/**
	 * Save language management settings.
	 * @param $args array
	 * @param $request Request
	 * @return JSONObject JSON message
	 */
	function saveLanguageSetting($args, $request) {
		$locale = (string) $request->getUserVar('rowId');
		$settingName = (string) $request->getUserVar('setting');
		$settingValue = (boolean) $request->getUserVar('value');
		$availableLocales = $this->getGridDataElements($request);
		$context = $request->getContext();

		import('classes.core.Services');
		$contextService = Services::get('context');

		$permittedSettings = array('supportedFormLocales', 'supportedSubmissionLocales', 'supportedLocales');
		if (in_array($settingName, $permittedSettings) && $locale) {
			$currentSettingValue = (array) $context->getData($settingName);
			if (AppLocale::isLocaleValid($locale) && array_key_exists($locale, $availableLocales)) {
				if ($settingValue) {
					array_push($currentSettingValue, $locale);
					if ($settingName == 'supportedFormLocales') {
						// reload localized default context settings
						$contextService->restoreLocaleDefaults($context, $request, $locale);
					} elseif ($settingName == 'supportedSubmissionLocales') {
						// if a submission locale is enabled, and this locale is not in the form locales, add it
						$supportedFormLocales = (array) $context->getData('supportedFormLocales');
						if (!in_array($locale, $supportedFormLocales)) {
							array_push($supportedFormLocales, $locale);
							$context = $contextService->edit($context, ['supportedFormLocales' => $supportedFormLocales], $request);
							// reload localized default context settings
							$contextService->restoreLocaleDefaults($context, $request, $locale);
						}
					}
				} else {
					$key = array_search($locale, $currentSettingValue);
					if ($key !== false) unset($currentSettingValue[$key]);
					if ($settingName == 'supportedFormLocales') {
						// if a form locale is disabled, disable it form submission locales as well
						$supportedSubmissionLocales = (array) $context->getData('supportedSubmissionLocales');
						$key = array_search($locale, $supportedSubmissionLocales);
						if ($key !== false) unset($supportedSubmissionLocales[$key]);
						$supportedSubmissionLocales = array_values($supportedSubmissionLocales);
						$context = $contextService->edit($context, ['supportedSubmissionLocales' => $supportedSubmissionLocales], $request);
					}
				}
			}
		}

		$context = $contextService->edit($context, [$settingName => array_values(array_unique($currentSettingValue))], $request);

		$notificationManager = new NotificationManager();
		$user = $request->getUser();
		$notificationManager->createTrivialNotification(
			$user->getId(), NOTIFICATION_TYPE_SUCCESS, array('contents' => __('notification.localeSettingsSaved')));

		$localeNames = AppLocale::getAllLocales();
		$newFormLocales = array_map(function($localeKey) use ($localeNames) {
			return ['key' => $localeKey, 'label' => $localeNames[$localeKey]];
		}, $context->getData('supportedFormLocales'));

		$json = DAO::getDataChangedEvent($locale);
		$json->setGlobalEvent('set-form-languages', $newFormLocales);
		return $json;
	}

	/**
	 * Set context primary locale.
	 * @param $args array
	 * @param $request Request
	 * @return JSONMessage JSON object
	 */
	function setContextPrimaryLocale($args, $request) {
		$locale = (string) $request->getUserVar('rowId');
		$context = $request->getContext();
		$availableLocales = $this->getGridDataElements($request);

		if (AppLocale::isLocaleValid($locale) && array_key_exists($locale, $availableLocales)) {
			// Make sure at least the primary locale is chosen as available
			foreach (array('supportedLocales', 'supportedSubmissionLocales', 'supportedFormLocales') as $name) {
				$$name = $context->getData($name);
				if (!in_array($locale, $$name)) {
					array_push($$name, $locale);
					$context->updateSetting($name, $$name);
				}
			}

			$context->setPrimaryLocale($locale);
			$contextDao = Application::getContextDAO();
			$contextDao->updateObject($context);

			$notificationManager = new NotificationManager();
			$user = $request->getUser();
			$notificationManager->createTrivialNotification(
				$user->getId(), NOTIFICATION_TYPE_SUCCESS, array('contents' => __('notification.localeSettingsSaved')));
		}

		return DAO::getDataChangedEvent();
	}

	//
	// Protected methods.
	//
	/**
	 * Return an instance of the cell provider
	 * used by this grid.
	 * @return GridCellProvider
	 */
	function getCellProvider() {
		return new LanguageGridCellProvider();
	}

	/**
	 * Add name column.
	 */
	function addNameColumn() {
		$cellProvider = $this->getCellProvider();

		// Locale name.
		$this->addColumn(
			new GridColumn(
				'locale',
				'grid.columns.locale',
				null,
				'controllers/grid/languages/localeNameCell.tpl',
				$cellProvider
			)
		);
	}

	/**
	 * Add primary column.
	 * @param $columnId string The column id.
	 */
	function addPrimaryColumn($columnId) {
		$cellProvider = $this->getCellProvider();

		$this->addColumn(
			new GridColumn(
				$columnId,
				'locale.primary',
				null,
				'controllers/grid/common/cell/radioButtonCell.tpl',
				$cellProvider
			)
		);
	}

	/**
	 * Add columns related to management settings.
	 */
	function addManagementColumns() {
		$cellProvider = $this->getCellProvider();
		$this->addColumn(
			new GridColumn(
				'uiLocale',
				'manager.language.ui',
				null,
				'controllers/grid/common/cell/selectStatusCell.tpl',
				$cellProvider
			)
		);

		$this->addColumn(
			new GridColumn(
				'formLocale',
				'manager.language.forms',
				null,
				'controllers/grid/common/cell/selectStatusCell.tpl',
				$cellProvider
			)
		);

		$this->addColumn(
			new GridColumn(
				'submissionLocale',
				'manager.language.submissions',
				null,
				'controllers/grid/common/cell/selectStatusCell.tpl',
				$cellProvider
			)
		);
	}

	/**
	 * Add data related to management settings.
	 * @param $request Request
	 * @param $data Array Data already loaded.
	 * @return Array Same passed array, but with
	 * the extra management data inserted.
	 */
	function addManagementData($request, $data) {
		$context = $request->getContext();

		if (is_array($data)) {
			foreach ($data as $locale => $localeData) {
				foreach (array('supportedFormLocales', 'supportedSubmissionLocales', 'supportedLocales') as $name) {
					$data[$locale][$name] = in_array($locale, $context->getData($name));
					// $data[$locale][$name] = in_array($locale, (array) $context->getData($name));
				}
			}
		} else {
			assert(false);
		}

		return $data;
	}
}
