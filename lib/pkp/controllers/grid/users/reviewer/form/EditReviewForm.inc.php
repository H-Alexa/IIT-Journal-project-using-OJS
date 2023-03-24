<?php

/**
 * @file controllers/grid/users/reviewer/form/EditReviewForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class EditReviewForm
 * @ingroup controllers_grid_users_reviewer_form
 *
 * @brief Allow the editor to limit the available files to an assigned
 * reviewer after the assignment has taken place.
 */

import('lib.pkp.classes.form.Form');

class EditReviewForm extends Form {
	/** @var ReviewAssignment */
	var $_reviewAssignment;

	/** @var ReviewRound */
	var $_reviewRound;

	/**
	 * Constructor.
	 * @param $reviewAssignment ReviewAssignment
	 */
	function __construct($reviewAssignment) {
		$this->_reviewAssignment = $reviewAssignment;
		assert(is_a($this->_reviewAssignment, 'ReviewAssignment'));

		$reviewRoundDao = DAORegistry::getDAO('ReviewRoundDAO'); /* @var $reviewRoundDao ReviewRoundDAO */
		$this->_reviewRound = $reviewRoundDao->getById($reviewAssignment->getReviewRoundId());
		assert(is_a($this->_reviewRound, 'ReviewRound'));

		parent::__construct('controllers/grid/users/reviewer/form/editReviewForm.tpl');

		// Validation checks for this form
		$this->addCheck(new FormValidator($this, 'responseDueDate', 'required', 'editor.review.errorAddingReviewer'));
		$this->addCheck(new FormValidator($this, 'reviewDueDate', 'required', 'editor.review.errorAddingReviewer'));
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}

	//
	// Overridden template methods
	//
	/**
	 * Initialize form data from the associated author.
	 */
	function initData() {
		$this->setData('responseDueDate', $this->_reviewAssignment->getDateResponseDue());
		$this->setData('reviewDueDate', $this->_reviewAssignment->getDateDue());
		return parent::initData();
	}

	/**
	 * Fetch the Edit Review Form form
	 * @see Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$templateMgr = TemplateManager::getManager($request);
		$reviewAssignmentDao = DAORegistry::getDAO('ReviewAssignmentDAO'); /* @var $reviewAssignmentDao ReviewAssignmentDAO */
		$context = $request->getContext();

		if (!$this->_reviewAssignment->getDateCompleted()){
			$reviewFormDao = DAORegistry::getDAO('ReviewFormDAO'); /* @var $reviewFormDao ReviewFormDAO */
			$reviewFormsIterator = $reviewFormDao->getActiveByAssocId(Application::getContextAssocType(), $context->getId());
			$reviewForms = array();
			while ($reviewForm = $reviewFormsIterator->next()) {
				$reviewForms[$reviewForm->getId()] = $reviewForm->getLocalizedTitle();
			}
			$templateMgr->assign(array(
				'reviewForms' => $reviewForms,
				'reviewFormId' => $this->_reviewAssignment->getReviewFormId(),
			));
		}

		$templateMgr->assign(array(
			'stageId' => $this->_reviewAssignment->getStageId(),
			'reviewRoundId' => $this->_reviewRound->getId(),
			'submissionId' => $this->_reviewAssignment->getSubmissionId(),
			'reviewAssignmentId' => $this->_reviewAssignment->getId(),
			'reviewMethod' => $this->_reviewAssignment->getReviewMethod(),
			'reviewMethods' => $reviewAssignmentDao->getReviewMethodsTranslationKeys(),
		));
		return parent::fetch($request, $template, $display);
	}

	/**
	 * Assign form data to user-submitted data.
	 * @see Form::readInputData()
	 */
	function readInputData() {
		$this->readUserVars(array(
			'selectedFiles',
			'responseDueDate',
			'reviewDueDate',
			'reviewMethod',
			'reviewFormId',

		));
	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute(...$functionArgs) {
		$request = Application::get()->getRequest();
		$context = $request->getContext();

		// Revoke all, then grant selected.
		$reviewFilesDao = DAORegistry::getDAO('ReviewFilesDAO'); /* @var $reviewFilesDao ReviewFilesDAO */
		$reviewFilesDao->revokeByReviewId($this->_reviewAssignment->getId());

		import('lib.pkp.classes.submission.SubmissionFile'); // SUBMISSION_FILE_... constants
		$submissionFilesIterator = Services::get('submissionFile')->getMany([
			'submissionIds' => [$this->_reviewAssignment->getSubmissionId()],
			'reviewRoundIds' => [$this->_reviewRound->getId()],
			'fileStages' => [$this->_reviewRound->getStageId() == WORKFLOW_STAGE_ID_INTERNAL_REVIEW ? SUBMISSION_FILE_INTERNAL_REVIEW_FILE : SUBMISSION_FILE_REVIEW_FILE],
		]);
		$selectedFiles = array_map(function($id) {
			return (int) $id;
		}, (array) $this->getData('selectedFiles'));
		foreach ($submissionFilesIterator as $submissionFile) {
			if (in_array($submissionFile->getId(), $selectedFiles)) {
				$reviewFilesDao->grant($this->_reviewAssignment->getId(), $submissionFile->getId());
			}
		}

		$reviewAssignmentDao = DAORegistry::getDAO('ReviewAssignmentDAO'); /* @var $reviewAssignmentDao ReviewAssignmentDAO */
		$reviewAssignment = $reviewAssignmentDao->getReviewAssignment($this->_reviewRound->getId(), $this->_reviewAssignment->getReviewerId(), $this->_reviewRound->getRound(), $this->_reviewRound->getStageId());

		// Send notification to reviewer if details have changed.
		if (strtotime($reviewAssignment->getDateDue()) != strtotime($this->getData('reviewDueDate')) || strtotime($reviewAssignment->getDateResponseDue()) != strtotime($this->getData('responseDueDate')) || $reviewAssignment->getReviewMethod() != $this->getData('reviewMethod')){
			$notificationManager = new NotificationManager();
			$request = Application::get()->getRequest();
			$context = $request->getContext();

			$notificationManager->createNotification(
				$request,
				$reviewAssignment->getReviewerId(),
				NOTIFICATION_TYPE_REVIEW_ASSIGNMENT_UPDATED,
				$context->getId(),
				ASSOC_TYPE_REVIEW_ASSIGNMENT,
				$reviewAssignment->getId(),
				NOTIFICATION_LEVEL_TASK
			);

		}

		$reviewAssignment->setDateDue($this->getData('reviewDueDate'));
		$reviewAssignment->setDateResponseDue($this->getData('responseDueDate'));
		$reviewAssignment->setReviewMethod($this->getData('reviewMethod'));

		if (!$reviewAssignment->getDateCompleted()){
			// Ensure that the review form ID is valid, if specified
			$reviewFormId = (int) $this->getData('reviewFormId');
			$reviewFormDao = DAORegistry::getDAO('ReviewFormDAO'); /* @var $reviewFormDao ReviewFormDAO */
			$reviewForm = $reviewFormDao->getById($reviewFormId, Application::getContextAssocType(), $context->getId());
			$reviewAssignment->setReviewFormId($reviewForm?$reviewFormId:null);
		}

		$reviewAssignmentDao->updateObject($reviewAssignment);
		parent::execute(...$functionArgs);
	}
}


