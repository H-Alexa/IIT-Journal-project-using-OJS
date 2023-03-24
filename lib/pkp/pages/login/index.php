<?php

/**
 * @defgroup pages_login Login Pages
 */

/**
 * @file lib/pkp/pages/login/index.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @brief Handle login/logout requests.
 *
 * @ingroup pages_login
 */

switch ($op) {
	case 'index':
	case 'signIn':
	case 'signOut':
	case 'lostPassword':
	case 'requestResetPassword':
	case 'resetPassword':
	case 'changePassword':
	case 'savePassword':
	case 'signInAsUser':
	case 'signOutAsUser':
		define('HANDLER_CLASS', 'LoginHandler');
		import('lib.pkp.pages.login.LoginHandler');
		break;
}


