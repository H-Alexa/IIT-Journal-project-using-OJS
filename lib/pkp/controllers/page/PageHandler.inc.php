<?php

/**
 * @file lib/pkp/controllers/page/PageHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PageHandler
 * @ingroup controllers_page
 *
 * @brief Handler for requests for page components such as the header, tasks,
 *  usernav, and CSS.
 */

import('classes.handler.Handler');

class PageHandler extends Handler {

	//
	// Implement template methods from PKPHandler
	//
	/**
	 * @copydoc PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
		import('lib.pkp.classes.security.authorization.PKPSiteAccessPolicy');
		$this->addPolicy(new PKPSiteAccessPolicy(
			$request,
			array('tasks', 'css'),
			SITE_ACCESS_ALL_ROLES
		));

		$this->setEnforceRestrictedSite(false);
		return parent::authorize($request, $args, $roleAssignments);
	}


	//
	// Public operations
	//
	/**
	 * Display the tasks component
	 * @param $args array
	 * @param $request PKPRequest
	 * @return JSONMessage JSON object
	 */
	function tasks($args, $request) {
		$this->setupTemplate($request);
		$templateMgr = TemplateManager::getManager($request);
		return $templateMgr->fetchJson('controllers/page/tasks.tpl');
	}

	/**
	 * Get the compiled CSS
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function css($args, $request) {
		header('Content-Type: text/css');

		$templateManager = TemplateManager::getManager($request);

		$name = $request->getUserVar('name');
		if (empty($name)) {
			$name = 'pkp-lib';
		}
		switch ($name) {

			// The core app stylesheet
			case 'pkp-lib':
				$cachedFile = $templateManager->getCachedLessFilePath($name);
				if (!file_exists($cachedFile)) {
					$styles = $templateManager->compileLess($name, 'styles/index.less');
					if (!$templateManager->cacheLess($cachedFile, $styles)) {
						echo $styles;
						die;
					}
				}
				break;

			default:

				// Backwards compatibility. This hook is deprecated.
				if (HookRegistry::getHooks('PageHandler::displayCss')) {
					$result = '';
					$lastModified = null;
					HookRegistry::call('PageHandler::displayCss', array($request, &$name, &$result, &$lastModified));
					if ($lastModified) header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
					header('Content-Length: ' . strlen($result));
					echo $result;
					die;

				} else {
					$cachedFile = $templateManager->getCachedLessFilePath($name);
					if (!file_exists($cachedFile)) {

						// Process styles registered with the current theme
						$styles = '';
						$themes = PluginRegistry::loadCategory('themes', true);
						foreach($themes as $theme) {
							if ($theme->isActive()) {
								$style = $theme->getStyle($name);
								if (!empty($style)) {

									// Compile and cache the stylesheet
									$styles = $templateManager->compileLess(
										$name,
										$style['style'],
										array(
											'baseUrl'          => isset($style['baseUrl']) ? $style['baseUrl'] : null,
											'addLess'          => isset($style['addLess']) ? $style['addLess'] : null,
											'addLessVariables' => isset($style['addLessVariables']) ? $style['addLessVariables'] : null,
										)
									);
								}
								break;
							}
						}

						// If we still haven't found styles, fire off a hook
						// which allows other types of plugins to handle
						// requests
						if (!$styles) {
							HookRegistry::call(
								'PageHandler::getCompiledLess',
								array(
									'request'    => $request,
									'name'       => &$name,
									'styles'     => &$styles,
								)
							);
						}

						// Give up if there are still no styles
						if (!$styles) {
							die;
						}

						// Try to save the styles to a cached file. If we can't,
						// just print them out
						if (!$templateManager->cacheLess($cachedFile, $styles)) {
							echo $styles;
							die;
						}
					}
				}
				break;
		}

		// Deliver the cached file
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($cachedFile)).' GMT');
		header('Content-Length: ' . filesize($cachedFile));
		readfile($cachedFile);
		die;
	}
}


