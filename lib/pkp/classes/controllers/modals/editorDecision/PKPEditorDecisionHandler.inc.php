<?php

/**
 * @file controllers/modals/editorDecision/EditorDecisionHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class EditorDecisionHandler
 * @ingroup controllers_modals_editorDecision
 *
 * @brief Handle requests for editors to make a decision
 */

import('classes.handler.Handler');

// import JSON class for use with all AJAX requests
import('lib.pkp.classes.core.JSONMessage');

class PKPEditorDecisionHandler extends Handler {

	//
	// Implement template methods from PKPHandler
	//
	/**
	 * @copydoc PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
		// Some operations need a review round id in request.
		$reviewRoundOps = $this->_getReviewRoundOps();
		import('lib.pkp.classes.security.authorization.internal.ReviewRoundRequiredPolicy');
		$this->addPolicy(new ReviewRoundRequiredPolicy($request, $args, 'reviewRoundId', $reviewRoundOps));

		if (!parent::authorize($request, $args, $roleAssignments)) return false;

		// Prevent editors who are also assigned as authors from accessing the
		// review stage operations
		$operation = $request->getRouter()->getRequestedOp($request);
		if (in_array($operation, $reviewRoundOps)) {
			$userAccessibleStages = $this->getAuthorizedContextObject(ASSOC_TYPE_ACCESSIBLE_WORKFLOW_STAGES);
			foreach ($userAccessibleStages as $stageId => $roles) {
				if (in_array(ROLE_ID_AUTHOR, $roles)) {
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * @copydoc PKPHandler::initialize()
	 */
	function initialize($request) {
		AppLocale::requireComponents(
			LOCALE_COMPONENT_APP_COMMON,
			LOCALE_COMPONENT_APP_EDITOR,
			LOCALE_COMPONENT_APP_SUBMISSION,
			LOCALE_COMPONENT_PKP_EDITOR,
			LOCALE_COMPONENT_PKP_SUBMISSION
		);
	}


	//
	// Public handler actions
	//
	/**
	 * Start a new review round
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function newReviewRound($args, $request) {
		return $this->_initiateEditorDecision($args, $request, 'NewReviewRoundForm');
	}

	/**
	 * Jump from submission to external review
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function externalReview($args, $request) {
		return $this->_initiateEditorDecision($args, $request, 'InitiateExternalReviewForm');
	}

	/**
	 * Start a new review round in external review, bypassing internal
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function saveExternalReview($args, $request) {
		assert($this->getAuthorizedContextObject(ASSOC_TYPE_WORKFLOW_STAGE) == WORKFLOW_STAGE_ID_SUBMISSION);
		return $this->_saveEditorDecision(
			$args, $request, 'InitiateExternalReviewForm',
			WORKFLOW_STAGE_PATH_EXTERNAL_REVIEW,
			SUBMISSION_EDITOR_DECISION_EXTERNAL_REVIEW
		);
	}

	/**
	 * Show a save review form (responsible for decline submission modals when not in review stage)
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function sendReviews($args, $request) {
		return $this->_initiateEditorDecision($args, $request, 'SendReviewsForm');
	}

	/**
	 * Show a save review form (responsible for request revisions,
	 * resubmit for review, and decline submission modals in review stages).
	 * We need this because the authorization in review stages is different
	 * when not in review stages (need to authorize review round id).
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function sendReviewsInReview($args, $request) {
		return $this->_initiateEditorDecision($args, $request, 'SendReviewsForm');
	}

	/**
	 * Save the send review form when user is not in review stage.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function saveSendReviews($args, $request) {
		return $this->_saveEditorDecision($args, $request, 'SendReviewsForm');
	}

	/**
	 * Save the send review form when user is in review stages.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function saveSendReviewsInReview($args, $request) {
		return $this->_saveEditorDecision($args, $request, 'SendReviewsForm');
	}

	/**
	 * Show a promote form (responsible for accept submission modals outside review stage)
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function promote($args, $request) {
		return $this->_initiateEditorDecision($args, $request, 'PromoteForm');
	}

	/**
	 * Show a promote form (responsible for external review and accept submission modals
	 * in review stages). We need this because the authorization for promoting in review
	 * stages is different when not in review stages (need to authorize review round id).
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function promoteInReview($args, $request) {
		return $this->_initiateEditorDecision($args, $request, 'PromoteForm');
	}

	/**
	 * Save the send review form
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function savePromote($args, $request) {
		return $this->_saveGeneralPromote($args, $request);
	}

	/**
	 * Save the send review form (same case of the
	 * promoteInReview() method, see description there).
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function savePromoteInReview($args, $request) {
		return $this->_saveGeneralPromote($args, $request);
	}

	/**
	 * Show a revert decline form.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function revertDecline($args, $request) {
		return $this->_initiateEditorDecision($args, $request, 'RevertDeclineForm');
	}

	/**
	 * Save the revert decline form.
	 * @param $args array
	 * @param $request PKPRequest
	 * @return string Serialized JSON object
	 */
	function saveRevertDecline($args, $request) {
		return $this->_saveEditorDecision($args, $request, 'RevertDeclineForm');
	}

