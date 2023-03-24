<?php

/**
 * @file classes/submission/reviewer/form/PKPReviewerReviewStep2Form.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPReviewerReviewStep2Form
 * @ingroup submission_reviewer_form
 *
 * @brief Form for Step 2 of a review.
 */

import('lib.pkp.classes.submission.reviewer.form.ReviewerReviewForm');

class PKPReviewerReviewStep2Form extends ReviewerReviewForm {
	/**
	 * Constructor.
	 * @param $reviewerSubmission ReviewerSubmission
	 */
	function __construct($request, $reviewerSubmission, $reviewAssignment) {
		parent::__construct($request, $reviewerSubmission, $reviewAssignment, 2);
	}


	//
	// Implement protected template methods from Form
	//
	/**
	 * @copydoc ReviewerReviewForm::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$templateMgr = TemplateManager::getManager($request);
		$context = $this->request->getContext();

		$reviewAssignment = $this->getReviewAssignment();
		$reviewerGuidelines = $context->getLocalizedData($reviewAssignment->getStageId()==WORKFLOW_STAGE_ID_INTERNAL_REVIEW?'internalReviewGuidelines':'reviewGuidelines');
		if (empty($reviewerGuidelines)) {
			$reviewerGuidelines = __('reviewer.submission.noGuidelines');
		}
		$templateMgr->assign('reviewerGuidelines', $reviewerGuidelines);

		return parent::fetch($request, $template, $display);
	}


	/**
	 * @see Form::execute()
	 */
	function execute(...$functionParams) {
		// Set review to next step.
		$this->updateReviewStepAndSaveSubmission($this->getReviewerSubmission());

		parent::execute(...$functionParams);
	}

}


