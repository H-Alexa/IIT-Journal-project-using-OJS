<?php

/**
 * @defgroup stageAssignment Stage Assignment
 * Implements Stage Assignments, which describe the assignment of users to
 * stages (discrete parts of the workflow, e.g. Internal Review or Production).
 */

/**
 * @file classes/stageAssignment/StageAssignment.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class StageAssignment
 * @ingroup stageAssignment
 * @see StageAssignmentDAO
 *
 * @brief Basic class describing a Stage Assignment.
 */

class StageAssignment extends DataObject {

	//
	// Get/set methods
	//
	/**
	 * Set the submission ID
	 * @param $submissionId int
	 */
	function setSubmissionId($submissionId) {
		$this->setData('submissionId', $submissionId);
	}

	/**
	 * Get the submission ID
	 * @return int
	 */
	function getSubmissionId() {
		return $this->getData('submissionId');
	}

	/**
	 * Set the stage ID
	 * @param $stageId int
	 */
	function setStageId($stageId) {
		$this->setData('stageId', $stageId);
	}

	/**
	 * Get the stage ID
	 * @return int
	 */
	function getStageId() {
		return $this->getData('stageId');
	}

	/**
	 * Set the User Group ID
	 * @param $userGroupId int
	 */
	function setUserGroupId($userGroupId) {
		$this->setData('userGroupId', $userGroupId);
	}

	/**
	 * Get the User Group ID
	 * @return int
	 */
	function getUserGroupId() {
		return $this->getData('userGroupId');
	}

	/**
	 * Get user ID for this stageAssignment.
	 * @return int
	 */
	function getUserId() {
		return $this->getData('userId');
	}

	/**
	 * Set user ID for this stageAssignment.
	 * @param $userId int
	 */
	function setUserId($userId) {
		$this->setData('userId', $userId);
	}

	/**
	 * Set the date assigned
	 * @param $dateAssigned datestamp (YYYY-MM-DD HH:MM:SS)
	 */
	function setDateAssigned($dateAssigned) {
		$this->setData('dateAssigned', $dateAssigned);
	}

	/**
	 * Get the date assigned
	 * @return datestamp (YYYY-MM-DD HH:MM:SS)
	 */
	function getDateAssigned() {
		return $this->getData('dateAssigned');
	}

	/**
	 * Get recommendOnly option.
	 * @return boolean
	 */
	function getRecommendOnly() {
		return $this->getData('recommendOnly');
	}

	/**
	 * Set recommendOnly option.
	 * @param $recommendOnly boolean
	 */
	function setRecommendOnly($recommendOnly) {
		$this->setData('recommendOnly', $recommendOnly);
	}

	/**
	 * Get permit metadata edit option.
	 * @return boolean
	 */
	function getCanChangeMetadata() {
		return $this->getData('canChangeMetadata');
	}

	/**
	 * Set permit metadata edit option.
	 * @param $permitMetadataEdits boolean
	 */
	function setCanChangeMetadata($canChangeMetadata) {
		$this->setData('canChangeMetadata', $canChangeMetadata);
	}

}


