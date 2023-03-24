<?php

/**
 * @file StaticPagesHandler.inc.php
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @package plugins.generic.staticPages
 * @class StaticPagesHandler
 * Find static page content and display it when requested.
 */

import('classes.handler.Handler');

class StaticPagesHandler extends Handler {
	/** @var StaticPagesPlugin The static pages plugin */
	static $plugin;

	/** @var StaticPage The static page to view */
	static $staticPage;


	/**
	 * Provide the static pages plugin to the handler.
	 * @param $plugin StaticPagesPlugin
	 */
	static function setPlugin($plugin) {
		self::$plugin = $plugin;
	}

	/**
	 * Set a static page to view.
	 * @param $staticPage StaticPage
	 */
	static function setPage($staticPage) {
		self::$staticPage = $staticPage;
	}

	/**
	 * Handle index request (redirect to "view")
	 * @param $args array Arguments array.
	 * @param $request PKPRequest Request object.
	 */
	function index($args, $request) {
		$request->redirect(null, null, 'view', $request->getRequestedOp());
	}

	/**
	 * Handle view page request (redirect to "view")
	 * @param $args array Arguments array.
	 * @param $request PKPRequest Request object.
	 */
	function view($args, $request) {
		$path = array_shift($args);

		AppLocale::requireComponents(LOCALE_COMPONENT_PKP_COMMON, LOCALE_COMPONENT_APP_COMMON, LOCALE_COMPONENT_PKP_USER);
		$context = $request->getContext();
		$contextId = $context?$context->getId():CONTEXT_ID_NONE;

		// Ensure that if we're previewing, the current user is a manager or admin.
		$roles = $this->getAuthorizedContextObject(ASSOC_TYPE_USER_ROLES);
		if (!self::$staticPage->getId() && count(array_intersect(array(ROLE_ID_MANAGER, ROLE_ID_SITE_ADMIN), $roles))==0) {
			fatalError('The current user is not permitted to preview.');
		}

		// Assign the template vars needed and display
		$templateMgr = TemplateManager::getManager($request);
		$this->setupTemplate($request);
		$templateMgr->assign('title', self::$staticPage->getLocalizedTitle());

		$vars = array();
		if ($context) $vars = array(
			'{$contactName}' => $context->getData('contactName'),
			'{$contactEmail}' => $context->getData('contactEmail'),
			'{$supportName}' => $context->getData('supportName'),
			'{$supportPhone}' => $context->getData('supportPhone'),
			'{$supportEmail}' => $context->getData('supportEmail'),
		);
		$templateMgr->assign('content', strtr(self::$staticPage->getLocalizedContent(), $vars));

		$templateMgr->display(self::$plugin->getTemplateResource('content.tpl'));
	}
}