	/**
	 * Import all free-text/review form reviews to paste into message
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function importPeerReviews($args, $request) {
		// Retrieve the authorized submission.
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);

		// Retrieve the current review round.
		$reviewRound = $this->getAuthorizedContextObject(ASSOC_TYPE_REVIEW_ROUND);

		// Retrieve peer reviews.
		$reviewAssignmentDao = DAORegistry::getDAO('ReviewAssignmentDAO'); /* @var $reviewAssignmentDao ReviewAssignmentDAO */
		$submissionCommentDao = DAORegistry::getDAO('SubmissionCommentDAO'); /* @var $submissionCommentDao SubmissionCommentDAO */
		$reviewFormResponseDao = DAORegistry::getDAO('ReviewFormResponseDAO'); /* @var $reviewFormResponseDao ReviewFormResponseDAO */
		$reviewFormElementDao = DAORegistry::getDAO('ReviewFormElementDAO'); /* @var $reviewFormElementDao ReviewFormElementDAO */

		$reviewAssignments = $reviewAssignmentDao->getBySubmissionId($submission->getId(), $reviewRound->getId());
		$reviewIndexes = $reviewAssignmentDao->getReviewIndexesForRound($submission->getId(), $reviewRound->getId());
		AppLocale::requireComponents(LOCALE_COMPONENT_PKP_SUBMISSION);

