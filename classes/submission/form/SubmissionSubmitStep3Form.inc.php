<?php

/**
 * @file classes/submission/form/SubmissionSubmitStep3Form.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionSubmitStep3Form
 * @ingroup submission_form
 *
 * @brief Form for Step 3 of author submission.
 */

import('lib.pkp.classes.submission.form.PKPSubmissionSubmitStep3Form');
import('classes.submission.SubmissionMetadataFormImplementation');

class SubmissionSubmitStep3Form extends PKPSubmissionSubmitStep3Form {
	/**
	 * Constructor.
	 */
	function __construct($context, $submission) {
		parent::__construct(
			$context,
			$submission,
			new SubmissionMetadataFormImplementation($this)
		);
	}

	/**
	 * @copydoc SubmissionSubmitForm::fetch
	 */
	function fetch($request, $template = null, $display = false) {
		$templateMgr = TemplateManager::getManager($request);
		// get word count of the section
		$sectionDao = DAORegistry::getDAO('SectionDAO'); /* @var $sectionDao SectionDAO */
		$section = $sectionDao->getById($this->submission->getCurrentPublication()->getData('sectionId'));
		$wordCount = $section->getAbstractWordCount();
		$templateMgr->assign('wordCount', $wordCount);
		return parent::fetch($request, $template, $display);
	}
}


