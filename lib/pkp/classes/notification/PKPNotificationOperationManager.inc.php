<?php

/**
 * @file classes/notification/PKPNotificationOperationManager.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPNotificationOperationManager
 * @ingroup notification
 * @see NotificationDAO
 * @see Notification
 * @brief Base class for notification manager that implements
 * basic notification operations and default notifications info.
 * Subclasses can implement specific information.
 */


import('classes.notification.Notification');
import('lib.pkp.classes.notification.INotificationInfoProvider');

abstract class PKPNotificationOperationManager implements INotificationInfoProvider {

	//
	// Implement INotificationInfoProvider with default values.
	//
	/**
	 * @copydoc INotificationInfoProvider::getNotificationUrl()
	 */
	function getNotificationUrl($request, $notification) {
		return null;
	}

	/**
	 * @copydoc INotificationInfoProvider::getNotificationMessage()
	 */
	function getNotificationMessage($request, $notification) {
		return null;
	}

	/**
	 * Provide the notification message as default content.
	 * @copydoc INotificationInfoProvider::getNotificationContents()
	 */
	function getNotificationContents($request, $notification) {
		return $this->getNotificationMessage($request, $notification);
	}

	/**
	 * @copydoc INotificationInfoProvider::getNotificationTitle()
	 */
	function getNotificationTitle($notification) {
		return __('notification.notification');
	}

	/**
	 * @copydoc INotificationInfoProvider::getStyleClass()
	 */
	function getStyleClass($notification) {
		return '';
	}

	/**
	 * @copydoc INotificationInfoProvider::getIconClass()
	 */
	function getIconClass($notification) {
		return '';
	}

	/**
	 * @copydoc INotificationInfoProvider::isVisibleToAllUsers()
	 */
	function isVisibleToAllUsers($notificationType, $assocType, $assocId) {
		return false;
	}


	//
	// Notification manager operations.
	//
	/**
	 * Iterate through the localized params for a notification's locale key.
	 *  For each parameter, return (in preferred order) a value for the user's current locale,
	 *  a param for the journal's default locale, or the first value (in case the value
	 *  is not localized)
	 * @param $params array
	 * @return array
	 */
	public function getParamsForCurrentLocale($params) {
		$locale = AppLocale::getLocale();
		$primaryLocale = AppLocale::getPrimaryLocale();

		$localizedParams = array();
		foreach ($params as $name => $value) {
			if (!is_array($value)) {
				// Non-localized text
				$localizedParams[$name] = $value;
			} elseif (isset($value[$locale])) {
				// Check if the parameter is in the user's current locale
				$localizedParams[$name] = $value[$locale];
			} elseif (isset($value[$primaryLocale])) {
				// Check if the parameter is in the default site locale
				$localizedParams[$name] = $value[$primaryLocale];
			} else {
				// Otherwise, iterate over all supported locales and return the first match
				$locales = AppLocale::getSupportedLocales();
				foreach ($locales as $localeKey) {
					if (isset($value[$localeKey])) {
						$localizedParams[$name] = $value[$localeKey];
					}
				}
			}
		}

		return $localizedParams;
	}

	/**
	 * Create a new notification with the specified arguments and insert into DB
	 * @param $request PKPRequest
	 * @param $userId int (optional)
	 * @param $notificationType int
	 * @param $contextId int
	 * @param $assocType int
	 * @param $assocId int
	 * @param $level int
	 * @param $params array
	 * @param $suppressEmail boolean Whether or not to suppress the notification email.
	 * @param $mailConfigurator callable Enables the customization of the Notification email
	 * @return Notification object|null
	 */
	public function createNotification($request, $userId = null, $notificationType = null, $contextId = null, $assocType = null, $assocId = null, $level = NOTIFICATION_LEVEL_NORMAL, $params = null, $suppressEmail = false, callable $mailConfigurator = null) {
		$blockedNotifications = $this->getUserBlockedNotifications($userId, $contextId);

		if (!in_array($notificationType, $blockedNotifications)) {
			$notificationDao = DAORegistry::getDAO('NotificationDAO'); /** @var $notificationDao NotificationDAO */
			$notification = $notificationDao->newDataObject(); /** @var $notification Notification */
			$notification->setUserId((int) $userId);
			$notification->setType((int) $notificationType);
			$notification->setContextId((int) $contextId);
			$notification->setAssocType((int) $assocType);
			$notification->setAssocId((int) $assocId);
			$notification->setLevel((int) $level);

			$notificationId = $notificationDao->insertObject($notification);

			// Send notification emails
			if ($notification->getLevel() != NOTIFICATION_LEVEL_TRIVIAL && !$suppressEmail) {
				$notificationEmailSettings = $this->getUserBlockedEmailedNotifications($userId, $contextId);

				if (!in_array($notificationType, $notificationEmailSettings)) {
					$this->sendNotificationEmail($request, $notification, $contextId, $mailConfigurator);
				}
			}

			if ($params) {
				$notificationSettingsDao = DAORegistry::getDAO('NotificationSettingsDAO'); /* @var $notificationSettingsDao NotificationSettingsDAO */
				foreach ($params as $name => $value) {
					$notificationSettingsDao->updateNotificationSetting($notificationId, $name, $value);
				}
			}

			return $notification;
		}
	}

