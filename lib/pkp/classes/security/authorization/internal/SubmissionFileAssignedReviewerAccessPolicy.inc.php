<?php
/**
 * @file classes/security/authorization/internal/SubmissionFileAssignedReviewerAccessPolicy.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionFileAssignedReviewerAccessPolicy
 * @ingroup security_authorization_internal
 *
 * @brief Submission file policy to check if the current user is an assigned
 * 	reviewer of the file.
 *
 */

import('lib.pkp.classes.security.authorization.internal.SubmissionFileBaseAccessPolicy');

class SubmissionFileAssignedReviewerAccessPolicy extends SubmissionFileBaseAccessPolicy {
	/**
	 * Constructor
	 * @param $request PKPRequest
	 */
	function __construct($request, $submissionFileId = null) {
		parent::__construct($request, $submissionFileId);
	}


	//
	// Implement template methods from AuthorizationPolicy
	//
	/**
	 * @see AuthorizationPolicy::effect()
	 */
	function effect() {
		$request = $this->getRequest();

		// Get the user
		$user = $request->getUser();
		if (!is_a($user, 'User')) return AUTHORIZATION_DENY;

		// Get the submission file
		$submissionFile = $this->getSubmissionFile($request);
		if (!is_a($submissionFile, 'SubmissionFile')) return AUTHORIZATION_DENY;

		$context = $request->getContext();
		$reviewAssignmentDao = DAORegistry::getDAO('ReviewAssignmentDAO'); /* @var $reviewAssignmentDao ReviewAssignmentDAO */
		$reviewAssignments = $reviewAssignmentDao->getByUserId($user->getId());
		$reviewFilesDao = DAORegistry::getDAO('ReviewFilesDAO'); /* @var $reviewFilesDao ReviewFilesDAO */
		foreach ($reviewAssignments as $reviewAssignment) {
			if ($context->getData('restrictReviewerFileAccess') && !$reviewAssignment->getDateConfirmed()) continue;

			if (
				$submissionFile->getData('submissionId') == $reviewAssignment->getSubmissionId() &&
				$submissionFile->getData('fileStage') == SUBMISSION_FILE_REVIEW_FILE &&
				$reviewFilesDao->check($reviewAssignment->getId(), $submissionFile->getId())
			) {
				$this->addAuthorizedContextObject(ASSOC_TYPE_REVIEW_ASSIGNMENT, $reviewAssignment);
				return AUTHORIZATION_PERMIT;
			}
		}

		// If a pass condition wasn't found above, deny access.
		return AUTHORIZATION_DENY;
	}
}


