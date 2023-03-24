<?php
/**
 * @file classes/security/authorization/AuthorDashboardAccessPolicy.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class AuthorDashboardAccessPolicy
 * @ingroup security_authorization
 *
 * @brief Class to control access to author dashboard.
 */

import('lib.pkp.classes.security.authorization.internal.ContextPolicy');
import('lib.pkp.classes.security.authorization.PolicySet');

class AuthorDashboardAccessPolicy extends ContextPolicy {
	/**
	 * Constructor
	 * @param $request PKPRequest
	 * @param $args array request arguments
	 * @param $roleAssignments array
	 */
	function __construct($request, &$args, $roleAssignments) {
		parent::__construct($request);

		$authorDashboardPolicy = new PolicySet(COMBINING_DENY_OVERRIDES);

		// AuthorDashboard requires a valid submission in request.
		import('lib.pkp.classes.security.authorization.SubmissionAccessPolicy');
		$authorDashboardPolicy->addPolicy(new SubmissionAccessPolicy($request, $args, $roleAssignments), true);

		// Check if the user has an stage assignment with the submission in request.
		// Any workflow stage assignment is sufficient to access the author dashboard.
		import('lib.pkp.classes.security.authorization.internal.UserAccessibleWorkflowStageRequiredPolicy');
		$authorDashboardPolicy->addPolicy(new UserAccessibleWorkflowStageRequiredPolicy($request, WORKFLOW_TYPE_AUTHOR));

		$this->addPolicy($authorDashboardPolicy);
	}
}


