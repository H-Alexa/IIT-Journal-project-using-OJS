<?php

/**
 * @file classes/submission/reviewAssignment/ReviewAssignmentDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ReviewAssignmentDAO
 * @ingroup submission
 * @see ReviewAssignment
 *
 * @brief Class for DAO relating reviewers to submissions.
 */


import('lib.pkp.classes.submission.reviewAssignment.ReviewAssignment');

class ReviewAssignmentDAO extends DAO {
	var $userDao;

	/**
	 * Constructor.
	 */
	function __construct() {
		parent::__construct();
		$this->userDao = DAORegistry::getDAO('UserDAO');
	}


	/**
	 * Retrieve review assignments for the passed review round id.
	 * @param $reviewRoundId int
	 * @return array
	 */
	function getByReviewRoundId($reviewRoundId) {
		$params = array((int)$reviewRoundId);
		$query = $this->_getSelectQuery() .
			' WHERE r.review_round_id = ? ORDER BY review_id';
		return $this->_getReviewAssignmentsArray($query, $params);
	}

	/**
	 * Retrieve open review assignments for the passed review round id.
	 * @param $reviewRoundId int
	 * @return array
	 */
	function getOpenReviewsByReviewRoundId($reviewRoundId) {
		$params = array((int)$reviewRoundId, SUBMISSION_REVIEW_METHOD_OPEN);
		$query = $this->_getSelectQuery() .
			' WHERE r.review_round_id = ? AND r.review_method = ? AND r.date_confirmed IS NOT NULL AND r.declined <> 1 ORDER BY review_id';
		return $this->_getReviewAssignmentsArray($query, $params);
	}

	/**
	 * Retrieve review assignments from table usign the passed
	 * sql query and parameters.
	 * @param $query string
	 * @param $queryParams array
	 * @return array
	 */
	function _getReviewAssignmentsArray($query, $queryParams) {
		$result = $this->retrieve($query, $queryParams);

		$reviewAssignments = [];
		foreach ($result as $row) {
			$reviewAssignments[$row->review_id] = $this->_fromRow((array) $row);
		}
		return $reviewAssignments;
	}

	/**
	 * Get the review_rounds join string. Must be implemented
	 * by subclasses.
	 * @return string
	 */
	function getReviewRoundJoin() {
		return 'r.review_round_id = r2.review_round_id';
	}


	//
	// Public methods.
	//
	/**
	 * Retrieve a review assignment by review round and reviewer.
	 * @param $reviewRoundId int
	 * @param $reviewerId int
	 * @return ReviewAssignment
	 */
	function getReviewAssignment($reviewRoundId, $reviewerId) {
		$result = $this->retrieve(
			$this->_getSelectQuery() .
			' WHERE	r.review_round_id = ? AND
				r.reviewer_id = ?',
			[
				(int) $reviewRoundId,
				(int) $reviewerId
			]
		);
		$row = $result->current();
		return $row ? $this->_fromRow((array) $row) : null;
	}

	/**
	 * Retrieve a review assignment by review assignment id.
	 * @param $reviewId int
	 * @return ReviewAssignment
	 */
	function getById($reviewId) {
		$result = $this->retrieve(
			'SELECT	r.*, r2.review_revision
			FROM	review_assignments r
				LEFT JOIN review_rounds r2 ON (' . $this->getReviewRoundJoin() . ')
			WHERE	r.review_id = ?',
			[(int) $reviewId]
		);
		$row = $result->current();
		return $row ? $this->_fromRow((array) $row) : null;
	}

	/**
	 * Get all incomplete review assignments for all journals/conferences/presses
	 * @param $articleId int
	 * @return array ReviewAssignments
	 */
	function getIncompleteReviewAssignments() {
		$result = $this->retrieve(
			'SELECT	r.*, r2.review_revision
			FROM	review_assignments r
				LEFT JOIN review_rounds r2 ON (' . $this->getReviewRoundJoin() . ')
			WHERE' . $this->getIncompleteReviewAssignmentsWhereString() .
			' ORDER BY r.submission_id'
		);

		$reviewAssignments = [];
		foreach ($result as $row) {
			$reviewAssignments[] = $this->_fromRow((array) $row);
		}
		return $reviewAssignments;
	}

