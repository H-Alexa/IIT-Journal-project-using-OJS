<?php

/**
 * @file classes/core/Application.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Application
 * @ingroup core
 * @see PKPApplication
 *
 * @brief Class describing this application.
 *
 */

import('lib.pkp.classes.core.PKPApplication');

define('REQUIRES_XSL', false);

define('ASSOC_TYPE_ARTICLE',		ASSOC_TYPE_SUBMISSION); // DEPRECATED but needed by filter framework
define('ASSOC_TYPE_GALLEY',		ASSOC_TYPE_REPRESENTATION);

define('ASSOC_TYPE_JOURNAL',		0x0000100);
define('ASSOC_TYPE_ISSUE',		0x0000103);
define('ASSOC_TYPE_ISSUE_GALLEY',	0x0000105);

define('CONTEXT_JOURNAL', 1);

define('LANGUAGE_PACK_DESCRIPTOR_URL', 'http://pkp.sfu.ca/ojs/xml/%s/locales.xml');
define('LANGUAGE_PACK_TAR_URL', 'http://pkp.sfu.ca/ojs/xml/%s/%s.tar.gz');

define('METRIC_TYPE_COUNTER', 'ojs::counter');

class Application extends PKPApplication {
	/**
	 * Get the "context depth" of this application, i.e. the number of
	 * parts of the URL after index.php that represent the context of
	 * the current request (e.g. Journal [1], or Conference and
	 * Scheduled Conference [2]).
	 * @return int
	 */
	public function getContextDepth() {
		return 1;
	}

	/**
	 * Get the list of context elements.
	 * @return array
	 */
	public function getContextList() {
		return array('journal');
	}

	/**
	 * Get the symbolic name of this application
	 * @return string
	 */
	public static function getName() {
		return 'ojs2';
	}

	/**
	 * Get the locale key for the name of this application.
	 * @return string
	 */
	public function getNameKey() {
		return('common.software');
	}

	/**
	 * Get the URL to the XML descriptor for the current version of this
	 * application.
	 * @return string
	 */
	public function getVersionDescriptorUrl() {
		return('http://pkp.sfu.ca/ojs/xml/ojs-version.xml');
	}

	/**
	 * Get the map of DAOName => full.class.Path for this application.
	 * @return array
	 */
	public function getDAOMap() {
		return array_merge(parent::getDAOMap(), array(
			'SubmissionDAO' => 'classes.submission.SubmissionDAO',
			'ArticleGalleyDAO' => 'classes.article.ArticleGalleyDAO',
			'ArticleSearchDAO' => 'classes.search.ArticleSearchDAO',
			'AuthorDAO' => 'classes.article.AuthorDAO',
			'IndividualSubscriptionDAO' => 'classes.subscription.IndividualSubscriptionDAO',
			'InstitutionalSubscriptionDAO' => 'classes.subscription.InstitutionalSubscriptionDAO',
			'IssueDAO' => 'classes.issue.IssueDAO',
			'IssueGalleyDAO' => 'classes.issue.IssueGalleyDAO',
			'IssueFileDAO' => 'classes.issue.IssueFileDAO',
			'JournalDAO' => 'classes.journal.JournalDAO',
			'JournalSettingsDAO' => 'classes.journal.JournalSettingsDAO',
			'MetricsDAO' => 'classes.statistics.MetricsDAO',
			'OAIDAO' => 'classes.oai.ojs.OAIDAO',
			'OJSCompletedPaymentDAO' => 'classes.payment.ojs.OJSCompletedPaymentDAO',
			'ReviewerSubmissionDAO' => 'classes.submission.reviewer.ReviewerSubmissionDAO',
			'SectionDAO' => 'classes.journal.SectionDAO',
			'SubscriptionDAO' => 'classes.subscription.SubscriptionDAO',
			'SubscriptionTypeDAO' => 'classes.subscription.SubscriptionTypeDAO',
		));
	}

	/**
	 * Get the list of plugin categories for this application.
	 * @return array
	 */
	public function getPluginCategories() {
		return array(
			// NB: Meta-data plug-ins are first in the list as this
			// will make them load (and install) first.
			// This is necessary as several other plug-in categories
			// depend on meta-data. This is a very rudimentary type of
			// dependency management for plug-ins.
			'metadata',
			'auth',
			'blocks',
			'gateways',
			'generic',
			'importexport',
			'oaiMetadataFormats',
			'paymethod',
			'pubIds',
			'reports',
			'themes'
		);
	}

	/**
	 * Get the top-level context DAO.
	 * @return ContextDAO
	 */
	public static function getContextDAO() {
		return DAORegistry::getDAO('JournalDAO');
	}

	/**
	 * Get the submission DAO.
	 * @deprecated Just get the DAO directly.
	 * @return SubmissionDAO
	 */
	public static function getSubmissionDAO() {
		return DAORegistry::getDAO('SubmissionDAO');
	}

	/**
	 * Get the section DAO.
	 * @return SectionDAO
	 */
	public static function getSectionDAO() {
		return DAORegistry::getDAO('SectionDAO');
	}

	/**
	 * Get the representation DAO.
	 * @return RepresentationDAO
	 */
	public static function getRepresentationDAO() {
		return DAORegistry::getDAO('ArticleGalleyDAO');
	}

	/**
	 * Get a SubmissionSearchIndex instance.
	 */
	public static function getSubmissionSearchIndex() {
		import('classes.search.ArticleSearchIndex');
		return new ArticleSearchIndex();
	}

	/**
	 * Get a SubmissionSearchDAO instance.
	 */
	public static function getSubmissionSearchDAO() {
		return DAORegistry::getDAO('ArticleSearchDAO');
	}

	/**
	 * Get the stages used by the application.
	 * @return array
	 */
	public static function getApplicationStages() {
		// We leave out WORKFLOW_STAGE_ID_PUBLISHED since it technically is not a 'stage'.
		return array(
				WORKFLOW_STAGE_ID_SUBMISSION,
				WORKFLOW_STAGE_ID_EXTERNAL_REVIEW,
				WORKFLOW_STAGE_ID_EDITING,
				WORKFLOW_STAGE_ID_PRODUCTION
		);
	}

	/**
	 * Returns the context type for this application.
	 * @return int ASSOC_TYPE_...
	 */
	public static function getContextAssocType() {
		return ASSOC_TYPE_JOURNAL;
	}

	/**
	 * Get the file directory array map used by the application.
	 */
	public static function getFileDirectories() {
		return array('context' => '/journals/', 'submission' => '/articles/');
	}

	/**
	 * @copydoc PKPApplication::getRoleNames()
	 */
	public static function getRoleNames($contextOnly = false, $roleIds = null) {
		$roleNames = parent::getRoleNames($contextOnly, $roleIds);
		if (!$roleIds || in_array(ROLE_ID_SUBSCRIPTION_MANAGER, $roleIds)) {
			$roleNames[ROLE_ID_SUBSCRIPTION_MANAGER] = 'user.role.subscriptionManager';
		}
		return $roleNames;
	}

	/**
	 * Get the payment manager.
	 * @param $context Context
	 * @return OJSPaymentManager
	 */
	public static function getPaymentManager($context) {
		import('classes.payment.ojs.OJSPaymentManager');
		return new OJSPaymentManager($context);
	}
}
