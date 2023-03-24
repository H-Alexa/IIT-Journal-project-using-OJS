<?php

/**
 * @file controllers/grid/admin/context/ContextGridHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ContextGridHandler
 * @ingroup controllers_grid_admin_context
 *
 * @brief Handle context grid requests.
 */

import('lib.pkp.classes.controllers.grid.GridHandler');
import('lib.pkp.controllers.grid.admin.context.ContextGridRow');

class ContextGridHandler extends GridHandler {
	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
		$this->addRoleAssignment(array(
			ROLE_ID_SITE_ADMIN),
			array('fetchGrid', 'fetchRow', 'createContext', 'editContext', 'updateContext', 'users',
				'deleteContext', 'saveSequence')
		);
	}


	//
	// Implement template methods from PKPHandler.
	//
	/**
	 * @copydoc PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
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
	 * @copydoc GridHandler::initialize()
	 */
	function initialize($request, $args = null) {
		parent::initialize($request, $args);

		// Load user-related translations.
		AppLocale::requireComponents(
			LOCALE_COMPONENT_PKP_USER,
			LOCALE_COMPONENT_APP_MANAGER,
			LOCALE_COMPONENT_PKP_MANAGER,
			LOCALE_COMPONENT_PKP_ADMIN,
			LOCALE_COMPONENT_APP_ADMIN
		);

		$this->setTitle('context.contexts');

		// Grid actions.
		$router = $request->getRouter();

		import('lib.pkp.classes.linkAction.request.AjaxModal');
		$this->addAction(
			new LinkAction(
				'createContext',
				new AjaxModal(
					$router->url($request, null, null, 'createContext', null, null),
					__('admin.contexts.create'),
					'modal_add_item',
					true,
					'context',
					['editContext']
				),
				__('admin.contexts.create'),
				'add_item'
			)
		);

		//
		// Grid columns.
		//
		import('lib.pkp.controllers.grid.admin.context.ContextGridCellProvider');
		$contextGridCellProvider = new ContextGridCellProvider();

		// Context name.
		$this->addColumn(
			new GridColumn(
				'name',
				'common.name',
				null,
				null,
				$contextGridCellProvider
			)
		);

		// Context path.
		$this->addColumn(
			new GridColumn(
				'urlPath',
				'context.path',
				null,
				null,
				$contextGridCellProvider
			)
		);
	}


	//
	// Implement methods from GridHandler.
	//
	/**
	 * @copydoc GridHandler::getRowInstance()
	 * @return UserGridRow
	 */
	protected function getRowInstance() {
		return new ContextGridRow();
	}

	/**
	 * @copydoc GridHandler::loadData()
	 */
	protected function loadData($request, $filter = null) {
		// Get all contexts.
		$contextDao = Application::getContextDAO();
		$contexts = $contextDao->getAll();

		return $contexts->toAssociativeArray();
	}

	/**
	 * @copydoc GridHandler::setDataElementSequence()
	 */
	function setDataElementSequence($request, $rowId, $gridDataElement, $newSequence) {
		$contextDao = Application::getContextDAO();
		$gridDataElement->setSequence($newSequence);
		$contextDao->updateObject($gridDataElement);
	}

	/**
	 * @copydoc GridHandler::getDataElementSequence()
	 */
	function getDataElementSequence($gridDataElement) {
		return $gridDataElement->getSequence();
	}

	/**
	 * @copydoc GridHandler::addFeatures()
	 */
	function initFeatures($request, $args) {
		import('lib.pkp.classes.controllers.grid.feature.OrderGridItemsFeature');
		return array(new OrderGridItemsFeature());
	}

	/**
	 * Get the list of "publish data changed" events.
	 * Used to update the site context switcher upon create/delete.
	 * @return array
	 */
	function getPublishChangeEvents() {
		return array('updateHeader');
	}


	//
	// Public grid actions.
	//
	/**
	 * Add a new context.
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function createContext($args, $request) {
		// Calling editContext with an empty row id will add a new context.
		return $this->editContext($args, $request);
	}

	/**
	 * Edit an existing context.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function editContext($args, $request) {
		import('classes.core.Services');
		$contextService = Services::get('context');
		$context = null;

		if ($request->getUserVar('rowId')) {
			$context = $contextService->get((int) $request->getUserVar('rowId'));
			if (!$context) {
				return new JSONMessage(false);
			}
		}

		$dispatcher = $request->getDispatcher();
		if ($context) {
			$apiUrl = $dispatcher->url($request, ROUTE_API, $context->getPath(), 'contexts/' . $context->getId());
			$supportedLocales = $context->getSupportedFormLocales();
		} else {
			$apiUrl = $dispatcher->url($request, ROUTE_API, CONTEXT_ID_ALL, 'contexts');
			$supportedLocales = $request->getSite()->getSupportedLocales();
		}

		$localeNames = AppLocale::getAllLocales();
		$locales = array_map(function($localeKey) use ($localeNames) {
			return ['key' => $localeKey, 'label' => $localeNames[$localeKey]];
		}, $supportedLocales);

		$contextForm = new \APP\components\forms\context\ContextForm($apiUrl, $locales, $request->getBaseUrl(), $context);
		$contextFormConfig = $contextForm->getConfig();

		// Pass the URL to the context settings wizard so that the AddContextForm
		// component can redirect to it when a new context is added.
		if (!$context) {
			$contextFormConfig['editContextUrl'] = $request->getDispatcher()->url($request, ROUTE_PAGE, 'index', 'admin', 'wizard', '__id__');
		}

		$containerData = [
			'components' => [
				FORM_CONTEXT => $contextFormConfig,
			],
		];

		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign([
			'containerData' => $containerData,
			'isAddingNewContext' => !$context,
		]);

		return new JSONMessage(true, $templateMgr->fetch('admin/editContext.tpl'));
	}

	/**
	 * Delete a context.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function deleteContext($args, $request) {

		if (!$request->checkCSRF()) {
			return new JSONMessage(false);
		}

		import('classes.core.Services');
		$contextService = Services::get('context');

		$context = $contextService->get((int) $request->getUserVar('rowId'));

		if (!$context) {
			return new JSONMessage(false);
		}

		$contextService->delete($context);

		return DAO::getDataChangedEvent($context->getId());
	}

	/**
	 * Display users management grid for the given context.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function users($args, $request) {
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('oldUserId', (int) $request->getUserVar('oldUserId')); // for merging users.
		parent::setupTemplate($request);
		return $templateMgr->fetchJson('management/accessUsers.tpl');
	}
}
