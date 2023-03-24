<?php

/**
 * @file classes/notification/managerDelegate/PKPApproveSubmissionNotificationManager.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPApproveSubmissionNotificationManager
 * @ingroup managerDelegate
 *
 * @brief Approve submission notification type manager delegate.
 */

import('lib.pkp.classes.notification.NotificationManagerDelegate');

class PKPApproveSubmissionNotificationManager extends NotificationManagerDelegate {

	/**
	 * Constructor.
	 * @param $notificationType int NOTIFICATION_TYPE_...
	 */
	function __construct($notificationType) {
		parent::__construct($notificationType);
	}

	/**
	 * @copydoc PKPNotificationOperationManager::getNotificationUrl()
	 */
	function getNotificationUrl($request, $notification) {
		$dispatcher = Application::get()->getDispatcher();
		$context = $request->getContext();
		return $dispatcher->url($request, ROUTE_PAGE, $context->getPath(), 'workflow', 'access', $notification->getAssocId());
	}

	/**
	 * @copydoc PKPNotificationOperationManager::getStyleClass()
	 */
	function getStyleClass($notification) {
		return NOTIFICATION_STYLE_CLASS_INFORMATION;
	}

	/**
	 * @copydoc PKPNotificationOperationManager::isVisibleToAllUsers()
	 */
	function isVisibleToAllUsers($notificationType, $assocType, $assocId) {
		return true;
	}

	/**
	 * @copydoc NotificationManagerDelegate::updateNotification()
	 */
	function updateNotification($request, $userIds, $assocType, $assocId) {
		$submissionId = $assocId;
		$submissionDao = DAORegistry::getDAO('SubmissionDAO'); /* @var $submissionDao SubmissionDAO */
		$submission = $submissionDao->getById($submissionId);

		$notificationDao = DAORegistry::getDAO('NotificationDAO'); /* @var $notificationDao NotificationDAO */

		$notificationTypes = array(
			NOTIFICATION_TYPE_APPROVE_SUBMISSION => false,
			NOTIFICATION_TYPE_FORMAT_NEEDS_APPROVED_SUBMISSION => false,
			NOTIFICATION_TYPE_VISIT_CATALOG => true,
		);

		$isPublished = (boolean) $submission->getDatePublished();

		foreach ($notificationTypes as $type => $forPublicationState) {
			$notificationFactory = $notificationDao->getByAssoc(
				ASSOC_TYPE_SUBMISSION,
				$submissionId,
				null,
				$type,
				$submission->getData('contextId')
			);
			$notification = $notificationFactory->next();

			if (!$notification && $isPublished == $forPublicationState) {
				// Create notification.
				$this->createNotification(
					$request,
					null,
					$type,
					$submission->getData('contextId'),
					ASSOC_TYPE_SUBMISSION,
					$submissionId,
					NOTIFICATION_LEVEL_NORMAL
				);
			} elseif ($notification && $isPublished != $forPublicationState) {
				// Delete existing notification.
				$notificationDao->deleteObject($notification);
			}
		}
	}

	/**
	 * @copydoc NotificationManagerDelegate.inc.php
	 */
	protected function multipleTypesUpdate() {
		return true;
	}
}


