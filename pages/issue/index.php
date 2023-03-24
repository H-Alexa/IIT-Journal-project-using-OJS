<?php

/**
 * @defgroup pages_issue Issue Pages
 */

/**
 * @file pages/issue/index.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup pages_issue
 * @brief Handle requests for issue functions.
 *
 */
switch ($op) {
	case 'index':
	case 'current':
	case 'archive':
	case 'view':
	case 'download':
		define('HANDLER_CLASS', 'IssueHandler');
		import('pages.issue.IssueHandler');
		break;
}


