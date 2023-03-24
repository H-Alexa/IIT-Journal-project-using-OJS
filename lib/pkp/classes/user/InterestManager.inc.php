<?php

/**
 * @file classes/user/InterestManager.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class InterestManager
 * @ingroup user
 * @see InterestDAO
 * @brief Handle user interest functions.
 */

class InterestManager {
	/**
	 * Constructor.
	 */
	function __construct() {
	}

	/**
	 * Get all interests for all users in the system
	 * @param $filter string
	 * @return array
	 */
	function getAllInterests($filter = null) {
		$interestDao = DAORegistry::getDAO('InterestDAO'); /* @var $interestDao InterestDAO */
		$interests = $interestDao->getAllInterests($filter);

		$interestReturner = array();
		while($interest = $interests->next()) {
			$interestReturner[] = $interest->getInterest();
		}

		return $interestReturner;
	}

	/**
	 * Get user reviewing interests. (Cached in memory for batch fetches.)
	 * @param $user User
	 * @return array
	 */
	function getInterestsForUser($user) {
		static $interestsCache = array();
		$interests = array();

		$interestDao = DAORegistry::getDAO('InterestDAO'); /* @var $interestDao InterestDAO */
		$interestEntryDao = DAORegistry::getDAO('InterestEntryDAO'); /* @var $interestEntryDao InterestEntryDAO */
		$controlledVocab = $interestDao->build();
		foreach($interestDao->getUserInterestIds($user->getId()) as $interestEntryId) {
			if (!isset($interestsCache[$interestEntryId])) {
				$interestsCache[$interestEntryId] = $interestEntryDao->getById(
					$interestEntryId,
					$controlledVocab->getId()
				);
			}
			if (isset($interestsCache[$interestEntryId])) {
				$interests[] = $interestsCache[$interestEntryId]->getInterest();
			}
		}

		return $interests;
	}

	/**
	 * Returns a comma separated string of a user's interests
	 * @param $user User
	 * @return string
	 */
	function getInterestsString($user) {
		$interests = $this->getInterestsForUser($user);

		return implode(', ', $interests);
	}

	/**
	 * Set a user's interests
	 * @param $user User
	 * @param $interests mixed
	 */
	function setInterestsForUser($user, $interests) {
		$interestDao = DAORegistry::getDAO('InterestDAO'); /* @var $interestDao InterestDAO */
		$interests = is_array($interests) ? $interests : (empty($interests) ? null : explode(",", $interests));
		$interestDao->setUserInterests($interests, $user->getId());
	}
}


