<?php

/**
 * @file plugins/blocks/browse/BrowseBlockPlugin.inc.php
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class BrowseBlockPlugin
 * @brief Class for browse block plugin
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class BrowseBlockPlugin extends BlockPlugin {
	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.block.browse.displayName');
	}

	/**
	 * Get a description of the plugin.
	 */
	function getDescription() {
		return __('plugins.block.browse.description');
	}

	/**
	 * Get the HTML contents of the browse block.
	 * @param $templateMgr PKPTemplateManager
	 * @return string
	 */
	function getContents($templateMgr, $request = null) {
		$context = $request->getContext();
		if (!$context) {
			return '';
		}
		$categoryDao = DAORegistry::getDAO('CategoryDAO'); /* @var $categoryDao CategoryDAO */
		$router = $request->getRouter();

		$requestedCategoryPath = null;
		$args = $router->getRequestedArgs($request);
		if ($router->getRequestedPage($request) . '/' . $router->getRequestedOp($request) == 'catalog/category') $requestedCategoryPath = reset($args);
		$templateMgr->assign(array(
			'browseBlockSelectedCategory' => $requestedCategoryPath,
			'browseCategories' => $categoryDao->getByContextId($context->getId())->toArray(),
		));
		return parent::getContents($templateMgr);
	}
}
