<?php

/**
 * @defgroup log Log
 * Implements submission event logs.
 */

/**
 * @file classes/log/SubmissionLog.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionLog
 * @ingroup log
 *
 * @brief Static class for adding / accessing PKP log entries.
 */

import('lib.pkp.classes.log.PKPSubmissionEventLogEntry');

class SubmissionLog {

	/**
	 * Add a new event log entry with the specified parameters
	 * @param $request object
	 * @param $submission object
	 * @param $eventType int
	 * @param $messageKey string
	 * @param $params array optional
	 * @return object SubmissionLogEntry iff the event was logged
	 */
	static function logEvent($request, $submission, $eventType, $messageKey, $params = array()) {
		// Create a new entry object
		$submissionEventLogDao = DAORegistry::getDAO('SubmissionEventLogDAO'); /* @var $submissionEventLogDao SubmissionEventLogDAO */
		$entry = $submissionEventLogDao->newDataObject();

		// Set implicit parts of the log entry
		$entry->setDateLogged(Core::getCurrentDate());

		if (Validation::isLoggedInAs()) {
			// If user is logged in as another user log with real userid
			$sessionManager = SessionManager::getManager();
			$session = $sessionManager->getUserSession();
			$userId = $session->getSessionVar('signedInAs');
			if ($userId) $entry->setUserId($userId);
		} else {
			$user = $request->getUser();
			if ($user) $entry->setUserId($user->getId());
		}

		$entry->setSubmissionId($submission->getId());

		// Set explicit parts of the log entry
		$entry->setEventType($eventType);
		$entry->setMessage($messageKey);
		$entry->setParams($params);
		$entry->setIsTranslated(0); // Legacy for old entries. All messages now use locale keys.

		// Insert the resulting object
		$submissionEventLogDao->insertObject($entry);

		// Stamp the submission status modification date.
		$submission->stampLastActivity();
		$submissionDao = DAORegistry::getDAO('SubmissionDAO'); /* @var $submissionDao SubmissionDAO */
		$submissionDao->updateObject($submission);

		return $entry;
	}
}


