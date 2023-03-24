<?php

/**
 * @file controllers/grid/files/SubmissionFilesCategoryGridDataProvider.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionFilesCategoryDataProvider
 * @ingroup controllers_grid_files_review
 *
 * @brief Provide access to submission files data for category grids.
 */


import('lib.pkp.classes.controllers.grid.CategoryGridDataProvider');

class SubmissionFilesCategoryGridDataProvider extends CategoryGridDataProvider {

	/** @var array */
	var $_submissionFiles;


	/**
	 * Constructor
	 * @param $fileStage int The current file stage that the grid is handling
	 * (others file stages could be shown activating the grid filter, but this
	 * is the file stage that will be used to bring files from other stages, upload
	 * new file, etc).
	 * @param $dataProviderInitParams array Other parameters to initiate the grid
	 * data provider that this category grid data provider will use to implement
	 * common behaviours and data.
	 */
	function __construct($fileStage, $dataProviderInitParams = null) {
		parent::__construct();
		$this->setDataProvider($this->initGridDataProvider($fileStage, $dataProviderInitParams));
	}


	//
	// Extended method from CategoryGridDataProvider.
	//
	/**
	 * @copydoc CategoryGridDataProvider::setDataProvider()
	 */
	function setDataProvider($gridDataProvider) {
		assert(is_a($gridDataProvider, 'SubmissionFilesGridDataProvider'));
		parent::setDataProvider($gridDataProvider);
	}


	//
	// Implement template methods from GridDataProvider
	//
	/**
	 * @copydoc GridDataProvider::getAuthorizationPolicy()
	 */
	function getAuthorizationPolicy($request, $args, $roleAssignments) {
		// Get the submission files grid data provider authorization policy.
		$dataProvider = $this->getDataProvider();
		return $dataProvider->getAuthorizationPolicy($request, $args, $roleAssignments);
	}

	/**
	 * @copydoc GridDataProvider::getRequestArgs()
	 */
	function getRequestArgs() {
		$dataProvider = $this->getDataProvider();
		return $dataProvider->getRequestArgs();
	}

	/**
	 * @copydoc GridDataProvider::loadData()
	 */
	function loadData($filter = array()) {
		// Return only the user accessible workflow stages.
		return array_keys($this->getAuthorizedContextObject(ASSOC_TYPE_ACCESSIBLE_WORKFLOW_STAGES));
	}


	//
	// Implement template methods from CategoryGridDataProvider
	//
	/**
	 * @copydoc CategoryGridDataProvider::loadCategoryData()
	 */
	function loadCategoryData($request, $categoryDataElement, $filter = null, $reviewRound = null) {
		$dataProvider = $this->getDataProvider();
		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		$stageId = $categoryDataElement;
		$fileStage = $this->_getFileStageByStageId($stageId);
		$stageSubmissionFiles = null;

		// For review stages, get the revisions of the review round that user is currently accessing.
		if ($stageId == WORKFLOW_STAGE_ID_INTERNAL_REVIEW || $stageId == WORKFLOW_STAGE_ID_EXTERNAL_REVIEW) {
			if (is_null($reviewRound) || $reviewRound->getStageId() != $stageId) {
				$reviewRoundDao = DAORegistry::getDAO('ReviewRoundDAO'); /* @var $reviewRoundDao ReviewRoundDAO */
				$reviewRound = $reviewRoundDao->getLastReviewRoundBySubmissionId($submission->getId(), $stageId);
			}
			if ($reviewRound) {
				$submissionFilesIterator = Services::get('submissionFile')->getMany([
					'submissionIds' => [$submission->getId()],
					'reviewRoundIds' => [$reviewRound->getId()],
					'fileStages' => [$fileStage],
				]);
				$stageSubmissionFiles = iterator_to_array($submissionFilesIterator);
			} else {
				$stageSubmissionFiles = [];
			}
		} else {
			// Filter the passed workflow stage files.
			if (!$this->_submissionFiles) {
				$submissionFilesIterator = Services::get('submissionFile')->getMany([
					'submissionIds' => [$submission->getId()],
				]);
				$this->_submissionFiles = iterator_to_array($submissionFilesIterator);
			}
			$submissionFiles = $this->_submissionFiles;
			$stageSubmissionFiles = array();
			foreach ($submissionFiles as $key => $submissionFile) {
				if (in_array($submissionFile->getData('fileStage'), (array) $fileStage)) {
					$stageSubmissionFiles[$key] = $submissionFile;
				} elseif ($submissionFile->getData('fileStage') == SUBMISSION_FILE_QUERY) {
					// Determine the stage from the query.
					if ($submissionFile->getData('assocType')!=ASSOC_TYPE_NOTE) break;
					$noteDao = DAORegistry::getDAO('NoteDAO'); /* @var $noteDao NoteDAO */
					$note = $noteDao->getById($submissionFile->getData('assocId'));
					assert($note && $note->getAssocType()==ASSOC_TYPE_QUERY);
					$queryDao = DAORegistry::getDAO('QueryDAO'); /* @var $queryDao QueryDAO */
					$query = $queryDao->getById($note->getAssocId());
					if ($query && $query->getStageId() == $stageId) $stageSubmissionFiles[$key] = $submissionFile;
				}
			}
		}
		return $dataProvider->prepareSubmissionFileData($stageSubmissionFiles, false, $filter);
	}


