<?php

/**
 * @file pages/about/AboutHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class AboutHandler
 * @ingroup pages_about
 *
 * @brief Handle requests for journal about functions.
 */

import('lib.pkp.pages.about.AboutContextHandler');

class AboutHandler extends AboutContextHandler {
	/**
	 * Display about page.
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function subscriptions($args, $request) {
		$templateMgr = TemplateManager::getManager($request);
		$this->setupTemplate($request);
		$journal = $request->getJournal();
		$subscriptionTypeDao =& DAORegistry::getDAO('SubscriptionTypeDAO');

		if ($journal) {
			$paymentManager = \Application::getPaymentManager($journal);
			if (!($journal->getData('paymentsEnabled') && $paymentManager->isConfigured())) {
				$request->redirect(null, 'index');
			}
		}

		$templateMgr->assign(array(
			'subscriptionAdditionalInformation' => $journal->getLocalizedData('subscriptionAdditionalInformation'),
			'subscriptionMailingAddress' => $journal->getData('subscriptionMailingAddress'),
			'subscriptionName' => $journal->getData('subscriptionName'),
			'subscriptionPhone' => $journal->getData('subscriptionPhone'),
			'subscriptionEmail' => $journal->getData('subscriptionEmail'),
			'individualSubscriptionTypes' => $subscriptionTypeDao->getByInstitutional($journal->getId(), false, false)->toArray(),
			'institutionalSubscriptionTypes' => $subscriptionTypeDao->getByInstitutional($journal->getId(), true, false)->toArray(),
		));
		$templateMgr->display('frontend/pages/subscriptions.tpl');
	}
}


