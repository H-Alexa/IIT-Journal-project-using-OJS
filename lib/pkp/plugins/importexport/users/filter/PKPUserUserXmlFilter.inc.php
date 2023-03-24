<?php

/**
 * @file plugins/importexport/users/filter/PKPUserUserXmlFilter.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPUserUserXmlFilter
 * @ingroup plugins_importexport_users
 *
 * @brief Base class that converts a set of users to a User XML document
 */

import('lib.pkp.plugins.importexport.native.filter.NativeExportFilter');

class PKPUserUserXmlFilter extends NativeExportFilter {
	/**
	 * Constructor
	 * @param $filterGroup FilterGroup
	 */
	function __construct($filterGroup) {
		$this->setDisplayName('User XML user export');
		parent::__construct($filterGroup);
	}


	//
	// Implement template methods from PersistableFilter
	//
	/**
	 * @copydoc PersistableFilter::getClassName()
	 */
	function getClassName() {
		return 'lib.pkp.plugins.importexport.users.filter.PKPUserUserXmlFilter';
	}


	//
	// Implement template methods from Filter
	//
	/**
	 * @see Filter::process()
	 * @param $users array Array of users
	 * @return DOMDocument
	 */
	function &process(&$users) {
		// Create the XML document
		$doc = new DOMDocument('1.0');
		$deployment = $this->getDeployment();

		$rootNode = $doc->createElementNS($deployment->getNamespace(), 'PKPUsers');
		$this->addUserGroups($doc, $rootNode);

		// Multiple users; wrap in a <users> element
		$usersNode = $doc->createElementNS($deployment->getNamespace(), 'users');
		foreach ($users as $user) {
			$usersNode->appendChild($this->createPKPUserNode($doc, $user));
		}
		$rootNode->appendChild($usersNode);
		$doc->appendChild($rootNode);
		$rootNode->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
		$rootNode->setAttribute('xsi:schemaLocation', $deployment->getNamespace() . ' ' . $deployment->getSchemaFilename());

		return $doc;
	}

