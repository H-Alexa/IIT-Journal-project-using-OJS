<?php
/**
 * @file classes/security/authorization/QueryWorkflowStageAccessPolicy.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class QueryWorkflowStageAccessPolicy
 * @ingroup security_authorization
 *
 * @brief Class to control access to submission workflow stage components related to queries
 */

import('lib.pkp.classes.security.authorization.internal.ContextPolicy');
import('lib.pkp.classes.security.authorization.PolicySet');
import('lib.pkp.classes.security.authorization.RoleBasedHandlerOperationPolicy');

class QueryWorkflowStageAccessPolicy extends ContextPolicy {
	/**
	 * Constructor
	 * @param $request PKPRequest
	 * @param $args array request arguments
	 * @param $roleAssignments array
	 * @param $submissionParameterName string
	 * @param $stageId integer One of the WORKFLOW_STAGE_ID_* constants.
	 */
	function __construct($request, &$args, $roleAssignments, $submissionParameterName, $stageId) {
		parent::__construct($request);

		// A workflow stage component requires a valid workflow stage.
		import('lib.pkp.classes.security.authorization.internal.WorkflowStageRequiredPolicy');
		$this->addPolicy(new WorkflowStageRequiredPolicy($stageId));

		// A workflow stage component can only be called if there's a
		// valid submission in the request.
		import('lib.pkp.classes.security.authorization.internal.SubmissionRequiredPolicy');
		$this->addPolicy(new SubmissionRequiredPolicy($request, $args, $submissionParameterName));

		// Extends UserAccessibleWorkflowStagePolicy in order to permit users with review assignments
		// to access the reviews grid
		import('lib.pkp.classes.security.authorization.internal.QueryUserAccessibleWorkflowStageRequiredPolicy');
		$this->addPolicy(new QueryUserAccessibleWorkflowStageRequiredPolicy($request));

		// Users can access all whitelisted operations for submissions and workflow stages...
		$roleBasedPolicy = new PolicySet(COMBINING_PERMIT_OVERRIDES);
		foreach ($roleAssignments as $roleId => $operations) {
			$roleBasedPolicy->addPolicy(new RoleBasedHandlerOperationPolicy($request, $roleId, $operations));
		}
		$this->addPolicy($roleBasedPolicy);
	}
}


