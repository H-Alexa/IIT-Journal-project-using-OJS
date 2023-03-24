<?php
/**
 * @file classes/security/authorization/internal/RepresentationRequiredPolicy.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class RepresentationRequiredPolicy
 * @ingroup security_authorization_internal
 *
 * @brief Policy that ensures that the request contains a valid representation.
 */

import('lib.pkp.classes.security.authorization.DataObjectRequiredPolicy');

class RepresentationRequiredPolicy extends DataObjectRequiredPolicy {
	/**
	 * Constructor
	 * @param $request PKPRequest
	 * @param $args array request parameters
	 * @param $submissionParameterName string the request parameter we expect
	 *  the submission id in.
	 */
	function __construct($request, &$args, $parameterName = 'representationId', $operations = null) {
		parent::__construct($request, $args, $parameterName, 'user.authorization.invalidRepresentation', $operations);
	}

	//
	// Implement template methods from AuthorizationPolicy
	//
	/**
	 * @see DataObjectRequiredPolicy::dataObjectEffect()
	 */
	function dataObjectEffect() {
		$representationId = (int)$this->getDataObjectId();
		if (!$representationId) return AUTHORIZATION_DENY;

		// Need a valid submission in request.
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		if (!is_a($submission, 'Submission')) return AUTHORIZATION_DENY;

		// Need a valid publication in request
		$publication = $this->getAuthorizedContextObject(ASSOC_TYPE_PUBLICATION);
		if (!is_a($publication, 'Publication')) return AUTHORIZATION_DENY;

		// Make sure the representation belongs to the submission.
		$representationDao = Application::getRepresentationDAO();
		$representation = $representationDao->getById($representationId, $publication->getId(), null);
		if (!is_a($representation, 'Representation')) return AUTHORIZATION_DENY;

		// Save the representation to the authorization context.
		$this->addAuthorizedContextObject(ASSOC_TYPE_REPRESENTATION, $representation);
		return AUTHORIZATION_PERMIT;
	}
}


