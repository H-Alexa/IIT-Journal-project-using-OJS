<?php

/**
 * @file classes/workflow/EditorDecisionActionsManager.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class EditorDecisionActionsManager
 * @ingroup classes_workflow
 *
 * @brief Wrapper class for create and assign editor decisions actions to template manager.
 */

// Submission stage decision actions.
define('SUBMISSION_EDITOR_DECISION_EXTERNAL_REVIEW', 8);

// Submission and review stages decision actions.
define('SUBMISSION_EDITOR_DECISION_ACCEPT', 1);
define('SUBMISSION_EDITOR_DECISION_DECLINE', 4);

// Review stage decisions actions.
define('SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS', 2);
define('SUBMISSION_EDITOR_DECISION_RESUBMIT', 3);
define('SUBMISSION_EDITOR_DECISION_NEW_ROUND', 16);

// Editorial stage decision actions.
define('SUBMISSION_EDITOR_DECISION_SEND_TO_PRODUCTION', 7);

import('lib.pkp.classes.workflow.PKPEditorDecisionActionsManager');

class EditorDecisionActionsManager extends PKPEditorDecisionActionsManager {

	/**
	 * Get decision actions labels.
	 * @param $context Context
	 * @param $stageId int
	 * @param $decisions array
	 * @return array
	 */
	public function getActionLabels($context, $submission, $stageId, $decisions) {
		$allDecisionsData =
			$this->_submissionStageDecisions($submission, $stageId) +
			$this->_externalReviewStageDecisions($context, $submission) +
			$this->_editorialStageDecisions();

		$actionLabels = array();
		foreach($decisions as $decision) {
			if ($allDecisionsData[$decision]['title']) {
				$actionLabels[$decision] = $allDecisionsData[$decision]['title'];
			} else {
				assert(false);
			}
		}

		return $actionLabels;
	}

	/**
	 * Check for editor decisions in the review round.
	 * @param $reviewRound ReviewRound
	 * @param $decisions array
	 * @return boolean
	 */
	public function getEditorTakenActionInReviewRound($context, $reviewRound, $decisions = array()) {
		$editDecisionDao = DAORegistry::getDAO('EditDecisionDAO'); /* @var $editDecisionDao EditDecisionDAO */
		$editorDecisions = $editDecisionDao->getEditorDecisions($reviewRound->getSubmissionId(), $reviewRound->getStageId(), $reviewRound->getRound());

		if (empty($decisions)) {
			$submissionDao = DAORegistry::getDAO('SubmissionDAO'); /* @var $submissionDao SubmissionDAO */
			$submission = $submissionDao->getById($reviewRound->getSubmissionId());
			$decisions = array_keys($this->_externalReviewStageDecisions($context, $submission));
		}
		$takenDecision = false;
		foreach ($editorDecisions as $decision) {
			if (in_array($decision['decision'], $decisions)) {
				$takenDecision = true;
				break;
			}
		}

		return $takenDecision;
	}

	/**
	 * Define and return editor decisions for the review stage.
	 * If the user cannot make decisions i.e. if it is a recommendOnly user,
	 * there will be no decisions options in the review stage.
	 * @param $context Context
	 * @param $makeDecision boolean If the user can make decisions
	 * @return array
	 */
	protected function _externalReviewStageDecisions($context, $submission, $makeDecision = true) {
		$paymentManager = Application::getPaymentManager($context);
		$decisions = array();
		if ($makeDecision) {
			$decisions = array(
				SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS => array(
					'operation' => 'sendReviewsInReview',
					'name' => 'requestRevisions',
					'title' => 'editor.submission.decision.requestRevisions',
				),
				SUBMISSION_EDITOR_DECISION_RESUBMIT => array(
					'name' => 'resubmit',
					'title' => 'editor.submission.decision.resubmit',
				),
				SUBMISSION_EDITOR_DECISION_NEW_ROUND => array(
					'name' => 'newround',
					'title' => 'editor.submission.decision.newRound',
				),
				SUBMISSION_EDITOR_DECISION_ACCEPT => array(
					'operation' => 'promoteInReview',
					'name' => 'accept',
					'title' => 'editor.submission.decision.accept',
					'toStage' => 'submission.copyediting',
					'paymentType' => $paymentManager->publicationEnabled()?PAYMENT_TYPE_PUBLICATION:null,
					'paymentAmount' => $context->getData('publicationFee'),
					'paymentCurrency' => $context->getData('currency'),
					'requestPaymentText' => __('payment.requestPublicationFee', array('feeAmount' => $context->getData('publicationFee') . ' ' . $context->getData('currency'))),
					'waivePaymentText' => __('payment.waive'),
				),
			);

			if ($submission->getStatus() == STATUS_QUEUED){
				$decisions = $decisions + array(
					SUBMISSION_EDITOR_DECISION_DECLINE => array(
						'operation' => 'sendReviewsInReview',
						'name' => 'decline',
						'title' => 'editor.submission.decision.decline',
					),
				);
			}
			if ($submission->getStatus() == STATUS_DECLINED){
				$decisions = $decisions + array(
					SUBMISSION_EDITOR_DECISION_REVERT_DECLINE => array(
						'name' => 'revert',
						'operation' => 'revertDecline',
						'title' => 'editor.submission.decision.revertDecline',
					),
				);
			}

		}
		return $decisions;
	}
}


