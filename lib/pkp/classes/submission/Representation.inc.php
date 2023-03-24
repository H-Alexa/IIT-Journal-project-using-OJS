<?php

/**
 * @file classes/submission/Representation.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Representation
 * @ingroup submission
 *
 * @brief A submission's representation (Publication Format, Galley, ...)
 */

import('lib.pkp.classes.core.DataObject');

class Representation extends DataObject {
	/**
	 * Constructor.
	 */
	function __construct() {
		// Switch on meta-data adapter support.
		$this->setHasLoadableAdapters(true);

		parent::__construct();
	}

	/**
	 * Get sequence of format in format listings for the submission.
	 * @return float
	 */
	function getSequence() {
		return $this->getData('seq');
	}

	/**
	 * Set sequence of format in format listings for the submission.
	 * @param $seq float
	 */
	function setSequence($seq) {
		$this->setData('seq', $seq);
	}

	/**
	 * Get "localized" format name (if applicable).
	 * @return string
	 */
	function getLocalizedName() {
		return $this->getLocalizedData('name');
	}

	/**
	 * Get the format name (if applicable).
	 * @param $locale string
	 * @return string
	 */
	function getName($locale) {
		return $this->getData('name', $locale);
	}

	/**
	 * Set name.
	 * @param $name string
	 * @param $locale
	 */
	function setName($name, $locale = null) {
		$this->setData('name', $name, $locale);
	}

	/**
	 * Determines if a representation is approved or not.
	 * @return boolean
	 */
	function getIsApproved() {
		return (boolean) $this->getData('isApproved');
	}

	/**
	 * Sets whether a representation is approved or not.
	 * @param boolean $isApproved
	 */
	function setIsApproved($isApproved) {
		return $this->setData('isApproved', $isApproved);
	}

	/**
	 * Get stored public ID of the submission.
	 * @param $pubIdType string One of the NLM pub-id-type values or
	 * 'other::something' if not part of the official NLM list
	 * (see <http://dtd.nlm.nih.gov/publishing/tag-library/n-4zh0.html>).
	 * @return int
	 */
	function getStoredPubId($pubIdType) {
		return $this->getData('pub-id::'.$pubIdType);
	}

	/**
	 * Set the stored public ID of the submission.
	 * @param $pubIdType string One of the NLM pub-id-type values or
	 * 'other::something' if not part of the official NLM list
	 * (see <http://dtd.nlm.nih.gov/publishing/tag-library/n-4zh0.html>).
	 * @param $pubId string
	 */
	function setStoredPubId($pubIdType, $pubId) {
		$this->setData('pub-id::'.$pubIdType, $pubId);
	}

	/**
	 * Get the remote URL at which this representation is retrievable.
	 * @return string
	 * @deprecated 3.2.0.0
	 */
	function getRemoteURL() {
		return $this->getData('urlRemote');
	}

	/**
	 * Set the remote URL for retrieving this representation.
	 * @param $remoteURL string
	 * @deprecated 3.2.0.0
	 */
	function setRemoteURL($remoteURL) {
		return $this->setData('urlRemote', $remoteURL);
	}

	/**
	 * Get the context id from the submission assigned to this representation.
	 * @return int
	 */
	function getContextId() {
		$publication = Services::get('publication')->get($this->getData('publicationId'));
		$submissionDao = DAORegistry::getDAO('SubmissionDAO'); /* @var $submissionDao SubmissionDAO */
		$submission = $submissionDao->getById($publication->getData('submissionId'));
		return $submission->getContextId();
	}

	/**
	 * @copydoc DataObject::getDAO()
	 */
	function getDAO() {
		return Application::getRepresentationDAO();
	}
}