	//
	// PKPAuthor conversion functions
	//
	/**
	 * Create and return a user node.
	 * @param $doc DOMDocument
	 * @param $user User
	 * @return DOMElement
	 */
	function createPKPUserNode($doc, $user) {
		$deployment = $this->getDeployment();
		$context = $deployment->getContext();

		// Create the user node
		$userNode = $doc->createElementNS($deployment->getNamespace(), 'user');

		// Add metadata
		$this->createLocalizedNodes($doc, $userNode, 'givenname', $user->getGivenName(null));
		$this->createLocalizedNodes($doc, $userNode, 'familyname', $user->getFamilyName(null));
		$this->createLocalizedNodes($doc, $userNode, 'affiliation', $user->getAffiliation(null));

		$this->createOptionalNode($doc, $userNode, 'country', $user->getCountry());
		$userNode->appendChild($doc->createElementNS($deployment->getNamespace(), 'email', htmlspecialchars($user->getEmail(), ENT_COMPAT, 'UTF-8')));
		$this->createOptionalNode($doc, $userNode, 'url', $user->getUrl());
		$this->createOptionalNode($doc, $userNode, 'orcid', $user->getOrcid());
		if (is_array($user->getBiography(null))) {
			$this->createLocalizedNodes($doc, $userNode, 'biography', $user->getBiography(null));
		}

		$userNode->appendChild($doc->createElementNS($deployment->getNamespace(), 'username', htmlspecialchars($user->getUsername(), ENT_COMPAT, 'UTF-8')));

		$this->createOptionalNode($doc, $userNode, 'gossip', $user->getGossip());

		if (is_array($user->getSignature(null))) {
			$this->createLocalizedNodes($doc, $userNode, 'signature', $user->getSignature(null));
		}

		$passwordNode = $doc->createElementNS($deployment->getNamespace(), 'password');
		$passwordNode->setAttribute('is_disabled', $user->getDisabled() ? 'true' : 'false');
		$passwordNode->setAttribute('must_change', $user->getMustChangePassword() ? 'true' : 'false');
		$passwordNode->setAttribute('encryption', Config::getVar('security', 'encryption'));
		$passwordNode->appendChild($doc->createElementNS($deployment->getNamespace(), 'value', htmlspecialchars($user->getPassword(), ENT_COMPAT, 'UTF-8')));

		$userNode->appendChild($passwordNode);

		$this->createOptionalNode($doc, $userNode, 'date_registered', $user->getDateRegistered());
		$this->createOptionalNode($doc, $userNode, 'date_last_login', $user->getDateLastLogin());
		$this->createOptionalNode($doc, $userNode, 'date_last_email', $user->getDateLastEmail());
		$this->createOptionalNode($doc, $userNode, 'date_validated', $user->getDateValidated());
		$this->createOptionalNode($doc, $userNode, 'inline_help', $user->getInlineHelp() ? 'true' : 'false');
		$this->createOptionalNode($doc, $userNode, 'auth_id', $user->getAuthId());
		$this->createOptionalNode($doc, $userNode, 'auth_string', $user->getAuthStr());
		$this->createOptionalNode($doc, $userNode, 'phone', $user->getPhone());
		$this->createOptionalNode($doc, $userNode, 'mailing_address', $user->getMailingAddress());
		$this->createOptionalNode($doc, $userNode, 'billing_address', $user->getBillingAddress());
		$this->createOptionalNode($doc, $userNode, 'locales', join(':',$user->getLocales()));
		if ($user->getDisabled()) {
			$this->createOptionalNode($doc, $userNode, 'disabled_reason', $user->getDisabledReason());
		}

		$userGroupAssignmentDao = DAORegistry::getDAO('UserGroupAssignmentDAO'); /* @var $userGroupAssignmentDao UserGroupAssignmentDAO */
		$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /* @var $userGroupDao UserGroupDAO */
		$assignedGroups = $userGroupAssignmentDao->getByUserId($user->getId(), $context->getId());
		while ($assignedGroup = $assignedGroups->next()) {
			$userGroup = $userGroupDao->getById($assignedGroup->getUserGroupId());
			if ($userGroup) {
				$userNode->appendChild($doc->createElementNS($deployment->getNamespace(), 'user_group_ref', htmlspecialchars($userGroup->getName($context->getPrimaryLocale()), ENT_COMPAT, 'UTF-8')));
			}
		}

		// Add Reviewing Interests, if any.
		import('lib.pkp.classes.user.InterestManager');
		$interestManager = new InterestManager();
		$interests = $interestManager->getInterestsString($user);
		$this->createOptionalNode($doc, $userNode, 'review_interests', $interests);

		return $userNode;
	}

	function addUserGroups($doc, $rootNode) {
		$deployment = $this->getDeployment();
		$context = $deployment->getContext();
		$userGroupsNode = $doc->createElementNS($deployment->getNamespace(), 'user_groups');

		$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /* @var $userGroupDao UserGroupDAO */
		$userGroups = $userGroupDao->getByContextId($context->getId());
		$filterDao = DAORegistry::getDAO('FilterDAO'); /* @var $filterDao FilterDAO */
		$userGroupExportFilters = $filterDao->getObjectsByGroup('usergroup=>user-xml');
		assert(count($userGroupExportFilters)==1); // Assert only a single serialization filter
		$exportFilter = array_shift($userGroupExportFilters);
		$exportFilter->setDeployment($this->getDeployment());

		$userGroupsArray = $userGroups->toArray();
		$userGroupsDoc = $exportFilter->execute($userGroupsArray);
		if ($userGroupsDoc->documentElement instanceof DOMElement) {
			$clone = $doc->importNode($userGroupsDoc->documentElement, true);
			$rootNode->appendChild($clone);
		}
	}
}


