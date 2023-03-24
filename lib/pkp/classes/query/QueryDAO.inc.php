<?php

/**
 * @file classes/query/QueryDAO.inc.php
 *
 * Copyright (c) 2016-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class QueryDAO
 * @ingroup query
 * @see Query
 *
 * @brief Operations for retrieving and modifying Query objects.
 */


import('lib.pkp.classes.query.Query');

class QueryDAO extends DAO {

	/**
	 * Retrieve a submission query by ID.
	 * @param $queryId int Query ID
	 * @param $assocType int Optional ASSOC_TYPE_...
	 * @param $assocId int Optional assoc ID per assocType
	 * @return Query
	 */
	function getById($queryId, $assocType = null, $assocId = null) {
		$params = [(int) $queryId];
		if ($assocType) {
			$params[] = (int) $assocType;
			$params[] = (int) $assocId;
		}
		$result = $this->retrieve(
			'SELECT *
			FROM	queries
			WHERE	query_id = ?'
				. ($assocType?' AND assoc_type = ? AND assoc_id = ?':''),
			$params
		);
		$row = $result->current();
		return $row ? $this->_fromRow((array) $row) : null;
	}

	/**
	 * Retrieve all queries by association
	 * @param $assocType int ASSOC_TYPE_...
	 * @param $assocId int Assoc ID
	 * @param $stageId int Optional stage ID
	 * @param $userId int Optional user ID; when set, show only assigned queries
	 * @return array Query
	 */
	function getByAssoc($assocType, $assocId, $stageId = null, $userId = null) {
		$params = [];
		$params[] = (int) ASSOC_TYPE_QUERY;
		if ($userId) $params[] = (int) $userId;
		$params[] = (int) $assocType;
		$params[] = (int) $assocId;
		if ($stageId) $params[] = (int) $stageId;
		if ($userId) $params[] = (int) $userId;

		return new DAOResultFactory(
			$this->retrieve(
				'SELECT	DISTINCT q.*
				FROM	queries q
				LEFT JOIN notes n ON n.assoc_type = ? AND n.assoc_id = q.query_id
				' . ($userId?'INNER JOIN query_participants qp ON (q.query_id = qp.query_id AND qp.user_id = ?)':'') . '
				WHERE	q.assoc_type = ? AND q.assoc_id = ?
				' . ($stageId?' AND q.stage_id = ?':'') .
				($userId?'
				AND (n.user_id = ? OR n.title IS NOT NULL
				OR n.contents IS NOT NULL)':'') . '
				ORDER BY q.seq',
				$params
			),
			$this, '_fromRow'
		);
	}

	/**
	 * Internal function to return a submission query object from a row.
	 * @param $row array
	 * @return Query
	 */
	function _fromRow($row) {
		$query = $this->newDataObject();
		$query->setId($row['query_id']);
		$query->setAssocType($row['assoc_type']);
		$query->setAssocId($row['assoc_id']);
		$query->setStageId($row['stage_id']);
		$query->setIsClosed($row['closed']);
		$query->setSequence($row['seq']);

		HookRegistry::call('QueryDAO::_fromRow', array(&$query, &$row));
		return $query;
	}

	/**
	 * Get a new data object
	 * @return DataObject
	 */
	function newDataObject() {
		return new Query();
	}

	/**
	 * Insert a new Query.
	 * @param $query Query
	 * @return int New query ID
	 */
	function insertObject($query) {
		$this->update(
			'INSERT INTO queries (assoc_type, assoc_id, stage_id, closed, seq)
			VALUES (?, ?, ?, ?, ?)',
			[
				(int) $query->getAssocType(),
				(int) $query->getAssocId(),
				(int) $query->getStageId(),
				(int) $query->getIsClosed(),
				(float) $query->getSequence(),
			]
		);
		$query->setId($this->getInsertId());
		return $query->getId();
	}

	/**
	 * Adds a participant to a query.
	 * @param $queryId int Query ID
	 * @param $userId int User ID
	 */
	function insertParticipant($queryId, $userId) {
		$this->update(
			'INSERT INTO query_participants
			(query_id, user_id)
			VALUES
			(?, ?)',
			[(int) $queryId, (int) $userId]
		);
	}

	/**
	 * Removes a participant from a query.
	 * @param $queryId int Query ID
	 * @param $userId int User ID
	 */
	function removeParticipant($queryId, $userId) {
		$this->update(
			'DELETE FROM query_participants WHERE query_id = ? AND user_id = ?',
			[(int) $queryId, (int) $userId]
		);
	}

	/**
	 * Removes all participants from a query.
	 * @param $queryId int Query ID
	 */
	function removeAllParticipants($queryId) {
		$this->update(
			'DELETE FROM query_participants WHERE query_id = ?',
			[(int) $queryId]
		);
	}

	/**
	 * Retrieve all participant user IDs for a query.
	 * @param $queryId int Query ID
	 * @param $userId int User ID to restrict results to
	 * @return array
	 */
	function getParticipantIds($queryId, $userId = null) {
		$params = [(int) $queryId];
		if ($userId) $params[] = (int) $userId;
		$result = $this->retrieve(
			'SELECT	user_id
			FROM	query_participants
			WHERE	query_id = ?' .
			($userId?' AND user_id = ?':''),
			$params
		);
		$userIds = [];
		foreach ($result as $row) {
			$userIds[] = (int) $row->user_id;
		}
		return $userIds;
	}

	/**
	 * Update an existing Query.
	 * @param $query Query
	 */
	function updateObject($query) {
		$this->update(
			'UPDATE	queries
			SET	assoc_type = ?,
				assoc_id = ?,
				stage_id = ?,
				closed = ?,
				seq = ?
			WHERE	query_id = ?',
			[
				(int) $query->getAssocType(),
				(int) $query->getAssocId(),
				(int) $query->getStageId(),
				(int) $query->getIsClosed(),
				(float) $query->getSequence(),
				(int) $query->getId()
			]
		);
	}

	/**
	 * Delete a submission query.
	 * @param $query Query
	 */
	function deleteObject($query) {
		$this->deleteById($query->getId());
	}

	/**
	 * Delete a submission query by ID.
	 * @param $queryId int Query ID
	 * @param $assocType int Optional ASSOC_TYPE_...
	 * @param $assocId int Optional assoc ID per assocType
	 */
	function deleteById($queryId, $assocType = null, $assocId = null) {
		$params = [(int) $queryId];
		if ($assocType) {
			$params[] = (int) $assocType;
			$params[] = (int) $assocId;
		}
		if ($this->update(
			'DELETE FROM queries WHERE query_id = ?' .
			($assocType?' AND assoc_type = ? AND assoc_id = ?':''),
			$params
		)) {
			$this->update('DELETE FROM query_participants WHERE query_id = ?', [(int) $queryId]);

			// Remove associated notes
			$noteDao = DAORegistry::getDAO('NoteDAO'); /* @var $noteDao NoteDAO */
			$noteDao->deleteByAssoc(ASSOC_TYPE_QUERY, $queryId);

			// Remove associated notifications
			$notificationDao = DAORegistry::getDAO('NotificationDAO'); /* @var $notificationDao NotificationDAO */
			$notifications = $notificationDao->getByAssoc(ASSOC_TYPE_QUERY, $queryId);
			while ($notification = $notifications->next()) {
				$notificationDao->deleteObject($notification);
			}

		}
	}

	/**
	 * Sequentially renumber queries in their sequence order.
	 * @param $assocType int ASSOC_TYPE_...
	 * @param $assocId int Assoc ID per assocType
	 */
	function resequence($assocType, $assocId) {
		$result = $this->retrieve(
			'SELECT query_id FROM queries WHERE assoc_type = ? AND assoc_id = ? ORDER BY seq',
			[(int) $assocType, (int) $assocId]
		);

		for ($i=1; $row = $result->current(); $i++) {
			$this->update('UPDATE queries SET seq = ? WHERE query_id = ?', [$i, $row->query_id]);
			$result->next();
		}
	}

	/**
	 * Get the ID of the last inserted submission query.
	 * @return int
	 */
	function getInsertId() {
		return $this->_getInsertId('queries', 'query_id');
	}

	/**
	 * Delete queries by assoc info.
	 * @param $assocType int ASSOC_TYPE_...
	 * @param $assocId int Assoc ID per assocType
	 */
	function deleteByAssoc($assocType, $assocId) {
		$queries = $this->getByAssoc($assocType, $assocId);
		while ($query = $queries->next()) {
			$this->deleteObject($query);
		}
	}
}


