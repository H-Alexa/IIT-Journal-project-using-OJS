<?php

/**
 * @file controllers/grid/settings/library/form/EditLibraryFileForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class EditLibraryFileForm
 * @ingroup controllers_grid_file_form
 *
 * @brief Form for editing a library file
 */

import('lib.pkp.controllers.grid.files.form.LibraryFileForm');

class EditLibraryFileForm extends LibraryFileForm {
	/** the file being edited, or null for new */
	var $libraryFile;

	/** the id of the context this library file is attached to */
	var $contextId;

	/**
	 * Constructor.
	 * @param $contextId int
	 * @param $fileType int LIBRARY_FILE_TYPE_...
	 * @param $fileId int optional
	 */
	function __construct($contextId, $fileId) {
		parent::__construct('controllers/grid/settings/library/form/editFileForm.tpl', $contextId);
		$libraryFileDao = DAORegistry::getDAO('LibraryFileDAO'); /* @var $libraryFileDao LibraryFileDAO */
		$this->libraryFile = $libraryFileDao->getById($fileId);

		if (!$this->libraryFile || $this->libraryFile->getContextId() != $this->contextId) {
			fatalError('Invalid library file!');
		}
	}

	/**
	 * Initialize form data from current settings.
	 */
	function initData() {
		$this->_data = array(
			'libraryFileName' => $this->libraryFile->getName(null), // Localized
			'libraryFile' => $this->libraryFile, // For read-only info
			'publicAccess' => $this->libraryFile->getPublicAccess() ? true : false,
		);
	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute(...$functionArgs) {
		$this->libraryFile->setName($this->getData('libraryFileName'), null); // Localized
		$this->libraryFile->setType($this->getData('fileType'));
		$this->libraryFile->setPublicAccess($this->getData('publicAccess'));

		$libraryFileDao = DAORegistry::getDAO('LibraryFileDAO'); /* @var $libraryFileDao LibraryFileDAO */
		$libraryFileDao->updateObject($this->libraryFile);
		parent::execute(...$functionArgs);
	}
}