	/**
	 * Create a new notification with the specified arguments and insert into DB
	 * This is a static method
	 * @param $userId int
	 * @param $notificationType int
	 * @param $params array
	 * @return Notification object
	 */
	public function createTrivialNotification($userId, $notificationType = NOTIFICATION_TYPE_SUCCESS, $params = null) {
		$notificationDao = DAORegistry::getDAO('NotificationDAO'); /* @var $notificationDao NotificationDAO */
		$notification = $notificationDao->newDataObject();
		$notification->setUserId($userId);
		$notification->setContextId(CONTEXT_ID_NONE);
		$notification->setType($notificationType);
		$notification->setLevel(NOTIFICATION_LEVEL_TRIVIAL);

		$notificationId = $notificationDao->insertObject($notification);

		if ($params) {
			$notificationSettingsDao = DAORegistry::getDAO('NotificationSettingsDAO'); /* @var $notificationSettingsDao NotificationSettingsDAO */
			foreach ($params as $name => $value) {
				$notificationSettingsDao->updateNotificationSetting($notificationId, $name, $value);
			}
		}

		return $notification;
	}

	/**
	 * Deletes trivial notifications from database.
	 * @param array $notifications
	 */
	public function deleteTrivialNotifications($notifications) {
		$notificationDao = DAORegistry::getDAO('NotificationDAO'); /* @var $notificationDao NotificationDAO */
		foreach($notifications as $notification) {
			// Delete only trivial notifications.
			if($notification->getLevel() == NOTIFICATION_LEVEL_TRIVIAL) {
				$notificationDao->deleteById($notification->getId(), $notification->getUserId());
			}
		}
	}

	/**
	 * General notification data formating.
	 * @param $request PKPRequest
	 * @param array $notifications
	 * @return array
	 */
	public function formatToGeneralNotification($request, $notifications) {
		$formattedNotificationsData = array();
		foreach ($notifications as $notification) { /* @var $notification Notification */
			$formattedNotificationsData[$notification->getLevel()][$notification->getId()] = array(
				'title' => $this->getNotificationTitle($notification),
				'text' => $this->getNotificationContents($request, $notification),
				'addclass' => $this->getStyleClass($notification),
				'notice_icon' => $this->getIconClass($notification),
				'styling' => 'jqueryui',
			);
		}

		return $formattedNotificationsData;
	}

	/**
	 * In place notification data formating.
	 * @param $request PKPRequest
	 * @param $notifications array
	 * @return array
	 */
	public function formatToInPlaceNotification($request, $notifications) {
		$formattedNotificationsData = null;

		if (!empty($notifications)) {
			$templateMgr = TemplateManager::getManager($request);
			foreach ((array)$notifications as $notification) {
				$formattedNotificationsData[$notification->getLevel()][$notification->getId()] = $this->formatNotification($request, $notification, 'controllers/notification/inPlaceNotificationContent.tpl');
			}
		}

		return $formattedNotificationsData;
	}

	/**
	 * Get set of notifications types user does not want to be notified of.
	 * @param $userId int The notification user
	 * @param $contextId int
	 * @return array
	 */
	protected function getUserBlockedNotifications($userId, $contextId) {
		$notificationSubscriptionSettingsDao = DAORegistry::getDAO('NotificationSubscriptionSettingsDAO'); /* @var $notificationSubscriptionSettingsDao NotificationSubscriptionSettingsDAO */
		return $notificationSubscriptionSettingsDao->getNotificationSubscriptionSettings('blocked_notification', $userId, (int) $contextId);
	}

	/**
	 * Get set of notification types user will also be notified by email.
	 * @return array
	 */
	protected function getUserBlockedEmailedNotifications($userId, $contextId) {
		$notificationSubscriptionSettingsDao = DAORegistry::getDAO('NotificationSubscriptionSettingsDAO'); /* @var $notificationSubscriptionSettingsDao NotificationSubscriptionSettingsDAO */
		return $notificationSubscriptionSettingsDao->getNotificationSubscriptionSettings('blocked_emailed_notification', $userId, (int) $contextId);
	}

