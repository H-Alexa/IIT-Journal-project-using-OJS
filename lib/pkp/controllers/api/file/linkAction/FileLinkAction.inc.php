<?php
/**
 * @file controllers/api/file/linkAction/FileLinkAction.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class FileLinkAction
 * @ingroup controllers_api_file_linkAction
 *
 * @brief An abstract file action.
 */

import('lib.pkp.classes.linkAction.LinkAction');

class FileLinkAction extends LinkAction {

	/**
	 * Constructor
	 * @param $id string Link action ID
	 * @param $actionRequest LinkActionRequest
	 * @param $title string optional
	 * @param $image string optional
	 * @param $tooltip string optional
	 */
	function __construct($id, $actionRequest, $title = null, $image = null, $tooltip = null) {
		parent::__construct($id, $actionRequest, $title, $image, $tooltip);
	}


	//
	// Protected helper function
	//
	/**
	 * Return the action arguments to address a file.
	 * @param $submissionFile SubmissionFile
	 * @param $stageId int (optional)
	 * @return array
	 */
	function getActionArgs($submissionFile, $stageId = null) {
		assert(is_a($submissionFile, 'SubmissionFile'));

		// Create the action arguments array.
		$args =  array(
			'submissionFileId' => $submissionFile->getId(),
			'submissionId' => $submissionFile->getData('submissionId')
		);
		if ($stageId) $args['stageId'] = $stageId;

		return $args;
	}
}


