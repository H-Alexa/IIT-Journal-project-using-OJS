<?php

/**
 * @defgroup file File
 * Implements file management tools, including a database-backed list of files
 * associated with submissions.
 */

/**
 * @file classes/file/FileManager.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 * ePUB mime type added  Leah M Root (rootl) SUNY Geneseo
 * @class FileManager
 * @ingroup file
 *
 * @brief Class defining basic operations for file management.
 */


define('FILE_MODE_MASK', 0666);
define('DIRECTORY_MODE_MASK', 0777);

define('DOCUMENT_TYPE_DEFAULT', 'default');
define('DOCUMENT_TYPE_AUDIO', 'audio');
define('DOCUMENT_TYPE_EXCEL', 'excel');
define('DOCUMENT_TYPE_HTML', 'html');
define('DOCUMENT_TYPE_IMAGE', 'image');
define('DOCUMENT_TYPE_PDF', 'pdf');
define('DOCUMENT_TYPE_WORD', 'word');
define('DOCUMENT_TYPE_EPUB', 'epub');
define('DOCUMENT_TYPE_VIDEO', 'video');
define('DOCUMENT_TYPE_ZIP', 'zip');

class FileManager {
	/**
	 * Constructor
	 */
	function __construct() {
	}

	/**
	 * Return true if an uploaded file exists.
	 * @param $fileName string the name of the file used in the POST form
	 * @return boolean
	 */
	function uploadedFileExists($fileName) {
		if (isset($_FILES[$fileName]) && isset($_FILES[$fileName]['tmp_name'])
				&& is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
			return true;
		}
		return false;
	}

	/**
	 * Return true iff an error occurred when trying to upload a file.
	 * @param $fileName string the name of the file used in the POST form
	 * @return boolean
	 */
	function uploadError($fileName) {
		return (isset($_FILES[$fileName]) && $_FILES[$fileName]['error'] != UPLOAD_ERR_OK);
	}

	/**
	 * Get the error code of a file upload
	 * @see http://php.net/manual/en/features.file-upload.errors.php
	 * @param $fileName string the name of the file used in the POST form
	 * @return integer
	 */
	function getUploadErrorCode($fileName) {
		return $_FILES[$fileName]['error'];
	}

	/**
	 * Get the filename of the first uploaded file in the $_FILES array. The
	 * returned filename is the value used in the form that submitted the request.
	 * @return string
	 */
	function getFirstUploadedPostName() {
		return key($_FILES);
	}

	/**
	 * Return the (temporary) path to an uploaded file.
	 * @param $fileName string the name of the file used in the POST form
	 * @return string (boolean false if no such file)
	 */
	function getUploadedFilePath($fileName) {
		if (isset($_FILES[$fileName]['tmp_name']) && is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
			return $_FILES[$fileName]['tmp_name'];
		}
		return false;
	}

	/**
	 * Return the user-specific (not temporary) filename of an uploaded file.
	 * @param $fileName string the name of the file used in the POST form
	 * @return string (boolean false if no such file)
	 */
	function getUploadedFileName($fileName) {
		if (isset($_FILES[$fileName]['name'])) {
			return $_FILES[$fileName]['name'];
		}
		return false;
	}

	/**
	 * Return the type of an uploaded file.
	 * @param $fileName string the name of the file used in the POST form
	 * @return string
	 */
	function getUploadedFileType($fileName) {
		if (isset($_FILES[$fileName])) {
			// The result of "explode" can't be passed directly to "array_pop" in PHP 7.
			$exploded = explode('.',$_FILES[$fileName]['name']);

			$type = PKPString::mime_content_type(
				$_FILES[$fileName]['tmp_name'], // Location on server
				array_pop($exploded) // Extension on client machine
			);

			if (!empty($type)) return $type;
			return $_FILES[$fileName]['type'];
		}
		return false;
	}

