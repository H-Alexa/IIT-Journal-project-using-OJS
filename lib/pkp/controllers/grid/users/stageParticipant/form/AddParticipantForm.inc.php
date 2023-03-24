<?php

/**
 * @file controllers/grid/users/stageParticipant/form/AddParticipantForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class AddParticipantForm
 * @ingroup controllers_grid_users_stageParticipant_form
 *
 * @brief Form for adding a stage participant
 */

import('controllers.grid.users.stageParticipant.form.StageParticipantNotifyForm');

class AddParticipantForm extends StageParticipantNotifyForm {
	/** @var Submission The submission associated with the submission contributor being edited **/
	var $_submission;

	/** @var $_assignmentId int Used for edit the assignment **/
	var $_assignmentId;

	/** @var $_managerGroupIds array Contains all manager group_ids  **/
	var $_managerGroupIds;

	/** @var $_possibleRecommendOnlyUserGroupIds array Contains all group_ids that can have the recommendOnly field available for change  **/
	var $_possibleRecommendOnlyUserGroupIds;

	/** @var $_contextId int the current Context Id **/
	var $_contextId;

	/**
	 * Constructor.
	 * @param $submission Submission
	 * @param $stageId int STAGE_ID_...
	 * @param $assignmentId int Optional - Used for edit the assignment
	 */
	function __construct($submission, $stageId, $assignmentId = null) {
		parent::__construct($submission->getId(), ASSOC_TYPE_SUBMISSION, $stageId, 'controllers/grid/users/stageParticipant/addParticipantForm.tpl');
		$this->_submission = $submission;
		$this->_stageId = $stageId;
		$this->_assignmentId = $assignmentId;
		$this->_contextId = $submission->getContextId();

		// add checks in addition to anything that the Notification form may apply.
		// FIXME: should use a custom validator to check that the userId belongs to this group.
		$this->addCheck(new FormValidator($this, 'userGroupId', 'required', 'editor.submission.addStageParticipant.form.userGroupRequired'));
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));

		$this->initialize();
	}

	//
	// Getters and Setters
	//
	/**
	 * Get the Submission
	 * @return Submission
	 */
	function getSubmission() {
		return $this->_submission;
	}

	/**
	 * Initialize private attributes that need to be used through all functions.
	 */
	function initialize() {
		$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /* @var $userGroupDao UserGroupDAO */

		// assign all user group IDs with ROLE_ID_MANAGER or ROLE_ID_SUB_EDITOR
		$this->_managerGroupIds = $userGroupDao->getUserGroupIdsByRoleId(ROLE_ID_MANAGER, $this->_contextId);
		$subEditorGroupIds = $userGroupDao->getUserGroupIdsByRoleId(ROLE_ID_SUB_EDITOR, $this->_contextId);
		$this->_possibleRecommendOnlyUserGroupIds = array_merge($this->_managerGroupIds, $subEditorGroupIds);
	}

	/**
	 * Determine whether the specified user group is potentially restricted from editing metadata.
	 * @param $userGroupId int
	 * @return boolean
	 */
	protected function _isChangePermitMetadataAllowed($userGroupId) {
		return !in_array($userGroupId, $this->_managerGroupIds);
	}

	/**
	 * Determine whether the specified group is potentially required to make recommendations rather than decisions.
	 * @param $userGroupId int
	 * @return boolean
	 */
	protected function _isChangeRecommendOnlyAllowed($userGroupId) {
		return in_array($userGroupId, $this->_possibleRecommendOnlyUserGroupIds);
	}

	/**
	 * @copydoc Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /* @var $userGroupDao UserGroupDAO */
		$userGroups = $userGroupDao->getUserGroupsByStage(
			$request->getContext()->getId(),
			$this->getStageId()
		);

		$userGroupOptions = array();
		while ($userGroup = $userGroups->next()) {
			// Exclude reviewers.
			if ($userGroup->getRoleId() == ROLE_ID_REVIEWER) continue;
			$userGroupOptions[$userGroup->getId()] = $userGroup->getLocalizedName();
		}

		$templateMgr = TemplateManager::getManager($request);
		$keys = array_keys($userGroupOptions);
		$templateMgr->assign(array(
			'userGroupOptions' => $userGroupOptions,
			'selectedUserGroupId' => array_shift($keys), // assign the first element as selected
			'possibleRecommendOnlyUserGroupIds' => $this->_possibleRecommendOnlyUserGroupIds,
			'recommendOnlyUserGroupIds' => $userGroupDao->getRecommendOnlyGroupIds($request->getContext()->getId()),
			'notPossibleEditSubmissionMetadataPermissionChange' => $this->_managerGroupIds,
			'permitMetadataEditUserGroupIds' => $userGroupDao->getPermitMetadataEditGroupIds($request->getContext()->getId()),
			'submissionId' => $this->getSubmission()->getId(),
			'userGroupId' => '',
			'userIdSelected' => '',
		));

		if ($this->_assignmentId) {
			/** @var $stageAssignmentDao StageAssignmentDAO */
			$stageAssignmentDao = DAORegistry::getDAO('StageAssignmentDAO'); /* @var $stageAssignmentDao StageAssignmentDAO */

			/** @var $stageAssignment StageAssignment */
			$stageAssignment = $stageAssignmentDao->getById($this->_assignmentId);

			$userDao = DAORegistry::getDAO('UserDAO'); /* @var $userDao UserDAO */
			/** @var $currentUser User */
			$currentUser = $userDao->getById($stageAssignment->getUserId());

			$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /* @var $userGroupDao UserGroupDAO */
			/** @var $userGroup UserGroup */
			$userGroup = $userGroupDao->getById($stageAssignment->getUserGroupId());

			$templateMgr->assign(array(
				'assignmentId' => $this->_assignmentId,
				'currentUserName' => $currentUser->getFullName(),
				'currentUserGroup' => $userGroup->getLocalizedName(),
				'userGroupId' => $stageAssignment->getUserGroupId(),
				'userIdSelected' => $stageAssignment->getUserId(),
				'currentAssignmentRecommendOnly' => $stageAssignment->getRecommendOnly(),
				'currentAssignmentPermitMetadataEdit' => $stageAssignment->getCanChangeMetadata(),
				'isChangePermitMetadataAllowed' => $this->_isChangePermitMetadataAllowed($userGroup->getId()),
				'isChangeRecommendOnlyAllowed' => $this->_isChangeRecommendOnlyAllowed($userGroup->getId()),
			));
		}


		// If submission is in review, add a list of reviewer Ids that should not be
		// assigned as participants because they have anonymous peer reviews in progress
		import('lib.pkp.classes.submission.reviewAssignment.ReviewAssignment');
		$anonymousReviewerIds = array();
		if (in_array($this->getSubmission()->getStageId(), array(WORKFLOW_STAGE_ID_INTERNAL_REVIEW, WORKFLOW_STAGE_ID_EXTERNAL_REVIEW))) {
			$anonymousReviewMethods = array(SUBMISSION_REVIEW_METHOD_ANONYMOUS, SUBMISSION_REVIEW_METHOD_DOUBLEANONYMOUS);
			$reviewAssignmentDao = DAORegistry::getDAO('ReviewAssignmentDAO'); /* @var $reviewAssignmentDao ReviewAssignmentDAO */
			$reviewAssignments = $reviewAssignmentDao->getBySubmissionId($this->getSubmission()->getId());
			$anonymousReviews = array_filter($reviewAssignments, function($reviewAssignment) use ($anonymousReviewMethods) {
				return in_array($reviewAssignment->getReviewMethod(), $anonymousReviewMethods) && !$reviewAssignment->getDeclined();
			});
			$anonymousReviewerIds = array_map(function($reviewAssignment) {
				return $reviewAssignment->getReviewerId();
			}, $anonymousReviews);

		}
		$templateMgr->assign(array(
			'anonymousReviewerIds' => array_values(array_unique($anonymousReviewerIds)),
			'anonymousReviewerWarning' => __('editor.submission.addStageParticipant.form.reviewerWarning'),
			'anonymousReviewerWarningOk' => __('common.ok'),
		));

		return parent::fetch($request, $template, $display);
	}

	/**
	 * @copydoc Form::readInputData()
	 */
	function readInputData() {
		$this->readUserVars(array(
			'userGroupId',
			'userId',
			'message',
			'template',
			'recommendOnly',
			'canChangeMetadata',
		));
	}

	/**
	 * @copydoc Form::validate()
	 */
	function validate($callHooks = true) {
		$userGroupId = (int) $this->getData('userGroupId');
		$userId = (int) $this->getData('userId');
		$submission = $this->getSubmission();

		$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /* @var $userGroupDao UserGroupDAO */
		return $userGroupDao->userInGroup($userId, $userGroupId) && $userGroupDao->getById($userGroupId, $submission->getContextId());
	}

	/**
	 * @see Form::execute()
	 * @return array ($userGroupId, $userId)
	 */
	function execute(...$functionParams) {
		$stageAssignmentDao = DAORegistry::getDAO('StageAssignmentDAO'); /** @var $stageAssignmentDao StageAssignmentDAO */
		$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /** @var $userGroupDao UserGroupDAO */

		$submission = $this->getSubmission();
		$userGroupId = (int) $this->getData('userGroupId');
		$userId = (int) $this->getData('userId');
		$recommendOnly = $this->_isChangeRecommendOnlyAllowed($userGroupId) ? (boolean) $this->getData('recommendOnly') : false;
		$canChangeMetadata = $this->_isChangePermitMetadataAllowed($userGroupId) ? (boolean) $this->getData('canChangeMetadata') : true;

		// sanity check
		if ($userGroupDao->userGroupAssignedToStage($userGroupId, $this->getStageId())) {
			$updated = false;

			if ($this->_assignmentId) {
				/** @var $stageAssignment StageAssignment */
				$stageAssignment = $stageAssignmentDao->getById($this->_assignmentId);

				if ($stageAssignment) {
					$stageAssignment->setRecommendOnly($recommendOnly);
					$stageAssignment->setCanChangeMetadata($canChangeMetadata);
					$stageAssignmentDao->updateObject($stageAssignment);
					$updated = true;
				}
			}

			if (!$updated) {
				// insert the assignment
				$stageAssignment = $stageAssignmentDao->build($submission->getId(), $userGroupId, $userId, $recommendOnly, $canChangeMetadata);
			}
		}

		parent::execute(...$functionParams);
		return array($userGroupId, $userId, $stageAssignment->getId());
	}

	/**
	 * whether or not to require a message field
	 * @return boolean
	 */
	function isMessageRequired() {
		return false;
	}
}


