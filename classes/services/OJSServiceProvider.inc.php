<?php

/**
 * @file classes/services/OJSServiceProvider.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class OJSServiceProvider
 * @ingroup services
 *
 * @brief Utility class to package all OJS services
 */

namespace APP\Services;

use \Pimple\Container;
use \APP\Services\PublicationService;
use \APP\Services\StatsEditorialService;
use \APP\Services\StatsService;
use \APP\Services\SubmissionFileService;
use \PKP\Services\PKPAnnouncementService;
use \PKP\Services\PKPAuthorService;
use \PKP\Services\PKPEmailTemplateService;
use \PKP\Services\PKPFileService;
use \PKP\Services\PKPSchemaService;
use \PKP\Services\PKPSiteService;
use \PKP\Services\PKPUserService;

class OJSServiceProvider implements \Pimple\ServiceProviderInterface {

	/**
	 * Registers services
	 * @param \Pimple\Container $pimple
	 */
	public function register(Container $pimple) {

		// Announcement service
		$pimple['announcement'] = function() {
			return new PKPAnnouncementService();
		};

		// Author service
		$pimple['author'] = function() {
			return new PKPAuthorService();
		};

		// File service
		$pimple['file'] = function() {
			return new PKPFileService();
		};

		// Submission service
		$pimple['submission'] = function() {
			return new SubmissionService();
		};

		// Publication service
		$pimple['publication'] = function() {
			return new PublicationService();
		};

		// Issue service
		$pimple['issue'] = function() {
			return new IssueService();
		};

		// Section service
		$pimple['section'] = function() {
			return new SectionService();
		};

		// NavigationMenus service
		$pimple['navigationMenu'] = function() {
			return new NavigationMenuService();
		};

		// Galley service
		$pimple['galley'] = function() {
			return new GalleyService();
		};

		// User service
		$pimple['user'] = function() {
			return new PKPUserService();
		};

		// Context service
		$pimple['context'] = function() {
			return new ContextService();
		};

		// Site service
		$pimple['site'] = function() {
			return new PKPSiteService();
		};

		// Submission file service
		$pimple['submissionFile'] = function() {
			return new SubmissionFileService();
		};

		// Email Templates service
		$pimple['emailTemplate'] = function() {
			return new PKPEmailTemplateService();
		};

		// Schema service
		$pimple['schema'] = function() {
			return new PKPSchemaService();
		};

		// Publication statistics service
		$pimple['stats'] = function() {
			return new StatsService();
		};

		// Editorial statistics service
		$pimple['editorialStats'] = function() {
			return new StatsEditorialService();
		};
	}
}