	//
	// Public methods
	//
	/**
	 * @copydoc SubmissionFilesGridDataProvider::getAddFileAction()
	 */
	function getAddFileAction($request) {
		$dataProvider = $this->getDataProvider();
		return $dataProvider->getAddFileAction($request);
	}

	/**
	 * @copydoc SubmissionFilesGridDataProvider::getFileStage()
	 */
	function setStageId($stageId) {
		$dataProvider = $this->getDataProvider();
		$dataProvider->setStageId($stageId);
	}

	/**
	 * @copydoc SubmissionFilesGridDataProvider::getFileStage()
	 */
	function getFileStage() {
		$dataProvider = $this->getDataProvider();
		return $dataProvider->getFileStage();
	}


	//
	// Protected methods.
	//
	/**
	 * Init the grid data provider that this category grid data provider
	 * will use and return it. Override this to initiate another grid data provider.
	 * @param $fileStage int
	 * @param $initParams array (optional) The parameters to initiate the grid data provider.
	 * @return SubmissionFilesGridDataProvider
	 */
	function initGridDataProvider($fileStage, $initParams = null) {
		// By default, this category grid data provider use the
		// SubmissionFilesGridDataProvider.
		import('lib.pkp.controllers.grid.files.SubmissionFilesGridDataProvider');
		return new SubmissionFilesGridDataProvider($fileStage);
	}


	//
	// Private helper methods.
	//
	/**
	 * Get the file stage using the passed stage id. This will define
	 * which file stage will be present on each workflow stage category
	 * of the grid.
	 * @param $stageId int
	 * @return int|array
	 */
	function _getFileStageByStageId($stageId) {
		switch($stageId) {
			case WORKFLOW_STAGE_ID_SUBMISSION:
				return SUBMISSION_FILE_SUBMISSION;
				break;
			case WORKFLOW_STAGE_ID_INTERNAL_REVIEW:
				return SUBMISSION_FILE_INTERNAL_REVIEW_FILE;
				break;
			case WORKFLOW_STAGE_ID_EXTERNAL_REVIEW:
				return SUBMISSION_FILE_REVIEW_FILE;
				break;
			case WORKFLOW_STAGE_ID_EDITING:
				return array(SUBMISSION_FILE_FINAL, SUBMISSION_FILE_COPYEDIT);
				break;
			case WORKFLOW_STAGE_ID_PRODUCTION:
				return SUBMISSION_FILE_PRODUCTION_READY;
				break;
			default:
				break;
		}
	}
}


