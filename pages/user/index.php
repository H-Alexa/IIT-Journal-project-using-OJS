<?php

/**
 * @defgroup pages_user User Pages
 */

/**
 * @file pages/user/index.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup pages_user
 * @brief Handle requests for user functions.
 *
 */

switch ($op) {
	//
	// Misc.
	//
	case 'index':
	case 'subscriptions':
	case 'setLocale':
	case 'authorizationDenied':
	case 'purchaseSubscription':
	case 'payPurchaseSubscription':
	case 'completePurchaseSubscription':
	case 'payRenewSubscription':
	case 'payMembership':
	case 'getInterests':
		define('HANDLER_CLASS', 'UserHandler');
		import('pages.user.UserHandler');
		break;
	default:
		require_once('lib/pkp/pages/user/index.php');
}


