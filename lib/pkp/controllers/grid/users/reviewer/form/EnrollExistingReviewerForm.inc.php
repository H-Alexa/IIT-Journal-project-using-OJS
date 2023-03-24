<?php

/**
 * @file controllers/grid/users/reviewer/form/EnrollExistingReviewerForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class EnrollExistingReviewerForm
 * @ingroup controllers_grid_users_reviewer_form
 *
 * @brief Form for enrolling an existing reviewer and adding them to a submission.
 */

import('lib.pkp.controllers.grid.users.reviewer.form.ReviewerForm');

class EnrollExistingReviewerForm extends ReviewerForm {
	/**
	 * Constructor.
	 */
	function __construct($submission, $reviewRound) {
		parent::__construct($submission, $reviewRound);
		$this->setTemplate('controllers/grid/users/reviewer/form/enrollExistingReviewerForm.tpl');

		$this->addCheck(new FormValidator($this, 'userGroupId', 'required', 'user.profile.form.usergroupRequired'));
		$this->addCheck(new FormValidator($this, 'userId', 'required', 'manager.people.existingUserRequired'));
	}

	/**
	 * @copydoc Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$advancedSearchAction = $this->getAdvancedSearchAction($request);

		$this->setReviewerFormAction($advancedSearchAction);
		return parent::fetch($request, $template, $display);
	}

	/**
	 * Assign form data to user-submitted data.
	 * @see Form::readInputData()
	 */
	function readInputData() {
		parent::readInputData();

		$this->readUserVars(array('userId', 'userGroupId'));
	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute(...$functionArgs) {
		// Assign a reviewer user group to an existing non-reviewer
		$userId = (int) $this->getData('userId');

		$userGroupId = (int) $this->getData('userGroupId');
		$userGroupDao = DAORegistry::getDAO('UserGroupDAO'); /* @var $userGroupDao UserGroupDAO */
		$userGroupDao->assignUserToGroup($userId, $userGroupId);

		// Set the reviewerId in the Form for the parent class to use
		$this->setData('reviewerId', $userId);

		return parent::execute(...$functionArgs);
	}
}


