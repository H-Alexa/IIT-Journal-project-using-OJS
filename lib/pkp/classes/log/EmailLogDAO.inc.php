<?php

/**
 * @file classes/log/EmailLogDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class EmailLogDAO
 * @ingroup log
 * @see EmailLogEntry, Log
 *
 * @brief Class for inserting/accessing email log entries.
 */


import ('lib.pkp.classes.log.EmailLogEntry');

class EmailLogDAO extends DAO {

	/**
	 * Retrieve a log entry by ID.
	 * @param $logId int
	 * @param $assocType int optional
	 * @param $assocId int optional
	 * @return EmailLogEntry
	 */
	function getById($logId, $assocType = null, $assocId = null) {
		$params = [(int) $logId];
		if (isset($assocType)) {
			$params[] = (int) $assocType;
			$params[] = (int) $assocId;
		}

		$result = $this->retrieve(
			'SELECT * FROM email_log WHERE log_id = ?' .
			(isset($assocType)?' AND assoc_type = ? AND assoc_id = ?':''),
			$params
		);
		$row = $result->current();
		return $row ? $this->build((array) $row) : null;
	}

	/**
	 * Retrieve a log entry by event type.
	 * @param $assocType int
	 * @param $assocId int
	 * @param $eventType int
	 * @param $userId int optional
	 * @param $rangeInfo object optional
	 * @return EmailLogEntry
	 */
	function _getByEventType($assocType, $assocId, $eventType, $userId = null, $rangeInfo = null) {
		$params = [
			(int) $assocType,
			(int) $assocId,
			(int) $eventType
		];
		if ($userId) $params[] = $userId;

		$result = $this->retrieveRange(
			$sql = 'SELECT	e.*
			FROM	email_log e' .
			($userId ? ' LEFT JOIN email_log_users u ON e.log_id = u.email_log_id' : '') .
			' WHERE	e.assoc_type = ? AND
				e.assoc_id = ? AND
				e.event_type = ?' .
				($userId ? ' AND u.user_id = ?' : ''),
			$params,
			$rangeInfo
		);

		return new DAOResultFactory($result, $this, 'build', [], $sql, $params, $rangeInfo); // Counted in submissionEmails.tpl
	}

	/**
	 * Retrieve all log entries for an object matching the specified association.
	 * @param $assocType int
	 * @param $assocId int
	 * @param $rangeInfo object optional
	 * @return DAOResultFactory containing matching EventLogEntry ordered by sequence
	 */
	function getByAssoc($assocType = null, $assocId = null, $rangeInfo = null) {
		$result = $this->retrieveRange(
			'SELECT	*
			FROM	email_log
			WHERE	assoc_type = ?
				AND assoc_id = ?
			ORDER BY log_id DESC',
			[(int) $assocType, (int) $assocId],
			$rangeInfo
		);

		return new DAOResultFactory($result, $this, 'build');
	}

	/**
	 * Internal function to return an EmailLogEntry object from a row.
	 * @param $row array
	 * @return EmailLogEntry
	 */
	function build($row) {
		$entry = $this->newDataObject();
		$entry->setId($row['log_id']);
		$entry->setAssocType($row['assoc_type']);
		$entry->setAssocId($row['assoc_id']);
		$entry->setSenderId($row['sender_id']);
		$entry->setDateSent($this->datetimeFromDB($row['date_sent']));
		$entry->setEventType($row['event_type']);
		$entry->setFrom($row['from_address']);
		$entry->setRecipients($row['recipients']);
		$entry->setCcs($row['cc_recipients']);
		$entry->setBccs($row['bcc_recipients']);
		$entry->setSubject($row['subject']);
		$entry->setBody($row['body']);

		HookRegistry::call('EmailLogDAO::build', [&$entry, &$row]);

		return $entry;
	}

	/**
	 * Insert a new log entry.
	 * @param $entry EmailLogEntry
	 */
	function insertObject($entry) {
		$this->update(
			sprintf('INSERT INTO email_log
				(sender_id, date_sent, event_type, assoc_type, assoc_id, from_address, recipients, cc_recipients, bcc_recipients, subject, body)
				VALUES
				(?, %s, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
				$this->datetimeToDB($entry->getDateSent())),
			[
				$entry->getSenderId(),
				$entry->getEventType(),
				$entry->getAssocType(),
				$entry->getAssocId(),
				$entry->getFrom(),
				$entry->getRecipients(),
				$entry->getCcs(),
				$entry->getBccs(),
				$entry->getSubject(),
				$entry->getBody()
			]
		);

		$entry->setId($this->getInsertId());
		$this->_insertLogUserIds($entry);

		return $entry->getId();
	}

	/**
	 * Delete a single log entry for an object.
	 * @param $logId int
	 * @param $assocType int optional
	 * @param $assocId int optional
	 */
	function deleteObject($logId, $assocType = null, $assocId = null) {
		$params = [(int) $logId];
		if (isset($assocType)) {
			$params[] = (int) $assocType;
			$params[] = (int) $assocId;
		}
		return $this->update(
			'DELETE FROM email_log WHERE log_id = ?' .
			(isset($assocType)?' AND assoc_type = ? AND assoc_id = ?':''),
			$params
		);
	}

	/**
	 * Delete all log entries for an object.
	 * @param $assocType int
	 * @praam $assocId int
	 */
	function deleteByAssoc($assocType, $assocId) {
		return $this->update(
			'DELETE FROM email_log WHERE assoc_type = ? AND assoc_id = ?',
			[(int) $assocType, (int) $assocId]
		);
	}

	/**
	 * Transfer all log entries to another user.
	 * @param $oldUserId int
	 * @param $newUserId int
	 */
	function changeUser($oldUserId, $newUserId) {
		return $this->update(
			'UPDATE email_log SET sender_id = ? WHERE sender_id = ?',
			[(int) $newUserId, (int) $oldUserId]
		);
	}

	/**
	 * Get the ID of the last inserted log entry.
	 * @return int
	 */
	function getInsertId() {
		return $this->_getInsertId('email_log', 'log_id');
	}


	//
	// Private helper methods.
	//
	/**
	 * Stores the correspondent user ids of the all recipient emails.
	 * @param $entry EmailLogEntry
	 */
	function _insertLogUserIds($entry) {
		$recipients = $entry->getRecipients();

		// We can use a simple regex to get emails, since we don't want to validate it.
		$pattern = '/(?<=\<)[^\>]*(?=\>)/';
		preg_match_all($pattern, $recipients, $matches);
		if (!isset($matches[0])) return;

		$userDao = DAORegistry::getDAO('UserDAO'); /* @var $userDao UserDAO */
		foreach ($matches[0] as $emailAddress) {
			$user = $userDao->getUserByEmail($emailAddress);
			if (is_a($user, 'User')) {
				// We use replace here to avoid inserting duplicated entries
				// in table (sometimes the recipients can have the same email twice).
				$this->replace('email_log_users',
					['email_log_id' => $entry->getId(), 'user_id' => $user->getId()],
					['email_log_id', 'user_id']);
			}
		}
	}
}