		$body = '';
		$textSeparator = '------------------------------------------------------';
		foreach ($reviewAssignments as $reviewAssignment) {
			// If the reviewer has completed the assignment, then import the review.
			if ($reviewAssignment->getDateCompleted() != null) {
				// Get the comments associated with this review assignment
				$submissionComments = $submissionCommentDao->getSubmissionComments($submission->getId(), COMMENT_TYPE_PEER_REVIEW, $reviewAssignment->getId());

				$body .= "<br><br>$textSeparator<br>";
				// If it is an open review, show reviewer's name.
				if ($reviewAssignment->getReviewMethod() == SUBMISSION_REVIEW_METHOD_OPEN) {
					$body .= $reviewAssignment->getReviewerFullName() . "<br>\n";
				} else {
					$body .= __('submission.comments.importPeerReviews.reviewerLetter', array('reviewerLetter' => PKPString::enumerateAlphabetically($reviewIndexes[$reviewAssignment->getId()]))) . "<br>\n";
				}

				while ($comment = $submissionComments->next()) {
					// If the comment is viewable by the author, then add the comment.
					if ($comment->getViewable()) {
						$body .= PKPString::stripUnsafeHtml($comment->getComments());
					}
				}

				// Add reviewer recommendation
				$recommendation = $reviewAssignment->getLocalizedRecommendation();
				$body .= __('submission.recommendation', array('recommendation' => $recommendation)) . "<br>\n";

				$body .= "<br>$textSeparator<br><br>";

				if ($reviewFormId = $reviewAssignment->getReviewFormId()) {
					$reviewId = $reviewAssignment->getId();


					$reviewFormElements = $reviewFormElementDao->getByReviewFormId($reviewFormId);
					if(!$submissionComments) {
						$body .= "$textSeparator<br>";

						$body .= __('submission.comments.importPeerReviews.reviewerLetter', array('reviewerLetter' => PKPString::enumerateAlphabetically($reviewIndexes[$reviewAssignment->getId()]))) . '<br><br>';
					}
					while ($reviewFormElement = $reviewFormElements->next()) {
						if (!$reviewFormElement->getIncluded()) continue;

						$body .= PKPString::stripUnsafeHtml($reviewFormElement->getLocalizedQuestion());
						$reviewFormResponse = $reviewFormResponseDao->getReviewFormResponse($reviewId, $reviewFormElement->getId());

						if ($reviewFormResponse) {
							$possibleResponses = $reviewFormElement->getLocalizedPossibleResponses();
							// See issue #2437.
							if (in_array($reviewFormElement->getElementType(), array(REVIEW_FORM_ELEMENT_TYPE_CHECKBOXES, REVIEW_FORM_ELEMENT_TYPE_RADIO_BUTTONS))) {
								ksort($possibleResponses);
								$possibleResponses = array_values($possibleResponses);
							}
							if (in_array($reviewFormElement->getElementType(), $reviewFormElement->getMultipleResponsesElementTypes())) {
								if ($reviewFormElement->getElementType() == REVIEW_FORM_ELEMENT_TYPE_CHECKBOXES) {
									$body .= '<ul>';
									foreach ($reviewFormResponse->getValue() as $value) {
										$body .= '<li>' . PKPString::stripUnsafeHtml($possibleResponses[$value]) . '</li>';
									}
									$body .= '</ul>';
								} else {
									$body .= '<blockquote>' . PKPString::stripUnsafeHtml($possibleResponses[$reviewFormResponse->getValue()]) . '</blockquote>';
								}
								$body .= '<br>';
							} else {
								$body .= '<blockquote>' . nl2br(htmlspecialchars($reviewFormResponse->getValue())) . '</blockquote>';
							}
						}

					}
					$body .= "$textSeparator<br><br>";

				}
			}
		}

		// Notify the user.
		$notificationMgr = new NotificationManager();
		$user = $request->getUser();
		$notificationMgr->createTrivialNotification($user->getId(), NOTIFICATION_TYPE_SUCCESS, array('contents' => __('editor.review.reviewsAdded')));

