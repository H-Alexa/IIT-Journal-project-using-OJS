<?php

/**
 * @file controllers/grid/eventLog/EventLogGridRow.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class EventLogGridRow
 * @ingroup controllers_grid_eventLog
 *
 * @brief EventLog grid row definition
 */

// Parent class
import('lib.pkp.classes.controllers.grid.GridRow');

// Other classes used
import('lib.pkp.classes.log.SubmissionFileEventLogEntry');
import('lib.pkp.controllers.api.file.linkAction.DownloadFileLinkAction');
import('lib.pkp.controllers.grid.eventLog.linkAction.EmailLinkAction');

class EventLogGridRow extends GridRow {
	/** @var Submission **/
	var $_submission;

	/** @var boolean Is the current user assigned as an author to this submission */
	var $_isCurrentUserAssignedAuthor;

	/**
	 * Constructor
	 * @param $submission Submission
	 * @param $isCurrentUserAssignedAuthor boolean Is the current user assigned
	 *  as an author to this submission?
	 */
	function __construct($submission, $isCurrentUserAssignedAuthor) {
		$this->_submission = $submission;
		$this->_isCurrentUserAssignedAuthor = $isCurrentUserAssignedAuthor;
		parent::__construct();
	}

	//
	// Overridden methods from GridRow
	//
	/**
	 * @copydoc GridRow::initialize()
	 */
	function initialize($request, $template = null) {
		parent::initialize($request, $template);

		$logEntry = $this->getData(); // a Category object
		assert($logEntry != null && (is_a($logEntry, 'EventLogEntry') || is_a($logEntry, 'EmailLogEntry')));

		if (is_a($logEntry, 'EventLogEntry')) {
			$params = $logEntry->getParams();

			switch ($logEntry->getEventType()) {
				case SUBMISSION_LOG_FILE_REVISION_UPLOAD:
				case SUBMISSION_LOG_FILE_UPLOAD:
					$submissionFileId = $params['submissionFileId'];
					$fileId = $params['fileId'];
					$submissionFile = Services::get('submissionFile')->get($submissionFileId);
					if (!$submissionFile) {
						break;
					}
					$filename = $params['originalFileName'] ?? $submissionFile->getLocalizedData('name');
					if ($submissionFile) {
						$anonymousAuthor = false;
						$maybeAnonymousAuthor = $this->_isCurrentUserAssignedAuthor && $submissionFile->getData('fileStage') === SUBMISSION_FILE_REVIEW_ATTACHMENT;
						if ($maybeAnonymousAuthor && $submissionFile->getData('assocType') === ASSOC_TYPE_REVIEW_ASSIGNMENT) {
							$reviewAssignmentDao = DAORegistry::getDAO('ReviewAssignmentDAO'); /* @var $reviewAssignmentDao ReviewAssignmentDAO */
							$reviewAssignment = $reviewAssignmentDao->getById($submissionFile->getData('assocId'));
							if ($reviewAssignment && in_array($reviewAssignment->getReviewMethod(), array(SUBMISSION_REVIEW_METHOD_ANONYMOUS, SUBMISSION_REVIEW_METHOD_DOUBLEANONYMOUS))) {
								$anonymousAuthor = true;
							}
						}
						if (!$anonymousAuthor) {
							$workflowStageId = Services::get('submissionFile')->getWorkflowStageId($submissionFile);
							// If a submission file is attached to a query that has been deleted, we cannot
							// determine its stage. Don't present a download link in this case.
							if ($workflowStageId || $submissionFile->getData('fileStage') != SUBMISSION_FILE_QUERY) {
								$this->addAction(new DownloadFileLinkAction($request, $submissionFile, $workflowStageId, __('common.download'), $fileId, $filename));
							}
						}
					}
					break;
			}

		} elseif (is_a($logEntry, 'EmailLogEntry')) {
			$this->addAction(
				new EmailLinkAction(
					$request,
					__('submission.event.viewEmail'),
					array(
						'submissionId' => $logEntry->getAssocId(),
						'emailLogEntryId' => $logEntry->getId(),
					)
				)
			);
		}
	}
}


