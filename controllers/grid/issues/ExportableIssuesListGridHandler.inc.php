<?php

/**
 * @file controllers/grid/issues/IssueGridHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ExportableIssuesListGridHandler
 * @ingroup controllers_grid_issues
 *
 * @brief Handle exportable issues grid requests.
 */

import('classes.controllers.grid.issues.IssueGridHandler');

class ExportableIssuesListGridHandler extends IssueGridHandler {

	//
	// Implemented methods from GridHandler.
	//
	/**
	 * @copydoc GridHandler::isDataElementSelected()
	 */
	function isDataElementSelected($gridDataElement) {
		return false; // Nothing is selected by default
	}

	/**
	 * @copydoc GridHandler::getSelectName()
	 */
	function getSelectName() {
		return 'selectedIssues';
	}

	/**
	 * @copydoc GridHandler::loadData()
	 */
	protected function loadData($request, $filter) {
		$journal = $request->getJournal();
		$issueDao = DAORegistry::getDAO('IssueDAO'); /* @var $issueDao IssueDAO */
		return $issueDao->getIssues($journal->getId(), $this->getGridRangeInfo($request, $this->getId()));
	}

	/**
	 * @copydoc GridHandler::initFeatures()
	 */
	function initFeatures($request, $args) {
		import('lib.pkp.classes.controllers.grid.feature.selectableItems.SelectableItemsFeature');
		import('lib.pkp.classes.controllers.grid.feature.PagingFeature');
		return array(new SelectableItemsFeature(), new PagingFeature());
	}

	/**
	 * Get the row handler - override the parent row handler. We do not need grid row actions.
	 * @return GridRow
	 */
	protected function getRowInstance() {
		return new GridRow();
	}
}


