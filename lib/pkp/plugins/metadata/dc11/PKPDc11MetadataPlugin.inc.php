<?php
/**
 * @defgroup plugins_metadata_dc11 Dublin Core 1.1 Metadata Format
 */

/**
 * @file plugins/metadata/dc11/PKPDc11MetadataPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPDc11MetadataPlugin
 * @ingroup plugins_metadata_dc11
 *
 * @brief Abstract base class for Dublin Core version 1.1 metadata plugins
 */


import('lib.pkp.classes.plugins.MetadataPlugin');

class PKPDc11MetadataPlugin extends MetadataPlugin {

	//
	// Override protected template methods from Plugin
	//
	/**
	 * @copydoc Plugin::getName()
	 */
	function getName() {
		return 'Dc11MetadataPlugin';
	}

	/**
	 * @copydoc Plugin::getDisplayName()
	 */
	function getDisplayName() {
		return __('plugins.metadata.dc11.displayName');
	}

	/**
	 * @copydoc Plugin::getDescription()
	 */
	function getDescription() {
		return __('plugins.metadata.dc11.description');
	}

	/**
	 * @copydoc MetadataPlugin::supportsFormat()
	 */
	public function supportsFormat($format) {
		return $format === 'dc11';
	}

	/**
	 * @copydoc MetadataPlugin::getSchemaObject()
	 */
	public function getSchemaObject($format) {
		assert($this->supportsFormat($format));
		import('plugins.metadata.dc11.schema.Dc11Schema');
		return new Dc11Schema();
	}
}