	/**
	 * Get the WHERE sql string to filter incomplete review
	 * assignments.
	 * @return string
	 */
	function getIncompleteReviewAssignmentsWhereString() {
		return ' r.date_notified IS NOT NULL AND
		r.date_completed IS NULL AND
		r.declined <> 1 AND
		r.cancelled <> 1';
	}

	/**
	 * Get all review assignments for a submission.
	 * @param $submissionId int Submission ID
	 * @param $reviewRoundId int Review round ID
	 * @param $stageId int Optional stage ID
	 * @return array ReviewAssignments
	 */
	function getBySubmissionId($submissionId, $reviewRoundId = null, $stageId = null) {
		$query = $this->_getSelectQuery() .
			' WHERE	r.submission_id = ?';

		$orderBy = ' ORDER BY review_id';

		$queryParams[] = (int) $submissionId;

		if ($reviewRoundId != null) {
			$query .= ' AND r2.review_round_id = ?';
			$queryParams[] = (int) $reviewRoundId;
		} else {
			$orderBy .= ', r2.review_round_id';
		}

		if ($stageId != null) {
			$query .= ' AND r2.stage_id = ?';
			$queryParams[] = (int) $stageId;
		} else {
			$orderBy .= ', r2.stage_id';
		}

		$query .= $orderBy;

		return $this->_getReviewAssignmentsArray($query, $queryParams);
	}

	/**
	 * Retrieve all review assignments by submission and reviewer.
	 * @param $submissionId int
	 * @param $reviewerId int
	 * @param $stageId int optional
	 * @return array
	 */
	function getBySubmissionReviewer($submissionId, $reviewerId, $stageId = null) {
		$query = $this->_getSelectQuery() .
			' WHERE	r.submission_id = ? AND r.reviewer_id = ?';
		$queryParams = [(int) $submissionId, (int) $reviewerId];
		if ($stageId != null) {
			$query .= ' AND r.stage_id = ?';
			$queryParams[] = (int) $stageId;
		}
		return $this->_getReviewAssignmentsArray($query, $queryParams);
	}

	/**
	 * Get all review assignments for a reviewer.
	 * @param $userId int
	 * @return array ReviewAssignments
	 */
	function getByUserId($userId) {
		$reviewRoundJoinString = $this->getReviewRoundJoin();

		if (!$reviewRoundJoinString) throw new Exception('Review round join string not specified');
		$result = $this->retrieve(
			'SELECT	r.*, r2.review_revision
			FROM	review_assignments r
				LEFT JOIN review_rounds r2 ON (' . $reviewRoundJoinString . ')
			WHERE	r.reviewer_id = ?
			ORDER BY round, review_id',
			[(int) $userId]
		);

		$reviewAssignments = [];
		foreach ($result as $row) {
			$reviewAssignments[] = $this->_fromRow((array) $row);
		}

		return $reviewAssignments;
	}

	/**
	 * Check if a reviewer is assigned to a specified submission.
	 * @param $reviewRoundId int
	 * @param $reviewerId int
	 * @return boolean
	 */
	function reviewerExists($reviewRoundId, $reviewerId) {
		$result = $this->retrieve(
			'SELECT COUNT(*) AS row_count
			FROM	review_assignments
			WHERE	review_round_id = ? AND
			reviewer_id = ?',
			[(int) $reviewRoundId, (int) $reviewerId]
		);
		$row = (array) $result->current();
		return $row && $row['row_count'] == 1;
	}

	/**
	 * Get all review assignments for a review form.
	 * @param $reviewFormId int
	 * @return array ReviewAssignments
	 */
	function getByReviewFormId($reviewFormId) {
		$reviewRoundJoinString = $this->getReviewRoundJoin();

		if (!$reviewRoundJoinString) throw new Exception('Review round join string not specified');
		$result = $this->retrieve(
			'SELECT	r.*, r2.review_revision
			FROM	review_assignments r
				LEFT JOIN review_rounds r2 ON (' . $reviewRoundJoinString . ')
			WHERE	r.review_form_id = ?
			ORDER BY round, review_id',
			[(int) $reviewFormId]
		);

		$reviewAssignments = array();
		foreach ($result as $row) {
			$reviewAssignments[] = $this->_fromRow((array) $row);
		}
		return $reviewAssignments;
	}

