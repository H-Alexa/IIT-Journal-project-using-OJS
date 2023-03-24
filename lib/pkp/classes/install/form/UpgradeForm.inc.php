<?php

/**
 * @file classes/install/form/UpgradeForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UpgradeForm
 * @ingroup install_form
 *
 * @brief Form for system upgrades.
 */

import('classes.install.Upgrade');
import('lib.pkp.classes.install.form.MaintenanceForm');

class UpgradeForm extends MaintenanceForm {

	/**
	 * Constructor.
	 */
	function __construct($request) {
		parent::__construct($request, 'install/upgrade.tpl');
	}

	/**
	 * Perform installation.
	 */
	function execute(...$functionParams) {
		parent::execute(...$functionParams);

		define('RUNNING_UPGRADE', 1);
		$templateMgr = TemplateManager::getManager($this->_request);
		Application::get()->initializeDatabaseConnection();
		$installer = new Upgrade($this->_data);

		// FIXME Use logger?

		// FIXME Mostly common with InstallForm

		if ($installer->execute()) {
			if (!$installer->wroteConfig()) {
				// Display config file contents for manual replacement
				$templateMgr->assign(array('writeConfigFailed' => true, 'configFileContents' => $installer->getConfigContents()));
			}

			$templateMgr->assign('notes', $installer->getNotes());
			$templateMgr->assign('newVersion', $installer->getNewVersion());
			$templateMgr->display('install/upgradeComplete.tpl');

		} else {
			switch ($installer->getErrorType()) {
				case INSTALLER_ERROR_DB:
					$this->dbInstallError($installer->getErrorMsg());
					break;
				default:
					$this->installError($installer->getErrorMsg());
					break;
			}
		}

		$installer->destroy();
	}
}


