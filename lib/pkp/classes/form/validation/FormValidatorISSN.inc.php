<?php

/**
 * @file classes/form/validation/FormValidatorISSN.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class FormValidatorISSN
 * @ingroup form_validation
 *
 * @brief Form validation check for ISSNs.
 */

import('lib.pkp.classes.form.validation.FormValidator');

class FormValidatorISSN extends FormValidator {
	/**
	 * Constructor.
	 * @param $form Form the associated form
	 * @param $field string the name of the associated field
	 * @param $type string the type of check, either "required" or "optional"
	 * @param $message string the error message for validation failures (i18n key)
	 */
	function __construct($form, $field, $type, $message) {
		import('lib.pkp.classes.validation.ValidatorISSN');
		$validator = new ValidatorISSN();
		parent::__construct($form, $field, $type, $message, $validator);
	}
}