		return new JSONMessage(true, empty($body)?__('editor.review.noReviews'):$body);
	}

	/**
	 * Show the editor recommendation form
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage
	 */
	function sendRecommendation($args, $request) {
		// Retrieve the authorized submission, stage id and review round.
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		$stageId = $this->getAuthorizedContextObject(ASSOC_TYPE_WORKFLOW_STAGE);
		assert(in_array($stageId, $this->_getReviewStages()));
		$reviewRound = $this->getAuthorizedContextObject(ASSOC_TYPE_REVIEW_ROUND);
		assert(is_a($reviewRound, 'ReviewRound'));

		// Form handling
		import('lib.pkp.controllers.modals.editorDecision.form.RecommendationForm');
		$editorRecommendationForm = new RecommendationForm($submission, $stageId, $reviewRound);
		$editorRecommendationForm->initData();
		return new JSONMessage(true, $editorRecommendationForm->fetch($request));
	}

	/**
	 * Show the editor recommendation form
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage
	 */
	function saveRecommendation($args, $request) {
		// Retrieve the authorized submission, stage id and review round.
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		$stageId = $this->getAuthorizedContextObject(ASSOC_TYPE_WORKFLOW_STAGE);
		assert(in_array($stageId, $this->_getReviewStages()));
		$reviewRound = $this->getAuthorizedContextObject(ASSOC_TYPE_REVIEW_ROUND);
		assert(is_a($reviewRound, 'ReviewRound'));

		// Form handling
		import('lib.pkp.controllers.modals.editorDecision.form.RecommendationForm');
		$editorRecommendationForm = new RecommendationForm($submission, $stageId, $reviewRound);
		$editorRecommendationForm->readInputData();
		if ($editorRecommendationForm->validate()) {
			$editorRecommendationForm->execute();
			$json = new JSONMessage(true);
			$json->setGlobalEvent('decisionActionUpdated');
			return $json;
		}
		return new JSONMessage(false);
	}


	//
	// Protected helper methods
	//
	/**
	 * Get operations that need a review round id policy.
	 * @return array
	 */
	protected function _getReviewRoundOps() {
		return array('promoteInReview', 'savePromoteInReview', 'newReviewRound', 'saveNewReviewRound', 'sendReviewsInReview', 'saveSendReviewsInReview', 'importPeerReviews', 'sendRecommendation', 'saveRecommendation');
	}

	/**
	 * Get the fully-qualified import name for the given form name.
	 * @param $formName Class name for the desired form.
	 * @return string
	 */
	protected function _resolveEditorDecisionForm($formName) {
		switch($formName) {
			case 'EditorDecisionWithEmailForm':
			case 'NewReviewRoundForm':
			case 'PromoteForm':
			case 'SendReviewsForm':
			case 'RevertDeclineForm':
				return "lib.pkp.controllers.modals.editorDecision.form.$formName";
			default:
				assert(false);
		}
	}

	/**
	 * Get an instance of an editor decision form.
	 * @param $formName string
	 * @param $decision int
	 * @return EditorDecisionForm
	 */
	protected function _getEditorDecisionForm($formName, $decision) {
		// Retrieve the authorized submission.
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		// Retrieve the stage id
		$stageId = $this->getAuthorizedContextObject(ASSOC_TYPE_WORKFLOW_STAGE);

		import($this->_resolveEditorDecisionForm($formName));
		if (in_array($stageId, $this->_getReviewStages())) {
			$reviewRound = $this->getAuthorizedContextObject(ASSOC_TYPE_REVIEW_ROUND);
			$editorDecisionForm = new $formName($submission, $decision, $stageId, $reviewRound);
			// We need a different save operation in review stages to authorize
			// the review round object.
			if (is_a($editorDecisionForm, 'PromoteForm')) {
				$editorDecisionForm->setSaveFormOperation('savePromoteInReview');
			} else if (is_a($editorDecisionForm, 'SendReviewsForm')) {
				$editorDecisionForm->setSaveFormOperation('saveSendReviewsInReview');
			}
		} else {
			$editorDecisionForm = new $formName($submission, $decision, $stageId);
		}

		if (is_a($editorDecisionForm, $formName)) {
			return $editorDecisionForm;
		} else {
			assert(false);
			return null;
		}
	}

	/**
	 * Initiate an editor decision.
	 * @param $args array
	 * @param $request PKPRequest
	 * @param $formName string Name of form to call
	 * @return JSONMessage JSON object
	 */
	protected function _initiateEditorDecision($args, $request, $formName) {
		// Retrieve the decision
		$decision = (int)$request->getUserVar('decision');

		// Form handling
		$editorDecisionForm = $this->_getEditorDecisionForm($formName, $decision);
		$editorDecisionForm->initData();

		return new JSONMessage(true, $editorDecisionForm->fetch($request));
	}

	/**
	 * Save an editor decision.
	 * @param $args array
	 * @param $request PKPRequest
	 * @param $formName string Name of form to call
	 * @param $redirectOp string A workflow stage operation to
	 *  redirect to if successful (if any).
	 * @return JSONMessage JSON object
	 */
	protected function _saveEditorDecision($args, $request, $formName, $redirectOp = null, $decision = null) {
		// Retrieve the authorized submission.
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		// Retrieve the decision
		if (is_null($decision)) {
			$decision = (int)$request->getUserVar('decision');
		}

		$editorDecisionForm = $this->_getEditorDecisionForm($formName, $decision);
		$editorDecisionForm->readInputData();
		if ($editorDecisionForm->validate()) {
			$editorDecisionForm->execute();

			// Get a list of author user IDs
			$authorUserIds = array();
			$stageAssignmentDao = DAORegistry::getDAO('StageAssignmentDAO'); /* @var $stageAssignmentDao StageAssignmentDAO */
			$submitterAssignments = $stageAssignmentDao->getBySubmissionAndRoleId($submission->getId(), ROLE_ID_AUTHOR);
			while ($assignment = $submitterAssignments->next()) {
				$authorUserIds[] = $assignment->getUserId();
			}
			// De-duplicate assignments
			$authorUserIds = array_unique($authorUserIds);

			// Update editor decision and pending revisions notifications.
			$notificationMgr = new NotificationManager();
			$editorDecisionNotificationType = $this->_getNotificationTypeByEditorDecision($decision);
			$notificationTypes = array_merge(array($editorDecisionNotificationType), $this->_getReviewNotificationTypes());
			$notificationMgr->updateNotification(
				$request,
				$notificationTypes,
				$authorUserIds,
				ASSOC_TYPE_SUBMISSION,
				$submission->getId()
			);

			// Update submission notifications
			$submissionNotificationsToUpdate = array(
				SUBMISSION_EDITOR_DECISION_ACCEPT => array(NOTIFICATION_TYPE_ASSIGN_COPYEDITOR,	NOTIFICATION_TYPE_AWAITING_COPYEDITS),
				SUBMISSION_EDITOR_DECISION_SEND_TO_PRODUCTION => array(
					NOTIFICATION_TYPE_ASSIGN_COPYEDITOR,
					NOTIFICATION_TYPE_AWAITING_COPYEDITS,
					NOTIFICATION_TYPE_ASSIGN_PRODUCTIONUSER,
					NOTIFICATION_TYPE_AWAITING_REPRESENTATIONS,
				),
			);
			$notificationMgr = new NotificationManager();
			if (array_key_exists($decision, $submissionNotificationsToUpdate)) {
				$notificationMgr->updateNotification(
					$request,
					$submissionNotificationsToUpdate[$decision],
					null,
					ASSOC_TYPE_SUBMISSION,
					$submission->getId()
				);
			}

			if ($redirectOp) {
				$dispatcher = $this->getDispatcher();
				$redirectUrl = $dispatcher->url($request, ROUTE_PAGE, null, 'workflow', $redirectOp, array($submission->getId()));
				return $request->redirectUrlJson($redirectUrl);
			} else {
				if (in_array($decision, [SUBMISSION_EDITOR_DECISION_DECLINE, SUBMISSION_EDITOR_DECISION_INITIAL_DECLINE, SUBMISSION_EDITOR_DECISION_REVERT_DECLINE])) {
					$dispatcher = $this->getDispatcher();
					$redirectUrl = $dispatcher->url($request, ROUTE_PAGE, null, 'workflow', 'access', array($submission->getId()));
					return $request->redirectUrlJson($redirectUrl);

				} else {
					// Needed to update review round status notifications.
					return DAO::getDataChangedEvent();
				}
			}
		} else {
			return new JSONMessage(false);
		}
	}

	/**
	 * Get review-related stage IDs.
	 * @return array
	 */
	protected function _getReviewStages() {
		assert(false);
	}

	/**
	 * Get review-related decision notifications.
	 * @return array
	 */
	protected function _getReviewNotificationTypes() {
		assert(false); // Subclasses to override
	}
}


