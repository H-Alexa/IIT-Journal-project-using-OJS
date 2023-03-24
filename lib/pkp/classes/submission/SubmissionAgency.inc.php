<?php

/**
 * @file classes/submission/SubmissionAgency.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionAgency
 * @ingroup submission
 * @see SubmissionAgencyEntryDAO
 *
 * @brief Basic class describing a submission agency
 */

import('lib.pkp.classes.controlledVocab.ControlledVocabEntry');

class SubmissionAgency extends ControlledVocabEntry {
	//
	// Get/set methods
	//

	/**
	 * Get the agency
	 * @return string
	 */
	function getAgency() {
		return $this->getData('submissionAgency');
	}

	/**
	 * Set the agency text
	 * @param agency string
	 * @param locale string
	 */
	function setAgency($agency, $locale) {
		$this->setData('submissionAgency', $agency, $locale);
	}

	function getLocaleMetadataFieldNames() {
		return array('submissionAgency');
	}
}

