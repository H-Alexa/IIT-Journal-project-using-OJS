<?php

/**
 * @file classes/form/validation/FormValidatorLocaleUrl.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class FormValidatorLocaleUrl
 * @ingroup form_validation
 * @see FormValidatorLocale
 *
 * @brief Form validation check for URL addresses.
 */

import('lib.pkp.classes.form.validation.FormValidatorLocale');
import('lib.pkp.classes.validation.ValidatorUrl');

class FormValidatorLocaleUrl extends FormValidatorLocale {
	/**
	 * Constructor.
	 * @param $form Form the associated form
	 * @param $field string the name of the associated field
	 * @param $type string the type of check, either "required" or "optional"
	 * @param $message string the error message for validation failures (i18n key)
	 * @param $requiredLocale string The symbolic name of the required locale
	 */
	function __construct(&$form, $field, $type, $message, $requiredLocale = null) {
		$validator = new ValidatorUrl();
		parent::__construct($form, $field, $type, $message, $requiredLocale, $validator);
	}
}


