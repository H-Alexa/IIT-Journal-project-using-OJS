<?php

/**
 * @file classes/submission/SubmissionMetadataFormImplementation.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionMetadataFormImplementation
 * @ingroup submission
 *
 * @brief This can be used by other forms that want to
 * implement submission metadata data and form operations.
 */

import('lib.pkp.classes.submission.PKPSubmissionMetadataFormImplementation');

class SubmissionMetadataFormImplementation extends PKPSubmissionMetadataFormImplementation {
	/**
	 * @copydoc PKPSubmissionMetadataFormImplementation::_getAbstractsRequired
	 */
	function _getAbstractsRequired($submission) {
		$sectionDao = DAORegistry::getDAO('SectionDAO'); /* @var $sectionDao SectionDAO */
		$section = $sectionDao->getById($submission->getCurrentPublication()->getData('sectionId'));
		return !$section->getAbstractsNotRequired();
	}

	/**
	 *
	 * @copydoc PKPSubmissionMetadataFormImplementation::addChecks()
	 */
	function addChecks($submission) {
		parent::addChecks($submission);
		$sectionDao = DAORegistry::getDAO('SectionDAO'); /* @var $sectionDao SectionDAO */
		$section = $sectionDao->getById($submission->getCurrentPublication()->getData('sectionId'));
		$wordCount = $section->getAbstractWordCount();
		if (isset($wordCount) && $wordCount > 0) {
			$this->_parentForm->addCheck(new FormValidatorCustom($this->_parentForm, 'abstract', 'required', 'submission.submit.form.wordCountAlert', function($abstract) use($wordCount) {
				foreach ($abstract as $localizedAbstract) {
					if (count(preg_split('/\s+/', trim(str_replace('&nbsp;', ' ', strip_tags($localizedAbstract))))) > $wordCount) {
						return false;
					}
				}
				return true;
			}));
		}
	}

}


