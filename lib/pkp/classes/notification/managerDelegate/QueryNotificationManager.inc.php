<?php

/**
 * @file classes/notification/managerDelegate/QueryNotificationManager.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class QueryNotificationManager
 * @ingroup managerDelegate
 *
 * @brief Query notification types manager delegate.
 */

import('lib.pkp.classes.notification.NotificationManagerDelegate');

class QueryNotificationManager extends NotificationManagerDelegate {

	/**
	 * Constructor.
	 * @param $notificationType int NOTIFICATION_TYPE_...
	 */
	function __construct($notificationType) {
		parent::__construct($notificationType);
	}

	/**
	 * @copydoc NotificationManagerDelegate::getNotifictionTitle()
	 */
	public function getNotificationTitle($notification) {
		switch ($notification->getType()) {
			case NOTIFICATION_TYPE_NEW_QUERY:
				assert(false);
				break;
			case NOTIFICATION_TYPE_QUERY_ACTIVITY:
				assert(false);
				break;
			default: assert(false);
		}
	}

	/**
	 * @copydoc NotificationManagerDelegate::getNotificationMessage()
	 */
	public function getNotificationMessage($request, $notification) {
		assert($notification->getAssocType() == ASSOC_TYPE_QUERY);
		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$query = $queryDao->getById($notification->getAssocId());

		$headNote = $query->getHeadNote();
		assert(isset($headNote));

		switch($notification->getType()) {
			case NOTIFICATION_TYPE_NEW_QUERY:
				$user = $headNote->getUser();
				return __('submission.query.new', array(
					'creatorName' => $user->getFullName(),
					'noteContents' => substr(PKPString::html2text($headNote->getContents()), 0, 200),
					'noteTitle' => substr($headNote->getTitle(), 0, 200),
				));
			case NOTIFICATION_TYPE_QUERY_ACTIVITY:
				$notes = $query->getReplies(null, NOTE_ORDER_ID, SORT_DIRECTION_DESC);
				$latestNote = $notes->next();
				$user = $latestNote->getUser();
				return __('submission.query.activity', array(
					'responderName' => $user->getFullName(),
					'noteContents' => substr(PKPString::html2text($latestNote->getContents()), 0, 200),
					'noteTitle' => substr($headNote->getTitle(), 0, 200),
				));
			default: assert(false);
		}
	}

	/**
	 * Get the submission for a query.
	 * @param $query Query
	 * @return Submission
	 */
	protected function getQuerySubmission($query) {
		$submissionDao = DAORegistry::getDAO('SubmissionDAO'); /* @var $submissionDao SubmissionDAO */
		switch ($query->getAssocType()) {
			case ASSOC_TYPE_SUBMISSION:
				return $submissionDao->getById($query->getAssocId());
			case ASSOC_TYPE_REPRESENTATION:
				$representationDao = Application::getRepresentationDAO();
				$representation = $representationDao->getById($query->getAssocId());
				$publication = Services::get('publication')->get($representation->getData('publicationId'));
				return Services::get('submission')->get($publication->getData('submissionId'));
		}
		assert(false);
	}

	/**
	 * @copydoc NotificationManagerDelegate::getNotificationUrl()
	 */
	public function getNotificationUrl($request, $notification) {
		assert($notification->getAssocType() == ASSOC_TYPE_QUERY);
		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$query = $queryDao->getById($notification->getAssocId());
		assert(is_a($query, 'Query'));
		$submission = $this->getQuerySubmission($query);

		import('classes.core.Services');
		return Services::get('submission')->getWorkflowUrlByUserRoles($submission, $notification->getUserId());
	}

	/**
	 * @copydoc NotificationManagerDelegate::getNotificationContents()
	 */
	public function getNotificationContents($request, $notification) {
		assert($notification->getAssocType() == ASSOC_TYPE_QUERY);
		$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
		$query = $queryDao->getById($notification->getAssocId());
		assert(is_a($query, 'Query'));

		$submission = $this->getQuerySubmission($query);
		assert(is_a($submission, 'Submission'));

		switch($notification->getType()) {
			case NOTIFICATION_TYPE_NEW_QUERY:
				return __(
					'submission.query.new.contents',
					array(
						'queryTitle' => $query->getHeadNote()->getTitle(),
						'submissionTitle' => $submission->getLocalizedTitle(),
					)
				);
			case NOTIFICATION_TYPE_QUERY_ACTIVITY:
				return __(
					'submission.query.activity.contents',
					array(
						'queryTitle' => $query->getHeadNote()->getTitle(),
						'submissionTitle' => $submission->getLocalizedTitle(),
					)
				);
			default: assert(false);
		}
	}

	/**
	 * @copydoc NotificationManagerDelegate::getStyleClass()
	 */
	public function getStyleClass($notification) {
		return NOTIFICATION_STYLE_CLASS_WARNING;
	}
}


