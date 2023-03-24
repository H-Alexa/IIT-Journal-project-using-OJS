<?php

/**
 * @file controllers/grid/admin/languages/AdminLanguageGridHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class AdminLanguageGridHandler
 * @ingroup controllers_grid_admin_languages
 *
 * @brief Handle administrative language grid requests. If in single context (e.g.
 * press) installation, this grid can also handle language management requests.
 * See _canManage().
 */

import('lib.pkp.controllers.grid.languages.LanguageGridHandler');
import('lib.pkp.controllers.grid.languages.LanguageGridRow');
import('lib.pkp.controllers.grid.languages.form.InstallLanguageForm');

class AdminLanguageGridHandler extends LanguageGridHandler {
	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
		$this->addRoleAssignment(
			array(ROLE_ID_SITE_ADMIN),
			array(
				'fetchGrid', 'fetchRow',
				'installLocale', 'saveInstallLocale', 'uninstallLocale',
				'disableLocale', 'enableLocale', 'setPrimaryLocale'
			)
		);
	}


	//
	// Implement template methods from PKPHandler.
	//
	/**
	 * @copydoc GridHandler::authorize()
	 */
	public function authorize($request, &$args, $roleAssignments) {
		import('lib.pkp.classes.security.authorization.PolicySet');
		$rolePolicy = new PolicySet(COMBINING_PERMIT_OVERRIDES);

		import('lib.pkp.classes.security.authorization.RoleBasedHandlerOperationPolicy');
		foreach($roleAssignments as $role => $operations) {
			$rolePolicy->addPolicy(new RoleBasedHandlerOperationPolicy($request, $role, $operations));
		}
		$this->addPolicy($rolePolicy);

		return parent::authorize($request, $args, $roleAssignments);
	}

	/**
	 * @copydoc LanguageGridHandler::initialize()
	 */
	public function initialize($request, $args = null) {
		parent::initialize($request, $args);

		AppLocale::requireComponents(
			LOCALE_COMPONENT_PKP_ADMIN,
			LOCALE_COMPONENT_PKP_MANAGER,
			LOCALE_COMPONENT_APP_MANAGER,
			LOCALE_COMPONENT_APP_ADMIN
		);

		// Grid actions.
		$router = $request->getRouter();

		import('lib.pkp.classes.linkAction.request.AjaxModal');
		$this->addAction(
			new LinkAction(
				'installLocale',
				new AjaxModal(
					$router->url($request, null, null, 'installLocale', null, null),
					__('admin.languages.installLocale'),
					null,
					true
					),
				__('admin.languages.installLocale'),
				'add')
		);

		// Columns.
		// Enable locale.
		$this->addColumn(
			new GridColumn(
				'enable',
				'common.enable',
				null,
				'controllers/grid/common/cell/selectStatusCell.tpl',
				$this->getCellProvider(),
				array('width' => 10)
			)
		);

		// Locale name.
		$this->addNameColumn();

		// Primary locale.
		if ($this->_canManage($request)) {
			$primaryId = 'contextPrimary';
		} else {
			$primaryId = 'sitePrimary';
		}
		$this->addPrimaryColumn($primaryId);

		if ($this->_canManage($request)) {
			$this->addManagementColumns();
		}

		$this->setFootNote('admin.locale.maybeIncomplete');
	}


	//
	// Implement methods from GridHandler.
	//
	/**
	 * @copydoc GridHandler::loadData()
	 */
	protected function loadData($request, $filter) {
		$site = $request->getSite();
		$data = array();

		$allLocales = AppLocale::getAllLocales();
		$installedLocales = $site->getInstalledLocales();
		$supportedLocales = $site->getSupportedLocales();
		$primaryLocale = $site->getPrimaryLocale();

		foreach($installedLocales as $localeKey) {
			$data[$localeKey] = array();
			$data[$localeKey]['name'] = $allLocales[$localeKey];
			$data[$localeKey]['incomplete'] = !AppLocale::isLocaleComplete($localeKey);
			if (in_array($localeKey, $supportedLocales)) {
				$supported = true;
			} else {
				$supported = false;
			}
			$data[$localeKey]['supported'] = $supported;

			if ($this->_canManage($request)) {
				$context = $request->getContext();
				$primaryLocale = $context->getPrimaryLocale();
			}

			if ($localeKey == $primaryLocale) {
				$primary = true;
			} else {
				$primary = false;
			}
			$data[$localeKey]['primary'] = $primary;
		}

		if ($this->_canManage($request)) {
			$data = $this->addManagementData($request, $data);
		}

		return $data;
	}


	//
	// Public grid actions.
	//
	/**
	 * Open a form to select locales for installation.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	public function installLocale($args, $request) {
		// Form handling.
		$installLanguageForm = new InstallLanguageForm();
		$installLanguageForm->initData();
		return new JSONMessage(true, $installLanguageForm->fetch($request));

	}

	/**
	 * Save the install language form.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	public function saveInstallLocale($args, $request) {
		$installLanguageForm = new InstallLanguageForm();
		$installLanguageForm->readInputData();

		if ($installLanguageForm->validate()) {
			$installLanguageForm->execute();
			$this->_updateContextLocaleSettings($request);

			$notificationManager = new NotificationManager();
			$user = $request->getUser();
			$notificationManager->createTrivialNotification(
				$user->getId(), NOTIFICATION_TYPE_SUCCESS,
				array('contents' => __('notification.localeInstalled'))
			);
		}
		return DAO::getDataChangedEvent();
	}

	/**
	 * Uninstall a locale.
	 * @param $args array
	 * @param $request Request
	 * @return JSONMessage JSON object
	 */
	public function uninstallLocale($args, $request) {
		$site = $request->getSite();
		$locale = $request->getUserVar('rowId');
		$gridData = $this->getGridDataElements($request);

		if ($request->checkCSRF() && array_key_exists($locale, $gridData)) {
			$localeData = $gridData[$locale];
			if ($localeData['primary']) return new JSONMessage(false);

			$installedLocales = $site->getInstalledLocales();
			if (in_array($locale, $installedLocales)) {
				$installedLocales = array_diff($installedLocales, array($locale));
				$site->setInstalledLocales($installedLocales);
				$supportedLocales = $site->getSupportedLocales();
				$supportedLocales = array_diff($supportedLocales, array($locale));
				$site->setSupportedLocales($supportedLocales);
				$siteDao = DAORegistry::getDAO('SiteDAO'); /* @var $siteDao SiteDAO */
				$siteDao->updateObject($site);

				$this->_updateContextLocaleSettings($request);
				AppLocale::uninstallLocale($locale);

				$notificationManager = new NotificationManager();
				$user = $request->getUser();
				$notificationManager->createTrivialNotification(
					$user->getId(), NOTIFICATION_TYPE_SUCCESS,
					array('contents' => __('notification.localeUninstalled', array('locale' => $localeData['name'])))
				);
			}
			return DAO::getDataChangedEvent($locale);
		}

		return new JSONMessage(false);
	}

	/**
	 * Enable an existing locale.
	 * @param $args array
	 * @param $request Request
	 * @return JSONMessage JSON object
	 */
	public function enableLocale($args, $request) {
		$rowId = $request->getUserVar('rowId');
		$gridData = $this->getGridDataElements($request);

		if (array_key_exists($rowId, $gridData)) {
			$this->_updateLocaleSupportState($request, $rowId, true);

			$notificationManager = new NotificationManager();
			$user = $request->getUser();
			$notificationManager->createTrivialNotification(
				$user->getId(), NOTIFICATION_TYPE_SUCCESS,
				array('contents' => __('notification.localeEnabled'))
			);
		}

		return DAO::getDataChangedEvent($rowId);
	}

	/**
	 * Disable an existing locale.
	 * @param $args array
	 * @param $request Request
	 * @return JSONMessage JSON object
	 */
	public function disableLocale($args, $request) {
		$locale = $request->getUserVar('rowId');
		$gridData = $this->getGridDataElements($request);
		$notificationManager = new NotificationManager();
		$user = $request->getUser();

		if ($request->checkCSRF() && array_key_exists($locale, $gridData)) {
			// Don't disable primary locales.
			if ($gridData[$locale]['primary']) {
				$notificationManager->createTrivialNotification(
					$user->getId(), NOTIFICATION_TYPE_ERROR,
					array('contents' => __('admin.languages.cantDisable'))
				);
			} else {
				$this->_updateLocaleSupportState($request, $locale, false);
				$notificationManager->createTrivialNotification(
					$user->getId(), NOTIFICATION_TYPE_SUCCESS,
					array('contents' => __('notification.localeDisabled'))
				);
			}
			return DAO::getDataChangedEvent($locale);
		}

		return new JSONMessage(false);
	}


	/**
	 * Set primary locale.
	 * @param $args array
	 * @param $request Request
	 * @return JSONMessage JSON object
	 */
	public function setPrimaryLocale($args, $request) {
		$rowId = $request->getUserVar('rowId');
		$gridData = $this->getGridDataElements($request);
		$localeData = $gridData[$rowId];
		$notificationManager = new NotificationManager();
		$user = $request->getUser();
		$site = $request->getSite();

		if (array_key_exists($rowId, $gridData)) {
			if (AppLocale::isLocaleValid($rowId)) {
				$oldSitePrimaryLocale = $site->getPrimaryLocale();
				$userDao = DAORegistry::getDAO('UserDAO'); /* @var $userDao UserDAO */
				$userDao->changeSitePrimaryLocale($oldSitePrimaryLocale, $rowId);
				$site->setPrimaryLocale($rowId);
				$siteDao = DAORegistry::getDAO('SiteDAO'); /* @var $siteDao SiteDAO */
				$siteDao->updateObject($site);

				$notificationManager->createTrivialNotification(
					$user->getId(), NOTIFICATION_TYPE_SUCCESS,
					array('contents' => __('notification.primaryLocaleDefined', array('locale' => $localeData['name'])))
				);
			}
		}

		// Need to refresh whole grid to remove the check in others
		// primary locale radio buttons.
		return DAO::getDataChangedEvent();
	}


	//
	// Helper methods.
	//
	/**
	 * Update the locale support state (enabled or disabled).
	 * @param $request Request
	 * @param $rowId string The locale row id.
	 * @param $enable boolean Enable locale flag.
	 */
	protected function _updateLocaleSupportState($request, $rowId, $enable) {
		$newSupportedLocales = array();
		$gridData = $this->getGridDataElements($request);

		foreach ($gridData as $locale => $data) {
			if ($data['supported']) {
				array_push($newSupportedLocales, $locale);
			}
		}

		if (AppLocale::isLocaleValid($rowId)) {
			if ($enable) {
				array_push($newSupportedLocales, $rowId);
			} else {
				$key = array_search($rowId, $newSupportedLocales);
				if ($key !== false) unset($newSupportedLocales[$key]);
			}
		}

		$site = $request->getSite();
		$site->setSupportedLocales($newSupportedLocales);

		$siteDao = DAORegistry::getDAO('SiteDAO'); /* @var $siteDao SiteDAO */
		$siteDao->updateObject($site);

		$this->_updateContextLocaleSettings($request);
	}

	/**
	 * Helper function to update locale settings in all
	 * installed contexts, based on site locale settings.
	 * @param $request object
	 */
	protected function _updateContextLocaleSettings($request) {
		$site = $request->getSite();
		$siteSupportedLocales = $site->getSupportedLocales();
		$contextService = \Services::get('context');

		$contextDao = Application::getContextDAO();
		$contexts = $contextDao->getAll();
		while ($context = $contexts->next()) {
			$params = [];
			$primaryLocale = $context->getPrimaryLocale();
			foreach (array('supportedLocales', 'supportedFormLocales', 'supportedSubmissionLocales') as $settingName) {
				$localeList = $context->getData($settingName);

				if (is_array($localeList)) {
					$params[$settingName] = array_intersect($localeList, $siteSupportedLocales);
				}
			}
			if (!in_array($primaryLocale, $siteSupportedLocales)) {
				$params['primaryLocale'] = $site->getPrimaryLocale();
				$primaryLocale = $params['primaryLocale'];
			}
			$errors = $contextService->validate(VALIDATE_ACTION_EDIT, $params, $params['supportedLocales'], $primaryLocale);
			// If there are errors, it's too late to do anything about it
			assert(empty($errors));
			$contextService->edit($context, $params, $request);
		}
	}

	/**
	 * This grid can also present management functions
	 * if the conditions above are true.
	 * @param $request Request
	 * @return boolean
	 */
	protected function _canManage($request) {
		$contextDao = Application::getContextDAO();
		$contexts = $contextDao->getAll();
		$userRoles = $this->getAuthorizedContextObject(ASSOC_TYPE_USER_ROLES);
		list($firstContext, $secondContext) = [$contexts->next(), $contexts->next()];
		return ($firstContext && !$secondContext && $request->getContext() && in_array(ROLE_ID_MANAGER, $userRoles));
	}
}
