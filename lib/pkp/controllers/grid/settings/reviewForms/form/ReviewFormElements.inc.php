<?php
/**
 * @file controllers/grid/settings/reviewForms/form/ReviewFormElements.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ReviewFormElements
 * @ingroup controllers_grid_settings_reviewForms_form
 *
 * @brief Form for manager to edit review form elements.
 */

import('lib.pkp.classes.db.DBDataXMLParser');
import('lib.pkp.classes.form.Form');

class ReviewFormElements extends Form {

	/** The ID of the review form being edited */
	var $reviewFormId;

	/**
	 * Constructor.
	 * @param $template string
	 * @param $reviewFormId
	 */
	function __construct($reviewFormId) {
		parent::__construct('manager/reviewForms/reviewFormElements.tpl');

		$this->reviewFormId = (int) $reviewFormId;

		// Validation checks for this form
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}

	/**
	 * @copydoc Form::fetch
	 */
	function fetch($request, $template = null, $display = false) {
		$json = new JSONMessage();

		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('reviewFormId', $this->reviewFormId);

		return parent::fetch($request, $template, $display);
	}

	/**
	 * Initialize form data from current settings.
	 */
	function initData() {
		if (isset($this->reviewFormId)) {
			// Get review form
			$reviewFormDao = DAORegistry::getDAO('ReviewFormDAO'); /* @var $reviewFormDao ReviewFormDAO */
			$reviewForm = $reviewFormDao->getById($this->reviewFormId, Application::getContextAssocType(), $this->contextId);

			// Get review form elements
			$reviewFormElementDao = DAORegistry::getDAO('ReviewFormElementDAO'); /* @var $reviewFormElementDao ReviewFormElementDAO */
			$reviewFormElements = $reviewFormElementDao->getByReviewFormId($reviewFormId, null);

			// Set data
			$this->setData('reviewFormId', $reviewFormId);
			$this->setData('reviewFormElements', $reviewFormElements);
		}
	}
}