	/**
	 * Get a template mail instance.
	 * @param $emailKey string
	 * @return MailTemplate
	 * @see MailTemplate
	 */
	protected function getMailTemplate($emailKey = null) {
		import('lib.pkp.classes.mail.MailTemplate');
		return new MailTemplate($emailKey, null, null, false);
	}

	/**
	 * Get a notification content with a link action.
	 * @param $linkAction LinkAction
	 * @param $request Request
	 * @return string
	 */
	protected function fetchLinkActionNotificationContent($linkAction, $request) {
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('linkAction', $linkAction);
		return $templateMgr->fetch('controllers/notification/linkActionNotificationContent.tpl');
	}


	//
	// Private helper methods.
	//
	/*
	 * Return a string of formatted notifications for display
	 * @param $request PKPRequest
	 * @param $notifications object DAOResultFactory
	 * @param $notificationTemplate string optional Template to use for constructing an individual notification for display
	 * @return string
	 */
	private function formatNotifications($request, $notifications, $notificationTemplate = 'notification/notification.tpl') {
		$notificationString = '';

		// Build out the notifications based on their associated objects and format into a string
		while($notification = $notifications->next()) {
			$notificationString .= $this->formatNotification($request, $notification, $notificationTemplate);
		}

		return $notificationString;
	}

	/**
	 * Return a fully formatted notification for display
	 * @param $request PKPRequest
	 * @param $notification object Notification
	 * @return string
	 */
	private function formatNotification($request, $notification, $notificationTemplate = 'notification/notification.tpl') {
		$templateMgr = TemplateManager::getManager($request);

		// Set the date read if it isn't already set
		if (!$notification->getDateRead()) {
			$notificationDao = DAORegistry::getDAO('NotificationDAO'); /* @var $notificationDao NotificationDAO */
			$dateRead = $notificationDao->setDateRead($notification->getId(), Core::getCurrentDate());
			$notification->setDateRead($dateRead);
		}

		$user = $request->getUser();
		$templateMgr->assign(array(
			'isUserLoggedIn' => $user,
			'notificationDateCreated' => $notification->getDateCreated(),
			'notificationId' => $notification->getId(),
			'notificationContents' => $this->getNotificationContents($request, $notification),
			'notificationTitle' => $this->getNotificationTitle($notification),
			'notificationStyleClass' => $this->getStyleClass($notification),
			'notificationIconClass' => $this->getIconClass($notification),
			'notificationDateRead' => $notification->getDateRead(),
		));

		if($notification->getLevel() != NOTIFICATION_LEVEL_TRIVIAL) {
			$templateMgr->assign('notificationUrl', $this->getNotificationUrl($request, $notification));
		}

		return $templateMgr->fetch($notificationTemplate);
	}

	/**
	 * Send an email to a user regarding the notification
	 * @param $request PKPRequest
	 * @param $notification object Notification
	 * @param $contextId ?int Context ID
	 * @param $mailConfigurator callable If specified, must return a MailTemplate instance. A ready MailTemplate object will be provided as argument
	 */
	protected function sendNotificationEmail($request, $notification, ?int $contextId, callable $mailConfigurator = null) {
		$userId = $notification->getUserId();
		$userDao = DAORegistry::getDAO('UserDAO'); /* @var $userDao UserDAO */
		$user = $userDao->getById($userId);
		if ($user && !$user->getDisabled()) {
			AppLocale::requireComponents(LOCALE_COMPONENT_APP_COMMON);

			$context = $request->getContext();
			if ($contextId && (!$context || $context->getId() != $contextId)) {
				$contextDao = Application::getContextDAO();
				$context = $contextDao->getById($contextId);
			}

			$site = $request->getSite();
			$mail = $this->getMailTemplate('NOTIFICATION');

			if ($context) {
				$mail->setReplyTo($context->getContactEmail(), $context->getContactName());
			} else {
				$mail->setReplyTo($site->getLocalizedContactEmail(), $site->getLocalizedContactName());
			}

			$mail->assignParams(array(
				'notificationContents' => $this->getNotificationContents($request, $notification),
				'url' => $this->getNotificationUrl($request, $notification),
				'siteTitle' => $context?$context->getLocalizedName():$site->getLocalizedTitle()
			));
			$mail->addRecipient($user->getEmail(), $user->getFullName());
			if (is_callable($mailConfigurator)) {
				$mail = $mailConfigurator($mail);
			}
			if (!$mail->send() && $request->getUser()) {
				import('classes.notification.NotificationManager');
				$notificationMgr = new NotificationManager();
				$notificationMgr->createTrivialNotification($request->getUser()->getId(), NOTIFICATION_TYPE_ERROR, array('contents' => __('email.compose.error')));
			}
		}
	}
}


