<?php

/**
 * @file controllers/informationCenter/form/NewNoteForm.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class NewNoteForm
 * @ingroup informationCenter_form
 *
 * @brief Form to display and post notes on a file
 */


import('lib.pkp.classes.form.Form');

class NewNoteForm extends Form {
	/**
	 * Constructor.
	 */
	function __construct() {
		parent::__construct('controllers/informationCenter/notes.tpl');

		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}

	/**
	 * Return the assoc type for this note.
	 * @return int
	 */
	function getAssocType() {
		assert(false);
	}

	/**
	 * Return the assoc ID for this note.
	 * @return int
	 */
	function getAssocId() {
		assert(false);
	}

	/**
	 * Return the submit note button locale key.
	 * Should be overriden by subclasses.
	 * @return string
	 */
	function getSubmitNoteLocaleKey() {
		assert(false);
	}

	/**
	 * Get the new note form template. Subclasses can
	 * override this method to define other template.
	 * @return string
	 */
	function getNewNoteFormTemplate() {
		return 'controllers/informationCenter/newNoteForm.tpl';
	}

	/**
	 * @copydoc Form::fetch()
	 */
	function fetch($request, $template = null, $display = false) {
		$templateMgr = TemplateManager::getManager($request);
		$noteDao = DAORegistry::getDAO('NoteDAO'); /* @var $noteDao NoteDAO */
		$templateMgr->assign(array(
			'notes' => $noteDao->getByAssoc($this->getAssocType(), $this->getAssocId()),
			'submitNoteText' => $this->getSubmitNoteLocaleKey(),
			'newNoteFormTemplate' => $this->getNewNoteFormTemplate(),
		));
		return parent::fetch($request, $template, $display);
	}

	/**
	 * @copydoc Form::readInputData()
	 */
	function readInputData() {
		$this->readUserVars(array(
			'newNote'
		));

	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute(...$functionArgs) {
		$request = Application::get()->getRequest();
		$user = $request->getUser();

		$noteDao = DAORegistry::getDAO('NoteDAO'); /* @var $noteDao NoteDAO */
		$note = $noteDao->newDataObject();

		$note->setUserId($user->getId());
		$note->setContents($this->getData('newNote'));
		$note->setAssocType($this->getAssocType());
		$note->setAssocId($this->getAssocId());

		parent::execute(...$functionArgs);
		return $noteDao->insertObject($note);
	}
}


