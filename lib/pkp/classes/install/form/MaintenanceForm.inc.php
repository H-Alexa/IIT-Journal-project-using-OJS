<?php

/**
 * @file classes/install/form/MaintenanceForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class MaintenanceForm
 * @ingroup install_form
 *
 * @brief Base form for system maintenance (install/upgrade).
 */

import('lib.pkp.classes.form.Form');
import('lib.pkp.classes.site.VersionCheck');

class MaintenanceForm extends Form {
	/** @var PKPRequest */
	var $_request;

	/**
	 * Constructor.
	 */
	function __construct($request, $template) {
		parent::__construct($template);
		$this->_request = $request;
		$this->addCheck(new FormValidatorPost($this));
	}

	/**
	 * @copydoc Form::display
	 */
	function display($request = null, $template = null) {
		$templateMgr = TemplateManager::getManager($this->_request);
		$templateMgr->assign('version', VersionCheck::getCurrentCodeVersion());
		parent::display($request, $template);
	}

	/**
	 * Fail with a generic installation error.
	 * @param $errorMsg string
	 * @param $translate boolean
	 */
	function installError($errorMsg, $translate = true) {
		$templateMgr = TemplateManager::getManager($this->_request);
		$templateMgr->assign(array('isInstallError' => true, 'errorMsg' => $errorMsg, 'translateErrorMsg' => $translate));
		$this->display($this->_request);
	}

	/**
	 * Fail with a database installation error.
	 * @param $errorMsg string
	 */
	function dbInstallError($errorMsg) {
		$templateMgr = TemplateManager::getManager($this->_request);
		$templateMgr->assign(array('isInstallError' => true, 'dbErrorMsg' => empty($errorMsg) ? __('common.error.databaseErrorUnknown') : $errorMsg));
		error_log($errorMsg);
		$this->display($this->_request);
	}
}


