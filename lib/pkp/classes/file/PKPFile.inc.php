<?php

/**
 * @file classes/file/PKPFile.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPFile
 * @ingroup file
 *
 * @brief Base PKP file class.
 */

class PKPFile extends DataObject {

	//
	// Get/set methods
	//
	/**
	 * Get server-side file name of the file.
	 * @param return string
	 */
	function getServerFileName() {
		return $this->getData('fileName');
	}

	/**
	 * Set server-side file name of the file.
	 * @param $fileName string
	 */
	function setServerFileName($fileName) {
		$this->setData('fileName', $fileName);
	}

	/**
	 * Get original uploaded file name of the file.
	 * @param return string
	 */
	function getOriginalFileName() {
		return $this->getData('originalFileName');
	}

	/**
	 * Set original uploaded file name of the file.
	 * @param $originalFileName string
	 */
	function setOriginalFileName($originalFileName) {
		$this->setData('originalFileName', $originalFileName);
	}

	/**
	 * Get type of the file.
	 * @return string
	 */
	function getFileType() {
		return $this->getData('filetype');
	}

	/**
	 * Set type of the file.
	 * @param $type string
	 */
	function setFileType($fileType) {
		$this->setData('filetype', $fileType);
	}

	/**
	 * Get uploaded date of file.
	 * @return date
	 */
	function getDateUploaded() {
		return $this->getData('dateUploaded');
	}

	/**
	 * Set uploaded date of file.
	 * @param $dateUploaded date
	 */
	function setDateUploaded($dateUploaded) {
		return $this->SetData('dateUploaded', $dateUploaded);
	}

	/**
	 * Get file size of file.
	 * @return int
	 */
	function getFileSize() {
		return $this->getData('fileSize');
	}

	/**
	 * Set file size of file.
	 * @param $fileSize int
	 */
	function setFileSize($fileSize) {
		return $this->SetData('fileSize', $fileSize);
	}

	/**
	 * Return pretty file size string (in B, KB, MB, or GB units).
	 * @return string
	 */
	function getNiceFileSize() {
		return Services::get('file')->getNiceFileSize($this->getFileSize());
	}


	//
	// Abstract template methods to be implemented by subclasses.
	//
	/**
	 * Return absolute path to the file on the host filesystem.
	 * @return string
	 */
	function getFilePath() {
		assert(false);
	}
}


