<?php

/**
 * @file controllers/grid/queries/QueriesGridHandler.inc.php
 *
 * Copyright (c) 2016-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class QueriesGridHandler
 * @ingroup controllers_grid_query
 *
 * @brief base PKP class to handle query grid requests.
 */

// import grid base classes
import('lib.pkp.classes.controllers.grid.GridHandler');

// Link action & modal classes
import('lib.pkp.classes.linkAction.request.AjaxModal');

class QueriesGridHandler extends GridHandler {

	/** @var integer WORKFLOW_STAGE_ID_... */
	var $_stageId;

	/** @var PKPRequest */
	var $_request;

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
		$this->addRoleAssignment(
			array(ROLE_ID_MANAGER, ROLE_ID_SUB_EDITOR, ROLE_ID_ASSISTANT, ROLE_ID_REVIEWER, ROLE_ID_AUTHOR),
			array('fetchGrid', 'fetchRow', 'readQuery', 'participants', 'addQuery', 'editQuery', 'updateQuery', 'deleteQuery'));
		$this->addRoleAssignment(
			array(ROLE_ID_MANAGER, ROLE_ID_SUB_EDITOR, ROLE_ID_ASSISTANT),
			array('openQuery', 'closeQuery', 'saveSequence'));
		$this->addRoleAssignment(
			array(ROLE_ID_MANAGER),
			array('leaveQuery'));
	}


	//
	// Getters/Setters
	//
	/**
	 * Get the authorized submission.
	 * @return Submission
	 */
	function getSubmission() {
		return $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
	}

	/**
	 * Get the authorized query.
	 * @return Query
	 */
	function getQuery() {
		return $this->getAuthorizedContextObject(ASSOC_TYPE_QUERY);
	}

	/**
	 * Get the stage id.
	 * @return integer
	 */
	function getStageId() {
		return $this->_stageId;
	}

	/**
	 * Get the query assoc type.
	 * @return int ASSOC_TYPE_...
	 */
	function getAssocType() {
		return ASSOC_TYPE_SUBMISSION;
	}

	/**
	 * Get the query assoc ID.
	 * @return int
	 */
	function getAssocId() {
		return $this->getSubmission()->getId();
	}

	/**
	 * Create and return a data provider for this grid.
	 * @return GridCellProvider
	 */
	function getCellProvider() {
		import('lib.pkp.controllers.grid.queries.QueriesGridCellProvider');
		return new QueriesGridCellProvider(
			$this->getSubmission(),
			$this->getStageId(),
			$this->getAccessHelper()
		);
	}


	//
	// Overridden methods from PKPHandler.
	// Note: this is subclassed in application-specific grids.
	//
	/**
	 * @copydoc PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
		$this->_stageId = (int) $request->getUserVar('stageId'); // This is being validated in WorkflowStageAccessPolicy

		$this->_request = $request;

		if ($request->getUserVar('queryId')) {
			import('lib.pkp.classes.security.authorization.QueryAccessPolicy');
			$this->addPolicy(new QueryAccessPolicy($request, $args, $roleAssignments, $this->_stageId));
		} else {
			import('lib.pkp.classes.security.authorization.QueryWorkflowStageAccessPolicy');
			$this->addPolicy(new QueryWorkflowStageAccessPolicy($request, $args, $roleAssignments, 'submissionId', $this->_stageId));
		}

		return parent::authorize($request, $args, $roleAssignments);
	}

	/**
	 * @copydoc GridHandler::initialize()
	 */
	function initialize($request, $args = null) {
		parent::initialize($request, $args);
		import('lib.pkp.controllers.grid.queries.QueriesGridCellProvider');

		switch ($this->getStageId()) {
			case WORKFLOW_STAGE_ID_SUBMISSION: $this->setTitle('submission.queries.submission'); break;
			case WORKFLOW_STAGE_ID_EDITING: $this->setTitle('submission.queries.editorial'); break;
			case WORKFLOW_STAGE_ID_PRODUCTION: $this->setTitle('submission.queries.production'); break;
			case WORKFLOW_STAGE_ID_INTERNAL_REVIEW:
			case WORKFLOW_STAGE_ID_EXTERNAL_REVIEW:
				$this->setTitle('submission.queries.review');
				break;
			default: assert(false);
		}

		// Load pkp-lib translations
		AppLocale::requireComponents(
			LOCALE_COMPONENT_PKP_SUBMISSION,
			LOCALE_COMPONENT_PKP_USER,
			LOCALE_COMPONENT_PKP_EDITOR,
			LOCALE_COMPONENT_APP_SUBMISSION
		);

		// Columns
		import('lib.pkp.controllers.grid.queries.QueryTitleGridColumn');
		$cellProvider = $this->getCellProvider();
		$this->addColumn(new QueryTitleGridColumn($this->getRequestArgs()));

		$this->addColumn(new GridColumn(
			'from',
			'submission.query.from',
			null,
			null,
			$cellProvider,
			array('html' => TRUE, 'width' => 20)
		));
		$this->addColumn(new GridColumn(
			'lastReply',
			'submission.query.lastReply',
			null,
			null,
			$cellProvider,
			array('html' => TRUE, 'width' => 20)
		));
		$this->addColumn(new GridColumn(
			'replies',
			'submission.query.replies',
			null,
			null,
			$cellProvider,
			array('width' => 10, 'alignment' => COLUMN_ALIGNMENT_CENTER)
		));

		$this->addColumn(
			new GridColumn(
				'closed',
				'submission.query.closed',
				null,
				'controllers/grid/common/cell/selectStatusCell.tpl',
				$cellProvider,
				array('width' => 10, 'alignment' => COLUMN_ALIGNMENT_CENTER)
			)
		);

		$router = $request->getRouter();
		if ($this->getAccessHelper()->getCanCreate($this->getStageId())) $this->addAction(new LinkAction(
			'addQuery',
			new AjaxModal(
				$router->url($request, null, null, 'addQuery', null, $this->getRequestArgs()),
				__('grid.action.addQuery'),
				'modal_add_item'
			),
			__('grid.action.addQuery'),
			'add_item'
		));
	}


	//
	// Overridden methods from GridHandler
	//
	/**
	 * @copydoc GridHandler::initFeatures()
	 */
	function initFeatures($request, $args) {
		$features = parent::initFeatures($request, $args);
		if ($this->getAccessHelper()->getCanOrder($this->getStageId())) {
			import('lib.pkp.classes.controllers.grid.feature.OrderGridItemsFeature');
			$features[] = new OrderGridItemsFeature();
		}
		return $features;
	}

	/**
	 * @copydoc GridHandler::getDataElementSequence()
	 */
	function getDataElementSequence($row) {
		return $row->getSequence();
	}

	/**
	 * @copydoc GridHandler::setDataElementSequence()
	 */
	function setDataElementSequence($request, $rowId, $gridDataElement, $newSequence) {
		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$query = $queryDao->getById($rowId, $this->getAssocType(), $this->getAssocId());
		$query->setSequence($newSequence);
		$queryDao->updateObject($query);
	}

	/**
	 * @copydoc GridHandler::getRowInstance()
	 * @return QueriesGridRow
	 */
	function getRowInstance() {
		import('lib.pkp.controllers.grid.queries.QueriesGridRow');
		return new QueriesGridRow(
			$this->getSubmission(),
			$this->getStageId(),
			$this->getAccessHelper()
		);
	}

	/**
	 * Get an instance of the queries grid access helper
	 * @return QueriesGridAccessHelper
	 */
	function getAccessHelper() {
		import('lib.pkp.controllers.grid.queries.QueriesAccessHelper');
		return new QueriesAccessHelper($this->getAuthorizedContext(), $this->_request->getUser());
	}

	/**
	 * Get the arguments that will identify the data in the grid.
	 * Overridden by child grids.
	 * @return array
	 */
	function getRequestArgs() {
		return array(
			'submissionId' => $this->getSubmission()->getId(),
			'stageId' => $this->getStageId(),
		);
	}

	/**
	 * @copydoc GridHandler::loadData()
	 */
	function loadData($request, $filter = null) {
		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		return $queryDao->getByAssoc(
			$this->getAssocType(),
			$this->getAssocId(),
			$this->getStageId(),
			$this->getAccessHelper()->getCanListAll($this->getStageId())?null:$request->getUser()->getId()
		);
	}

	//
	// Public Query Grid Actions
	//
	/**
	 * Add a query
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function addQuery($args, $request) {
		if (!$this->getAccessHelper()->getCanCreate($this->getStageId())) return new JSONMessage(false);

		import('lib.pkp.controllers.grid.queries.form.QueryForm');
		$queryForm = new QueryForm(
			$request,
			$this->getAssocType(),
			$this->getAssocId(),
			$this->getStageId()
		);
		$queryForm->initData();
		return new JSONMessage(true, $queryForm->fetch($request, null, false, $this->getRequestArgs()));
	}

	/**
	 * Delete a query.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function deleteQuery($args, $request) {
		$query = $this->getQuery();
		if (!$request->checkCSRF() || !$query || !$this->getAccessHelper()->getCanDelete($query->getId())) return new JSONMessage(false);

		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$queryDao->deleteObject($query);

		$notificationDao = DAORegistry::getDAO('NotificationDAO'); /* @var $notificationDao NotificationDAO */
		$notificationDao->deleteByAssoc(ASSOC_TYPE_QUERY, $query->getId());

		if ($this->getStageId() == WORKFLOW_STAGE_ID_EDITING ||
			$this->getStageId() == WORKFLOW_STAGE_ID_PRODUCTION) {

			// Update submission notifications
			$notificationMgr = new NotificationManager();
			$notificationMgr->updateNotification(
				$request,
				array(
					NOTIFICATION_TYPE_ASSIGN_COPYEDITOR,
					NOTIFICATION_TYPE_AWAITING_COPYEDITS,
					NOTIFICATION_TYPE_ASSIGN_PRODUCTIONUSER,
					NOTIFICATION_TYPE_AWAITING_REPRESENTATIONS,
				),
				null,
				ASSOC_TYPE_SUBMISSION,
				$this->getAssocId()
			);
		}

		return DAO::getDataChangedEvent($query->getId());
	}

	/**
	 * Open a closed query.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function openQuery($args, $request) {
		$query = $this->getQuery();
		if (!$query || !$this->getAccessHelper()->getCanOpenClose($query)) return new JSONMessage(false);

		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$query->setIsClosed(false);
		$queryDao->updateObject($query);
		return DAO::getDataChangedEvent($query->getId());
	}

	/**
	 * Close an open query.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function closeQuery($args, $request) {
		$query = $this->getQuery();
		if (!$query || !$this->getAccessHelper()->getCanOpenClose($query)) return new JSONMessage(false);

		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$query->setIsClosed(true);
		$queryDao->updateObject($query);
		return DAO::getDataChangedEvent($query->getId());
	}

	/**
	 * Get the name of the query notes grid handler.
	 * @return string
	 */
	function getQueryNotesGridHandlerName() {
		return 'grid.queries.QueryNotesGridHandler';
	}

	/**
	 * Read a query
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function readQuery($args, $request) {
		$query = $this->getQuery();
		$router = $request->getRouter();
		$user = $request->getUser();
		$context = $request->getContext();

		$actionArgs = array_merge($this->getRequestArgs(), array('queryId' => $query->getId()));

		// If appropriate, create an Edit action for the participants list
		if ($this->getAccessHelper()->getCanEdit($query->getId())) {
			import('lib.pkp.classes.linkAction.request.AjaxModal');
			$editAction = new LinkAction(
				'editQuery',
				new AjaxModal(
					$router->url($request, null, null, 'editQuery', null, $actionArgs),
					__('grid.action.updateQuery'),
					'modal_edit'
				),
				__('grid.action.edit'),
				'edit'
			);
		} else {
			$editAction = null;
		}

		import('lib.pkp.classes.linkAction.request.RemoteActionConfirmationModal');
		$leaveQueryLinkAction = new LinkAction(
			'leaveQuery',
			new RemoteActionConfirmationModal(
				$request->getSession(),
				__('submission.query.leaveQuery.confirm'),
				__('submission.query.leaveQuery'),
				$router->url($request, null, null, 'leaveQuery', null, $actionArgs),
				'modal_delete'
			),
			__('submission.query.leaveQuery'),
			'leaveQuery'
		);

		// Show leave query button for journal managers included in the query
		if ($user && $this->_getCurrentUserCanLeave($query->getId())) {
			$showLeaveQueryButton = true;
		} else {
			$showLeaveQueryButton = false;
		}

		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign(array(
			'queryNotesGridHandlerName' => $this->getQueryNotesGridHandlerName(),
			'requestArgs' => $this->getRequestArgs(),
			'query' => $query,
			'editAction' => $editAction,
			'leaveQueryLinkAction' => $leaveQueryLinkAction,
			'showLeaveQueryButton' => $showLeaveQueryButton,
		));
		return new JSONMessage(true, $templateMgr->fetch('controllers/grid/queries/readQuery.tpl'));
	}

	/**
	 * Fetch the list of participants for a query
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function participants($args, $request) {
		$query = $this->getQuery();
		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$userDao = DAORegistry::getDAO('UserDAO'); /* @var $userDao UserDAO */
		$context = $request->getContext();
		$user = $request->getUser();

		$participants = array();
		foreach ($queryDao->getParticipantIds($query->getId()) as $userId) {
			$participants[] = $userDao->getById($userId);
		}

		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('participants', $participants);

		if ($user && $this->_getCurrentUserCanLeave($query->getId())) {
			$showLeaveQueryButton = true;
		} else {
			$showLeaveQueryButton = false;
		}
		$json = new JSONMessage();
		$json->setStatus(true);
		$json->setContent($templateMgr->fetch('controllers/grid/queries/participants.tpl'));
		$json->setAdditionalAttributes(array('showLeaveQueryButton' => $showLeaveQueryButton));
		return $json;
	}

	/**
	 * Edit a query
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function editQuery($args, $request) {
		$query = $this->getQuery();
		if (!$this->getAccessHelper()->getCanEdit($query->getId())) return new JSONMessage(false);

		// Form handling
		import('lib.pkp.controllers.grid.queries.form.QueryForm');
		$queryForm = new QueryForm(
			$request,
			$this->getAssocType(),
			$this->getAssocId(),
			$this->getStageId(),
			$query->getId()
		);
		$queryForm->initData();
		return new JSONMessage(true, $queryForm->fetch($request, null, false, $this->getRequestArgs()));
	}

	/**
	 * Save a query
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function updateQuery($args, $request) {
		$query = $this->getQuery();
		if (!$this->getAccessHelper()->getCanEdit($query->getId())) return new JSONMessage(false);

		import('lib.pkp.controllers.grid.queries.form.QueryForm');
		$queryForm = new QueryForm(
			$request,
			$this->getAssocType(),
			$this->getAssocId(),
			$this->getStageId(),
			$query->getId()
		);
		$queryForm->readInputData();

		if ($queryForm->validate()) {
			$queryForm->execute();

			if ($this->getStageId() == WORKFLOW_STAGE_ID_EDITING ||
				$this->getStageId() == WORKFLOW_STAGE_ID_PRODUCTION) {

				// Update submission notifications
				$notificationMgr = new NotificationManager();
				$notificationMgr->updateNotification(
					$request,
					array(
						NOTIFICATION_TYPE_ASSIGN_COPYEDITOR,
						NOTIFICATION_TYPE_AWAITING_COPYEDITS,
						NOTIFICATION_TYPE_ASSIGN_PRODUCTIONUSER,
						NOTIFICATION_TYPE_AWAITING_REPRESENTATIONS,
					),
					null,
					ASSOC_TYPE_SUBMISSION,
					$this->getAssocId()
				);
			}
			return DAO::getDataChangedEvent($query->getId());
		}
		return new JSONMessage(
			true,
			$queryForm->fetch(
				$request,
				null,
				false,
				array_merge(
					$this->getRequestArgs(),
					array('queryId' => $query->getId())
				)
			)
		);
	}

	/**
	 * Leave query
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function leaveQuery($args, $request) {
		$queryId = $args['queryId'];
		$user = $request->getUser();
		$context = $request->getContext();
		if ($user && $this->_getCurrentUserCanLeave($queryId)) {
			$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
			$queryDao->removeParticipant($queryId, $user->getId());
			$json = new JSONMessage();
			$json->setEvent('user-left-discussion');
		} else {
			$json = new JSONMessage(false);
		}
		return $json;
	}

	/**
	 * Check if the current user can leave a query. Only allow if query has more than two participants.
	 * @param $queryId int
	 * @return boolean
	 */
	function _getCurrentUserCanLeave($queryId) {
		$userRoles = $this->getAuthorizedContextObject(ASSOC_TYPE_USER_ROLES);
		if (!in_array(ROLE_ID_MANAGER, $userRoles)) {
		  return false;
		}
		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$participantIds = $queryDao->getParticipantIds($queryId);
		if (count($participantIds) < 3) {
		  return false;
		}
		$user = Application::get()->getRequest()->getUser();
		return in_array($user->getId(), $participantIds);

	}
}


