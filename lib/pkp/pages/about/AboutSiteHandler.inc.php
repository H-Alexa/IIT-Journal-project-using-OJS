<?php

/**
 * @file pages/about/AboutSiteHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class AboutSiteHandler
 * @ingroup pages_about
 *
 * @brief Handle requests for site-wide about functions.
 */

import('classes.handler.Handler');

class AboutSiteHandler extends Handler {
	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
		AppLocale::requireComponents(LOCALE_COMPONENT_APP_COMMON, LOCALE_COMPONENT_PKP_USER, LOCALE_COMPONENT_PKP_MANAGER);
	}

	/**
	 * Display aboutThisPublishingSystem page.
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function aboutThisPublishingSystem($args, $request) {
		$versionDao = DAORegistry::getDAO('VersionDAO'); /* @var $versionDao VersionDAO */
		$version = $versionDao->getCurrentVersion();

		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign([
			'appVersion' => $version->getVersionString(false),
			'contactUrl' => $request->getDispatcher()->url(
				Application::get()->getRequest(),
				ROUTE_PAGE,
				null,
				'about',
				'contact'
			),
		]);

		$templateMgr->display('frontend/pages/aboutThisPublishingSystem.tpl');
	}

	/**
	 * Display privacy policy page.
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function privacy($args, $request) {
		$templateMgr = TemplateManager::getManager($request);
		$this->setupTemplate($request);
		$context = $request->getContext();
		$enableSiteWidePrivacyStatement = Config::getVar('general', 'sitewide_privacy_statement');
		if (!$enableSiteWidePrivacyStatement && $context) {
			$privacyStatement = $context->getLocalizedData('privacyStatement');
		} else {
			$privacyStatement = $request->getSite()->getLocalizedData('privacyStatement');
		}
		if (!$privacyStatement) {
			$dispatcher = $this->getDispatcher();
			$dispatcher->handle404();
		}
		$templateMgr->assign('privacyStatement', $privacyStatement);

		$templateMgr->display('frontend/pages/privacy.tpl');
	}
}
