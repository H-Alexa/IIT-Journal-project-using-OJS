<?php
/**
 * @file classes/security/authorization/internal/SubmissionFileRequestedRevisionRequiredPolicy.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionFileRequestedRevisionRequiredPolicy
 * @ingroup security_authorization_internal
 *
 * @brief Base Submission file policy to ensure we have a viewable file that is part of
 * a review round with the requested revision decision.
 *
 */

import('lib.pkp.classes.security.authorization.internal.SubmissionFileBaseAccessPolicy');

class SubmissionFileRequestedRevisionRequiredPolicy extends SubmissionFileBaseAccessPolicy {
	/**
	 * Constructor
	 * @param $request PKPRequest
	 */
	function __construct($request, $submissionFileId = null) {
		parent::__construct($request, $submissionFileId);
	}


	//
	// Implement template methods from AuthorizationPolicy
	// Note:  This class is subclassed in each Application, so that Policies have the opportunity to add
	// constraints to the effect() method.  See e.g. SubmissionFileRequestedRevisionRequiredPolicy.inc.php in OMP.
	//
	/**
	 * @see AuthorizationPolicy::effect()
	 */
	function effect() {
		$request = $this->getRequest();
		$reviewRoundDao = DAORegistry::getDAO('ReviewRoundDAO'); /* @var $reviewRoundDao ReviewRoundDAO */

		// Get the submission file.
		$submissionFile = $this->getSubmissionFile($request);
		if (!is_a($submissionFile, 'SubmissionFile')) return AUTHORIZATION_DENY;

		// Make sure the file is part of a review round
		// with a requested revision decision.
		$reviewRound = $reviewRoundDao->getBySubmissionFileId($submissionFile->getId());
		if (!is_a($reviewRound, 'ReviewRound')) return AUTHORIZATION_DENY;
		import('classes.workflow.EditorDecisionActionsManager');
		if (!(new EditorDecisionActionsManager())->getEditorTakenActionInReviewRound($request->getContext(), $reviewRound, array(SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS))) {
			return AUTHORIZATION_DENY;
		}

		// Make sure review round stage is the same of the current stage in request.
		$stageId = $this->getAuthorizedContextObject(ASSOC_TYPE_WORKFLOW_STAGE);
		if ($reviewRound->getStageId() != $stageId) return AUTHORIZATION_DENY;

		// Make sure the file stage is SUBMISSION_FILE_REVIEW_REVISION.
		if ($submissionFile->getData('fileStage') != SUBMISSION_FILE_REVIEW_REVISION) return AUTHORIZATION_DENY;

		$reviewRoundDao = DAORegistry::getDAO('ReviewRoundDAO'); /* @var $reviewRoundDao ReviewRoundDAO */

		// Make sure that the last review round editor decision is request revisions.
		$editDecisionDao = DAORegistry::getDAO('EditDecisionDAO'); /* @var $editDecisionDao EditDecisionDAO */
		$reviewRoundDecisions = $editDecisionDao->getEditorDecisions($submissionFile->getData('submissionId'), $reviewRound->getStageId(), $reviewRound->getRound());
		if (empty($reviewRoundDecisions)) return AUTHORIZATION_DENY;

		$lastEditorDecision = array_pop($reviewRoundDecisions);
		if ($lastEditorDecision['decision'] != SUBMISSION_EDITOR_DECISION_PENDING_REVISIONS) return AUTHORIZATION_DENY;

		// Made it through -- permit access.
		return AUTHORIZATION_PERMIT;
	}
}