	/**
	 * Determine the order of active reviews for the given round of the given submission
	 * @param $submissionId int Submission ID
	 * @param $reviewRoundId int Review round ID
	 * @return array Associating review ID with number, i.e. if review ID 26 is first returned['26']=0.
	 */
	function getReviewIndexesForRound($submissionId, $reviewRoundId) {
		$result = $this->retrieve(
			'SELECT	review_id
			FROM	review_assignments
			WHERE	submission_id = ? AND
				review_round_id = ?
			ORDER BY review_id',
			[(int) $submissionId, (int) $reviewRoundId]
		);

		$index = 0;
		$returner = [];
		foreach ($result as $row) {
			$returner[$row->review_id] = $index++;
		}
		return $returner;
	}

	/**
	 * Insert a new Review Assignment.
	 * @param $reviewAssignment ReviewAssignment
	 */
	function insertObject($reviewAssignment) {
		$result = $this->update(
			sprintf('INSERT INTO review_assignments (
				submission_id,
				reviewer_id,
				stage_id,
				review_method,
				round,
				competing_interests,
				recommendation,
				declined,
				cancelled,
				date_assigned, date_notified, date_confirmed,
				date_completed, date_acknowledged, date_due, date_response_due,
				quality, date_rated,
				last_modified,
				date_reminded, reminder_was_automatic,
				review_form_id,
				review_round_id,
				unconsidered
				) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?, %s, %s, %s, %s, %s, %s, %s, ?, %s, %s, %s, ?, ?, ?, ?
				)',
				$this->datetimeToDB($reviewAssignment->getDateAssigned()),
				$this->datetimeToDB($reviewAssignment->getDateNotified()),
				$this->datetimeToDB($reviewAssignment->getDateConfirmed()),
				$this->datetimeToDB($reviewAssignment->getDateCompleted()),
				$this->datetimeToDB($reviewAssignment->getDateAcknowledged()),
				$this->datetimeToDB($reviewAssignment->getDateDue()),
				$this->datetimeToDB($reviewAssignment->getDateResponseDue()),
				$this->datetimeToDB($reviewAssignment->getDateRated()),
				$this->datetimeToDB($reviewAssignment->getLastModified()),
				$this->datetimeToDB($reviewAssignment->getDateReminded())
			), array(
				(int) $reviewAssignment->getSubmissionId(),
				(int) $reviewAssignment->getReviewerId(),
				(int) $reviewAssignment->getStageId(),
				(int) $reviewAssignment->getReviewMethod(),
				max((int) $reviewAssignment->getRound(), 1),
				$reviewAssignment->getCompetingInterests(),
				$reviewAssignment->getRecommendation(),
				(int) $reviewAssignment->getDeclined(),
				(int) $reviewAssignment->getCancelled(),
				$reviewAssignment->getQuality(),
				(int) $reviewAssignment->getReminderWasAutomatic(),
				$reviewAssignment->getReviewFormId(),
				(int) $reviewAssignment->getReviewRoundId(),
				(int) $reviewAssignment->getUnconsidered(),
			)
		);

		$reviewAssignment->setId($this->getInsertId());

		// Update review stage status whenever a review assignment is changed
		$this->updateReviewRoundStatus($reviewAssignment);
	}

	/**
	 * Update an existing review assignment.
	 * @param $reviewAssignment object
	 */
	function updateObject($reviewAssignment) {
		$result = $this->update(
			sprintf('UPDATE review_assignments
				SET	submission_id = ?,
					reviewer_id = ?,
					stage_id = ?,
					review_method = ?,
					round = ?,
					competing_interests = ?,
					recommendation = ?,
					declined = ?,
					cancelled = ?,
					date_assigned = %s,
					date_notified = %s,
					date_confirmed = %s,
					date_completed = %s,
					date_acknowledged = %s,
					date_due = %s,
					date_response_due = %s,
					quality = ?,
					date_rated = %s,
					last_modified = %s,
					date_reminded = %s,
					reminder_was_automatic = ?,
					review_form_id = ?,
					review_round_id = ?,
					unconsidered = ?
				WHERE review_id = ?',
				$this->datetimeToDB($reviewAssignment->getDateAssigned()), $this->datetimeToDB($reviewAssignment->getDateNotified()), $this->datetimeToDB($reviewAssignment->getDateConfirmed()), $this->datetimeToDB($reviewAssignment->getDateCompleted()), $this->datetimeToDB($reviewAssignment->getDateAcknowledged()), $this->datetimeToDB($reviewAssignment->getDateDue()), $this->datetimeToDB($reviewAssignment->getDateResponseDue()), $this->datetimeToDB($reviewAssignment->getDateRated()), $this->datetimeToDB($reviewAssignment->getLastModified()), $this->datetimeToDB($reviewAssignment->getDateReminded())),
			array(
				(int) $reviewAssignment->getSubmissionId(),
				(int) $reviewAssignment->getReviewerId(),
				(int) $reviewAssignment->getStageId(),
				(int) $reviewAssignment->getReviewMethod(),
				(int) $reviewAssignment->getRound(),
				$reviewAssignment->getCompetingInterests(),
				$reviewAssignment->getRecommendation(),
				(int) $reviewAssignment->getDeclined(),
				(int) $reviewAssignment->getCancelled(),
				$reviewAssignment->getQuality(),
				$reviewAssignment->getReminderWasAutomatic(),
				$reviewAssignment->getReviewFormId(),
				(int) $reviewAssignment->getReviewRoundId(),
				(int) $reviewAssignment->getUnconsidered(),
				(int) $reviewAssignment->getId()
			)
		);

		// Update review stage status whenever a review assignment is changed
		$this->updateReviewRoundStatus($reviewAssignment);
	}

	/**
	 * Update the status of the review round an assignment is attached to. This
	 * should be fired whenever a reviewer assignment is modified.
	 *
	 * @param $reviewAssignment ReviewAssignment
	 */
	public function updateReviewRoundStatus($reviewAssignment) {
		import('lib.pkp.classes.submission.reviewRound/ReviewRoundDAO');
		$reviewRoundDao = DAORegistry::getDAO('ReviewRoundDAO'); /* @var $reviewRoundDao ReviewRoundDAO */
		$reviewRound = $reviewRoundDao->getReviewRound(
			$reviewAssignment->getSubmissionId(),
			$reviewAssignment->getStageId(),
			$reviewAssignment->getRound()
		);

		// Review round may not exist if submission is being deleted
		if ($reviewRound) {
			return $reviewRoundDao->updateStatus($reviewRound);
		}

		return false;
	}

	/**
	 * Internal function to return a review assignment object from a row.
	 * @param $row array
	 * @return ReviewAssignment
	 */
	function _fromRow($row) {
		$reviewAssignment = $this->newDataObject();
		$user = $this->userDao->getById($row['reviewer_id']);

		$reviewAssignment->setId((int) $row['review_id']);
		$reviewAssignment->setSubmissionId((int) $row['submission_id']);
		$reviewAssignment->setReviewerId((int) $row['reviewer_id']);
		$reviewAssignment->setReviewerFullName($user->getFullName());
		$reviewAssignment->setCompetingInterests($row['competing_interests']);
		$reviewAssignment->setRecommendation($row['recommendation']);
		$reviewAssignment->setDateAssigned($this->datetimeFromDB($row['date_assigned']));
		$reviewAssignment->setDateNotified($this->datetimeFromDB($row['date_notified']));
		$reviewAssignment->setDateConfirmed($this->datetimeFromDB($row['date_confirmed']));
		$reviewAssignment->setDateCompleted($this->datetimeFromDB($row['date_completed']));
		$reviewAssignment->setDateAcknowledged($this->datetimeFromDB($row['date_acknowledged']));
		$reviewAssignment->setDateDue($this->datetimeFromDB($row['date_due']));
		$reviewAssignment->setDateResponseDue($this->datetimeFromDB($row['date_response_due']));
		$reviewAssignment->setLastModified($this->datetimeFromDB($row['last_modified']));
		$reviewAssignment->setDeclined((int) $row['declined']);
		$reviewAssignment->setCancelled((int) $row['cancelled']);
		$reviewAssignment->setQuality($row['quality']);
		$reviewAssignment->setDateRated($this->datetimeFromDB($row['date_rated']));
		$reviewAssignment->setDateReminded($this->datetimeFromDB($row['date_reminded']));
		$reviewAssignment->setReminderWasAutomatic((int) $row['reminder_was_automatic']);
		$reviewAssignment->setRound((int) $row['round']);
		$reviewAssignment->setReviewFormId($row['review_form_id']);
		$reviewAssignment->setReviewRoundId((int) $row['review_round_id']);
		$reviewAssignment->setReviewMethod((int) $row['review_method']);
		$reviewAssignment->setStageId((int) $row['stage_id']);
		$reviewAssignment->setUnconsidered((int) $row['unconsidered']);

		return $reviewAssignment;
	}

	/**
	 * Return a new review assignment data object.
	 * @return DataObject
	 */
	function newDataObject() {
		return new ReviewAssignment();
	}

	/**
	 * Delete review assignment.
	 * @param $reviewId int
	 */
	function deleteById($reviewId) {
		$reviewFormResponseDao = DAORegistry::getDAO('ReviewFormResponseDAO'); /* @var $reviewFormResponseDao ReviewFormResponseDAO */
		$reviewFormResponseDao->deleteByReviewId($reviewId);

		$reviewFilesDao = DAORegistry::getDAO('ReviewFilesDAO'); /* @var $reviewFilesDao ReviewFilesDAO */
		$reviewFilesDao->revokeByReviewId($reviewId);

		$notificationDao = DAORegistry::getDAO('NotificationDAO'); /* @var $notificationDao NotificationDAO */
		$notificationDao->deleteByAssoc(ASSOC_TYPE_REVIEW_ASSIGNMENT, $reviewId);

		// Retrieve the review assignment before it's deleted, so it can be
		// be used to fire an update on the review round status.
		import('lib.pkp.classes.submission.reviewRound/ReviewRoundDAO');
		$reviewAssignment = $this->getById($reviewId);

		$result = $this->update('DELETE FROM review_assignments WHERE review_id = ?', [(int) $reviewId]);

		$this->updateReviewRoundStatus($reviewAssignment);

		return $result;
	}

	/**
	 * Delete review assignments by submission ID.
	 * @param $submissionId int
	 * @return boolean
	 */
	function deleteBySubmissionId($submissionId) {
		$result = $this->retrieve(
			'SELECT review_id FROM review_assignments WHERE submission_id = ?',
			array((int) $submissionId)
		);

		$returner = false;
		foreach ($result as $row) {
			$this->deleteById($row->review_id);
			$returner = true;
		}
		return $returner;
	}

	/**
	 * Get the ID of the last inserted review assignment.
	 * @return int
	 */
	function getInsertId() {
		return $this->_getInsertId('review_assignments', 'review_id');
	}

	/**
	 * Get the last review round review assignment for a given user.
	 * @param $submissionId int
	 * @param $reviewerId int
	 * @return ReviewAssignment?
	 */
	function getLastReviewRoundReviewAssignmentByReviewer($submissionId, $reviewerId) {
		$result = $this->retrieve(
			$this->_getSelectQuery() .  ' WHERE	r.submission_id = ? AND r.reviewer_id = ?  ORDER BY r2.stage_id DESC, r2.round DESC',
			[(int) $submissionId, (int) $reviewerId]
		);
		$row = (array) $result->current();
		return $row?$this->_fromRow($row):null;
	}

	/**
	 * Return the review methods translation keys.
	 * @return array
	 */
	function getReviewMethodsTranslationKeys() {
		AppLocale::requireComponents(LOCALE_COMPONENT_PKP_EDITOR);
		return array(
			SUBMISSION_REVIEW_METHOD_DOUBLEANONYMOUS => 'editor.submissionReview.doubleAnonymous',
			SUBMISSION_REVIEW_METHOD_ANONYMOUS => 'editor.submissionReview.anonymous',
			SUBMISSION_REVIEW_METHOD_OPEN => 'editor.submissionReview.open',
		);
	}

	/**
	 * Get sql query to select review assignments.
	 * @return string
	 */
	function _getSelectQuery() {
		return 'SELECT r.*, r2.review_revision FROM review_assignments r
			LEFT JOIN review_rounds r2 ON (r.review_round_id = r2.review_round_id)';
	}
}


