<?php
/**
 * @file classes/security/authorization/internal/ReviewRoundRequiredPolicy.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ReviewRoundRequiredPolicy
 * @ingroup security_authorization_internal
 *
 * @brief Policy that ensures that the request contains a valid review round.
 */

import('lib.pkp.classes.security.authorization.DataObjectRequiredPolicy');

class ReviewRoundRequiredPolicy extends DataObjectRequiredPolicy {

	/** @var int Review round id. */
	public $_reviewRoundId;

	/**
	 * Constructor
	 * @param $request PKPRequest
	 * @param $args array request parameters
	 * @param $parameterName string the request parameter we expect
	 *  the submission id in.
	 * @param $operations array Optional list of operations for which this check takes effect. If specified, operations outside this set will not be checked against this policy.
	 * @param $reviewRoundId int Optionally pass the review round id directly. If passed, the $parameterName will be ignored.
	 */
	function __construct($request, &$args, $parameterName = 'reviewRoundId', $operations = null, $reviewRoundId = null) {
		parent::__construct($request, $args, $parameterName, 'user.authorization.invalidReviewRound', $operations);
		if ($reviewRoundId) {
			$this->_reviewRoundId = $reviewRoundId;
		}
	}

	//
	// Implement template methods from AuthorizationPolicy
	//
	/**
	 * @see DataObjectRequiredPolicy::dataObjectEffect()
	 */
	function dataObjectEffect() {
		// Get the review round id.
		if (!$this->_reviewRoundId) {
			$this->_reviewRoundId = $this->getDataObjectId();
		}
		if ($this->_reviewRoundId === false) return AUTHORIZATION_DENY;

		// Validate the review round id.
		$reviewRoundDao = DAORegistry::getDAO('ReviewRoundDAO'); /* @var $reviewRoundDao ReviewRoundDAO */
		$reviewRound = $reviewRoundDao->getById($this->_reviewRoundId);
		if (!is_a($reviewRound, 'ReviewRound')) return AUTHORIZATION_DENY;

		// Ensure that the review round actually belongs to the
		// authorized submission.
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		if ($reviewRound->getSubmissionId() != $submission->getId()) return AUTHORIZATION_DENY;

		// Ensure that the review round is for this workflow stage
		$stageId = $this->getAuthorizedContextObject(ASSOC_TYPE_WORKFLOW_STAGE);
		if ($reviewRound->getStageId() != $stageId) return AUTHORIZATION_DENY;

		// Save the review round to the authorization context.
		$this->addAuthorizedContextObject(ASSOC_TYPE_REVIEW_ROUND, $reviewRound);
		return AUTHORIZATION_PERMIT;
	}
}


