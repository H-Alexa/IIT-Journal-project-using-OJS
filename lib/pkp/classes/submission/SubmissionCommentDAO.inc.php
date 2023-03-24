<?php

/**
 * @file classes/submission/SubmissionCommentDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionCommentDAO
 * @ingroup submission
 * @see SubmissionComment
 *
 * @brief Operations for retrieving and modifying SubmissionComment objects.
 */

import('lib.pkp.classes.submission.SubmissionComment');

class SubmissionCommentDAO extends DAO {

	/**
	 * Retrieve SubmissionComments by submission id
	 * @param $submissionId int Submission ID
	 * @param $commentType int Comment type
	 * @param $assocId int Assoc ID
	 * @return DAOResultFactory
	 */
	function getSubmissionComments($submissionId, $commentType = null, $assocId = null) {
		$params = [(int) $submissionId];
		if ($commentType) $params[] = (int) $commentType;
		if ($assocId) $params[] = (int) $assocId;
		return new DAOResultFactory(
			$this->retrieve(
				'SELECT	a.*
				FROM	submission_comments a
				WHERE	submission_id = ?'
					. ($commentType?' AND comment_type = ?':'')
					. ($assocId?' AND assoc_id = ?':'')
					. ' ORDER BY date_posted',
				$params
			),
			$this,
			'_fromRow'
		);
	}

	/**
	 * Retrieve SubmissionComments by user id
	 * @param $userId int User ID.
	 * @return DAOResultFactory
	 */
	function getByUserId($userId) {
		return new DAOResultFactory(
			$this->retrieve(
				'SELECT a.* FROM submission_comments a WHERE author_id = ? ORDER BY date_posted',
				[(int) $userId]
			),
			$this,
			'_fromRow'
		);
	}

	/**
	 * Retrieve SubmissionComments made my reviewers on a submission
	 * @param $submissionId int The submission Id that was reviewered/commented on.
	 * @param $reviewerId int The user id of the reviewer.
	 * @param $reviewId int (optional) The review assignment ID the comment pertains to.
	 * @param $viewable boolean True for only viewable comments; false for non-viewable; null for both
	 * @return DAOResultFactory
	 */
	function getReviewerCommentsByReviewerId($submissionId, $reviewerId = null, $reviewId = null, $viewable = null) {
		$params = array((int) $submissionId);
		if ($reviewerId) $params[] = (int) $reviewerId;
		if ($reviewId) $params[] = (int) $reviewId;
		return new DAOResultFactory(
			$this->retrieve(
				$sql = 'SELECT	a.*
				FROM	submission_comments a
				WHERE	submission_id = ?
					' . ($reviewerId?' AND author_id = ?':'') . '
					' . ($reviewId?' AND assoc_id = ?':'') . '
					' . ($viewable === true?' AND viewable = 1':'') . '
					' . ($viewable === false?' AND viewable = 0':'') . '
				ORDER BY date_posted DESC',
				$params
			),
			$this, '_fromRow', [], $sql, $params // Counted in readReview.tpl and authorReadReview.tpl
		);
	}

	/**
	 * Retrieve submission comment by id
	 * @param $commentId int Comment ID.
	 * @return SubmissionComment object
	 */
	function getById($commentId) {
		$result = $this->retrieve(
			'SELECT * FROM submission_comments WHERE comment_id = ?', [(int) $commentId]
		);
		$row = $result->current();
		return $row ? $this->_fromRow((array) $row) : null;
	}

	/**
	 * Construct a new DataObject.
	 * @return DataObject
	 */
	function newDataObject() {
		return new SubmissionComment();
	}

	/**
	 * Creates and returns a submission comment object from a row
	 * @param $row array
	 * @return SubmissionComment object
	 */
	function _fromRow($row) {
		$submissionComment = $this->newDataObject();
		$submissionComment->setId($row['comment_id']);
		$submissionComment->setCommentType($row['comment_type']);
		$submissionComment->setRoleId($row['role_id']);
		$submissionComment->setSubmissionId($row['submission_id']);
		$submissionComment->setAssocId($row['assoc_id']);
		$submissionComment->setAuthorId($row['author_id']);
		$submissionComment->setCommentTitle($row['comment_title']);
		$submissionComment->setComments($row['comments']);
		$submissionComment->setDatePosted($this->datetimeFromDB($row['date_posted']));
		$submissionComment->setDateModified($this->datetimeFromDB($row['date_modified']));
		$submissionComment->setViewable($row['viewable']);

		HookRegistry::call('SubmissionCommentDAO::_fromRow', array(&$submissionComment, &$row));

		return $submissionComment;
	}

	/**
	 * inserts a new submission comment into the submission_comments table
	 * @param SubmissionNote object
	 * @return Submission note ID int
	 */
	function insertObject($submissionComment) {
		$this->update(
			sprintf('INSERT INTO submission_comments
				(comment_type, role_id, submission_id, assoc_id, author_id, date_posted, date_modified, comment_title, comments, viewable)
				VALUES
				(?, ?, ?, ?, ?, %s, %s, ?, ?, ?)',
				$this->datetimeToDB($submissionComment->getDatePosted()), $this->datetimeToDB($submissionComment->getDateModified())),
			[
				(int) $submissionComment->getCommentType(),
				(int) $submissionComment->getRoleId(),
				(int) $submissionComment->getSubmissionId(),
				(int) $submissionComment->getAssocId(),
				(int) $submissionComment->getAuthorId(),
				$submissionComment->getCommentTitle(),
				$submissionComment->getComments(),
				(int) $submissionComment->getViewable()
			]
		);

		$submissionComment->setId($this->getInsertId());
		return $submissionComment->getId();
	}

	/**
	 * Get the ID of the last inserted submission comment.
	 * @return int
	 */
	function getInsertId() {
		return $this->_getInsertId('submission_comments', 'comment_id');
	}

	/**
	 * Removes a submission comment from the submission_comments table
	 * @param SubmissionComment object
	 */
	function deleteObject($submissionComment) {
		$this->deleteById($submissionComment->getId());
	}

	/**
	 * Removes a submission note by id
	 * @param noteId int
	 */
	function deleteById($commentId) {
		$this->update(
			'DELETE FROM submission_comments WHERE comment_id = ?',
			[(int) $commentId]
		);
	}

	/**
	 * Delete all comments for a submission.
	 * @param $submissionId int
	 */
	function deleteBySubmissionId($submissionId) {
		$this->update(
			'DELETE FROM submission_comments WHERE submission_id = ?',
			[(int) $submissionId]
		);
	}

	/**
	 * Updates a submission comment
	 * @param SubmissionComment object
	 */
	function updateObject($submissionComment) {
		$this->update(
			sprintf('UPDATE submission_comments
				SET
					comment_type = ?,
					role_id = ?,
					submission_id = ?,
					assoc_id = ?,
					author_id = ?,
					date_posted = %s,
					date_modified = %s,
					comment_title = ?,
					comments = ?,
					viewable = ?
				WHERE comment_id = ?',
				$this->datetimeToDB($submissionComment->getDatePosted()), $this->datetimeToDB($submissionComment->getDateModified())),
			[
				(int) $submissionComment->getCommentType(),
				(int) $submissionComment->getRoleId(),
				(int) $submissionComment->getSubmissionId(),
				(int) $submissionComment->getAssocId(),
				(int) $submissionComment->getAuthorId(),
				$submissionComment->getCommentTitle(),
				$submissionComment->getComments(),
				$submissionComment->getViewable() === null ? 1 : (int) $submissionComment->getViewable(),
				(int) $submissionComment->getId()
			]
		);
	}
}


