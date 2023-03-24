<?php

/**
 * @defgroup plugins_themes_default Default theme plugin
 */
 
/**
 * @file plugins/themes/default/index.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_themes_default
 * @brief Wrapper for default theme plugin.
 *
 */

require_once('DefaultThemePlugin.inc.php');

return new DefaultThemePlugin();


