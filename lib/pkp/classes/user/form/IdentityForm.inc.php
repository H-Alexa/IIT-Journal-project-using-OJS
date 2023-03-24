<?php

/**
 * @file classes/user/form/IdentityForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPProfileForm
 * @ingroup user_form
 *
 * @brief Form to edit user's identity information.
 */

import('lib.pkp.classes.user.form.BaseProfileForm');

class IdentityForm extends BaseProfileForm {

	/**
	 * Constructor.
	 * @param $template string
	 * @param $user User
	 */
	function __construct($user) {
		parent::__construct('user/identityForm.tpl', $user);

		// the users register for the site, thus
		// the site primary locale is the required default locale
		$site = Application::get()->getRequest()->getSite();
		$this->addSupportedFormLocale($site->getPrimaryLocale());

		// Validation checks for this form
		$form = $this;
		$this->addCheck(new FormValidatorLocale($this, 'givenName', 'required', 'user.profile.form.givenNameRequired', $site->getPrimaryLocale()));
		$this->addCheck(new FormValidatorCustom($this, 'familyName', 'optional', 'user.profile.form.givenNameRequired.locale', function($familyName) use ($form) {
			$givenNames = $form->getData('givenName');
			foreach ($familyName as $locale => $value) {
				if (!empty($value) && empty($givenNames[$locale])) {
					return false;
				}
			}
			return true;
		}));
	}

	/**
	 * @copydoc BaseProfileForm::fetch
	 */
	function fetch($request, $template = null, $display = false) {
		$templateMgr = TemplateManager::getManager($request);

		$user = $this->getUser();
		$userDao = DAORegistry::getDAO('UserDAO'); /* @var $userDao UserDAO */
		$templateMgr->assign(array(
			'username' => $user->getUsername(),
		));

		return parent::fetch($request, $template, $display);
	}

	/**
	 * @copydoc BaseProfileForm::initData()
	 */
	function initData() {
		$user = $this->getUser();

		$this->_data = array(
			'givenName' => $user->getGivenName(null),
			'familyName' => $user->getFamilyName(null),
			'preferredPublicName' => $user->getPreferredPublicName(null),
		);
	}

	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
		parent::readInputData();

		$this->readUserVars(array(
			'givenName', 'familyName', 'preferredPublicName',
		));
	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute(...$functionArgs) {
		$request = Application::get()->getRequest();
		$user = $request->getUser();

		$user->setGivenName($this->getData('givenName'), null);
		$user->setFamilyName($this->getData('familyName'), null);
		$user->setPreferredPublicName($this->getData('preferredPublicName'), null);

		parent::execute(...$functionArgs);
	}
}