	/**
	 * Upload a file.
	 * @param $fileName string the name of the file used in the POST form
	 * @param $dest string the path where the file is to be saved
	 * @return boolean returns true if successful
	 */
	function uploadFile($fileName, $destFileName) {
		$destDir = dirname($destFileName);
		if (!$this->fileExists($destDir, 'dir')) {
			// Try to create the destination directory
			$this->mkdirtree($destDir);
		}
		if (!isset($_FILES[$fileName])) return false;
		if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $destFileName))
			return $this->setMode($destFileName, FILE_MODE_MASK);
		return false;
	}

	/**
	 * Write a file.
	 * @param $dest string the path where the file is to be saved
	 * @param $contents string the contents to write to the file
	 * @return boolean returns true if successful
	 */
	function writeFile($dest, &$contents) {
		$success = true;
		$destDir = dirname($dest);
		if (!$this->fileExists($destDir, 'dir')) {
			// Try to create the destination directory
			$this->mkdirtree($destDir);
		}
		if (($f = fopen($dest, 'wb'))===false) $success = false;
		if ($success && fwrite($f, $contents)===false) $success = false;
		@fclose($f);

		if ($success)
			return $this->setMode($dest, FILE_MODE_MASK);
		return false;
	}

	/**
	 * Copy a file.
	 * @param $source string the source URL for the file
	 * @param $dest string the path where the file is to be saved
	 * @return boolean returns true if successful
	 */
	function copyFile($source, $dest) {
		$destDir = dirname($dest);
		if (!$this->fileExists($destDir, 'dir')) {
			// Try to create the destination directory
			$this->mkdirtree($destDir);
		}
		if (copy($source, $dest))
			return $this->setMode($dest, FILE_MODE_MASK);
		return false;
	}

	/**
	 * Copy a directory.
	 * Adapted from code by gimmicklessgpt at gmail dot com, at http://php.net/manual/en/function.copy.php
	 * @param $source string the path to the source directory
	 * @param $dest string the path where the directory is to be saved
	 * @return boolean returns true if successful
	 */
	function copyDir($source, $dest) {
		if (is_dir($source)) {
			$this->mkdir($dest);
			$destDir = dir($source);

			while (($entry = $destDir->read()) !== false) {
				if ($entry == '.' || $entry == '..') {
					continue;
				}

				$Entry = $source . DIRECTORY_SEPARATOR . $entry;
				if (is_dir($Entry) ) {
					$this->copyDir($Entry, $dest . DIRECTORY_SEPARATOR . $entry );
					continue;
				}
				$this->copyFile($Entry, $dest . DIRECTORY_SEPARATOR . $entry );
			}

			$destDir->close();
		} else {
			$this->copyFile($source, $dest);
		}

		if ($this->fileExists($dest, 'dir')) {
			return true;
		} else return false;
	}


	/**
	 * Read a file's contents.
	 * @param $filePath string the location of the file to be read
	 * @param $output boolean output the file's contents instead of returning a string
	 * @return string|boolean
	 */
	function readFileFromPath($filePath, $output = false) {
		if (is_readable($filePath)) {
			$f = fopen($filePath, 'rb');
			if (!$f) return false;
			$data = '';
			while (!feof($f)) {
				$data .= fread($f, 4096);
				if ($output) {
					echo $data;
					$data = '';
				}
			}
			fclose($f);

			if ($output) return true;
			return $data;
		}
		return false;
	}

	/**
	 * Download a file.
	 * Outputs HTTP headers and file content for download
	 * @param $filePath string the location of the file to be sent
	 * @param $mediaType string the MIME type of the file, optional
	 * @param $inline boolean print file as inline instead of attachment, optional
	 * @param $fileName string Optional filename to use on the client side
	 * @return boolean
	 */
	function downloadByPath($filePath, $mediaType = null, $inline = false, $fileName = null) {
		$result = null;
		if (HookRegistry::call('FileManager::downloadFile', array(&$filePath, &$mediaType, &$inline, &$result, &$fileName))) return $result;
		if (is_readable($filePath)) {
			if ($mediaType === null) {
				// If the media type wasn't specified, try to detect.
				$mediaType = PKPString::mime_content_type($filePath);
				if (empty($mediaType)) $mediaType = 'application/octet-stream';
			}
			if ($fileName === null) {
				// If the filename wasn't specified, use the server-side.
				$fileName = basename($filePath);
			}

			// Stream the file to the end user.
			header("Content-Type: $mediaType");
			header('Content-Length: ' . filesize($filePath));
			header('Accept-Ranges: none');
			header('Content-Disposition: ' . ($inline ? 'inline' : 'attachment') . "; filename=\"$fileName\"");
			header('Cache-Control: private'); // Workarounds for IE weirdness
			header('Pragma: public');
			$this->readFileFromPath($filePath, true);
			$returner = true;
		} else {
			$returner = false;
		}
		HookRegistry::call('FileManager::downloadFileFinished', array(&$returner));
		return $returner;
	}

	/**
	 * Delete a file.
	 * @param $filePath string the location of the file to be deleted
	 * @return boolean returns true if successful
	 */
	function deleteByPath($filePath) {
		if ($this->fileExists($filePath)) {
			$result = null;
			if (HookRegistry::call('FileManager::deleteFile', array($filePath, &$result))) return $result;
			return unlink($filePath);
		}
		return false;
	}

	/**
	 * Create a new directory.
	 * @param $dirPath string the full path of the directory to be created
	 * @param $perms string the permissions level of the directory (optional)
	 * @return boolean returns true if successful
	 */
	function mkdir($dirPath, $perms = null) {
		if ($perms !== null) {
			return mkdir($dirPath, $perms);
		} else {
			if (mkdir($dirPath))
				return $this->setMode($dirPath, DIRECTORY_MODE_MASK);
			return false;
		}
	}

	/**
	 * Remove a directory.
	 * @param $dirPath string the full path of the directory to be delete
	 * @return boolean returns true if successful
	 */
	function rmdir($dirPath) {
		return rmdir($dirPath);
	}

	/**
	 * Delete all contents including directory (equivalent to "rm -r")
	 * @param $file string the full path of the directory to be removed
	 * @return boolean true iff success, otherwise false
	 */
	function rmtree($file) {
		if (file_exists($file)) {
			if (is_dir($file)) {
				$handle = opendir($file);
				while (($filename = readdir($handle)) !== false) {
					if ($filename != '.' && $filename != '..') {
						if (!$this->rmtree($file . '/' . $filename)) return false;
					}
				}
				closedir($handle);
				if (!rmdir($file)) return false;

			} else {
				if (!unlink($file)) return false;
			}
		}
		return true;
	}

	/**
	 * Create a new directory, including all intermediate directories if required (equivalent to "mkdir -p")
	 * @param $dirPath string the full path of the directory to be created
	 * @param $perms string the permissions level of the directory (optional)
	 * @return boolean returns true if successful
	 */
	function mkdirtree($dirPath, $perms = null) {
		if (!file_exists($dirPath)) {
			//Avoid infinite recursion when file_exists reports false for root directory
			if ($dirPath == dirname($dirPath)) {
				fatalError('There are no readable files in this directory tree. Are safe mode or open_basedir active?');
				return false;
			} else if ($this->mkdirtree(dirname($dirPath), $perms)) {
				return $this->mkdir($dirPath, $perms);
			} else {
				return false;
			}
		}
		return true;
	}

	/**
	 * Check if a file path is valid;
	 * @param $filePath string the file/directory to check
	 * @param $type string (file|dir) the type of path
	 */
	function fileExists($filePath, $type = 'file') {
		switch ($type) {
			case 'file':
				return file_exists($filePath);
			case 'dir':
				return file_exists($filePath) && is_dir($filePath);
			default:
				return false;
		}
	}

	/**
	 * Returns a file type, based on generic categories defined above
	 * @param $type String
	 * @return string (Enuemrated DOCUMENT_TYPEs)
	 */
	function getDocumentType($type) {
		if ($this->getImageExtension($type))
			return DOCUMENT_TYPE_IMAGE;

		switch ($type) {
			case 'application/pdf':
			case 'application/x-pdf':
			case 'text/pdf':
			case 'text/x-pdf':
				return DOCUMENT_TYPE_PDF;
			case 'application/msword':
			case 'application/word':
				return DOCUMENT_TYPE_WORD;
			case 'application/excel':
				return DOCUMENT_TYPE_EXCEL;
			case 'text/html':
				return DOCUMENT_TYPE_HTML;
			case 'application/zip':
			case 'application/x-zip':
			case 'application/x-zip-compressed':
			case 'application/x-compress':
			case 'application/x-compressed':
			case 'multipart/x-zip':
				return DOCUMENT_TYPE_ZIP;
			case 'application/epub':
			case 'application/epub+zip':
				return DOCUMENT_TYPE_EPUB;
			default:
				return DOCUMENT_TYPE_DEFAULT;
		}
	}

	/**
	 * Returns file extension associated with the given document type,
	 * or false if the type does not belong to a recognized document type.
	 * @param $type string
	 */
	function getDocumentExtension($type) {
		switch ($type) {
			case 'application/pdf':
				return '.pdf';
			case 'application/word':
				return '.doc';
			case 'text/css':
				return '.css';
			case 'text/html':
				return '.html';
			case 'application/epub+zip':
				return '.epub';
			default:
				return false;
		}
	}

	/**
	 * Returns file extension associated with the given image type,
	 * or false if the type does not belong to a recognized image type.
	 * @param $type string
	 */
	function getImageExtension($type) {
		switch ($type) {
			case 'image/gif':
				return '.gif';
			case 'image/jpeg':
			case 'image/pjpeg':
				return '.jpg';
			case 'image/png':
			case 'image/x-png':
				return '.png';
			case 'image/vnd.microsoft.icon':
			case 'image/x-icon':
			case 'image/x-ico':
			case 'image/ico':
				return '.ico';
			case 'image/svg+xml':
			case 'image/svg':
				return '.svg';
			case 'application/x-shockwave-flash':
				return '.swf';
			case 'video/x-flv':
			case 'application/x-flash-video':
			case 'flv-application/octet-stream':
				return '.flv';
			case 'audio/mpeg':
				return '.mp3';
			case 'audio/x-aiff':
				return '.aiff';
			case 'audio/x-wav':
				return '.wav';
			case 'video/mpeg':
				return '.mpg';
			case 'video/quicktime':
				return '.mov';
			case 'video/mp4':
				return '.mp4';
			case 'text/javascript':
				return '.js';
			default:
				return false;
		}
	}

	/**
	 * Parse file extension from file name.
	 * @param string a valid file name
	 * @return string extension
	 */
	function getExtension($fileName) {
		$extension = '';
		$fileParts = explode('.', $fileName);
		if (is_array($fileParts)) {
			$extension = $fileParts[count($fileParts) - 1];
		}
		return $extension;
	}

	/**
	 * Truncate a filename to fit in the specified length.
	 */
	function truncateFileName($fileName, $length = 127) {
		if (PKPString::strlen($fileName) <= $length) return $fileName;
		$ext = $this->getExtension($fileName);
		$truncated = PKPString::substr($fileName, 0, $length - 1 - PKPString::strlen($ext)) . '.' . $ext;
		return PKPString::substr($truncated, 0, $length);
	}

	/**
	 * Return pretty file size string (in B, KB, MB, or GB units).
	 * @param $size int file size in bytes
	 * @return string
	 */
	function getNiceFileSize($size) {
		$niceFileSizeUnits = array('B', 'KB', 'MB', 'GB');
		for($i = 0; $i < 4 && $size > 1024; $i++) {
			$size >>= 10;
		}
		return $size . $niceFileSizeUnits[$i];
	}

	/**
	 * Set file/directory mode based on the 'umask' config setting.
	 * @param $path string
	 * @param $mask int
	 * @return boolean
	 */
	function setMode($path, $mask) {
		$umask = Config::getVar('files', 'umask');
		if (!$umask)
			return true;
		return chmod($path, $mask & ~$umask);
	}

	/**
	 * Parse the file extension from a filename/path.
	 * @param $fileName string
	 * @return string
	 */
	function parseFileExtension($fileName) {
		$fileParts = explode('.', $fileName);
		if (is_array($fileParts)) {
			$fileExtension = $fileParts[count($fileParts) - 1];
		}

		// FIXME Check for evil
		if (!isset($fileExtension) || stristr($fileExtension, 'php') || strlen($fileExtension) > 6 || !preg_match('/^\w+$/', $fileExtension)) {
			$fileExtension = 'txt';
		}

		// consider .tar.gz extension
		if (strtolower(substr($fileName, -7)) == '.tar.gz') {
			$fileExtension = substr($fileName, -6);
		}

		return $fileExtension;
	}

	/**
	 * Decompress passed gziped file.
	 * @param $filePath string
	 * @return string The file path that was created.
	 */
	function decompressFile($filePath) {
		return $this->_executeGzip($filePath, true);
	}

	/**
	 * Compress passed file.
	 * @param $filePath string The file to be compressed.
	 * @return string The file path that was created.
	 */
	function compressFile($filePath) {
		return $this->_executeGzip($filePath, false);
	}


	//
	// Private helper methods.
	//
	/**
	 * Execute gzip to compress or extract files.
	 * @param $filePath string file to be compressed or uncompressed.
	 * @param $decompress boolean optional Set true if the passed file
	 * needs to be decompressed.
	 * @return string The file path that was created with the operation
	 */
	private function _executeGzip($filePath, $decompress = false) {
		PKPLocale::requireComponents(LOCALE_COMPONENT_PKP_ADMIN);
		$gzipPath = Config::getVar('cli', 'gzip');
		if (!is_executable($gzipPath)) {
			throw new Exception(__('admin.error.executingUtil', array('utilPath' => $gzipPath, 'utilVar' => 'gzip')));
		}
		$gzipCmd = escapeshellarg($gzipPath);
		if ($decompress) $gzipCmd .= ' -d';
		// Make sure any output message will mention the file path.
		$output = array($filePath);
		$returnValue = 0;
		$gzipCmd .= ' ' . escapeshellarg($filePath);
		if (!Core::isWindows()) {
			// Get the output, redirecting stderr to stdout.
			$gzipCmd .= ' 2>&1';
		}
		exec($gzipCmd, $output, $returnValue);
		if ($returnValue > 0) {
			throw new Exception(__('admin.error.utilExecutionProblem', array('utilPath' => $gzipPath, 'output' => implode(PHP_EOL, $output))));
		}
		if ($decompress) {
			return substr($filePath, 0, -3);
		} else {
			return $filePath . '.gz';
		}
	}
}
