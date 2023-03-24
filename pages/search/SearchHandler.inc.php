<?php

/**
 * @file pages/search/SearchHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SearchHandler
 * @ingroup pages_search
 *
 * @brief Handle site index requests.
 */

import('classes.search.ArticleSearch');
import('classes.handler.Handler');

class SearchHandler extends Handler {

	/**
	 * @copydoc PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
		import('classes.security.authorization.OjsJournalMustPublishPolicy');
		if ($request->getContext()) $this->addPolicy(new OjsJournalMustPublishPolicy($request));

		return parent::authorize($request, $args, $roleAssignments);
	}

	/**
	 * Show the search form
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function index($args, $request) {
		$this->validate(null, $request);
		$this->search($args, $request);
	}

	/**
	 * Private function to transmit current filter values
	 * to the template.
	 * @param $request PKPRequest
	 * @param $templateMgr TemplateManager
	 * @param $searchFilters array
	 */
	function _assignSearchFilters($request, &$templateMgr, $searchFilters) {
		// Get the journal id (if any).
		$journal =& $searchFilters['searchJournal'];
		$journalId = ($journal ? $journal->getId() : null);
		$searchFilters['searchJournal'] = $journalId;

		// Assign all filters except for dates which need special treatment.
		$templateSearchFilters = array();
		foreach($searchFilters as $filterName => $filterValue) {
			if (in_array($filterName, array('fromDate', 'toDate'))) continue;
			$templateSearchFilters[$filterName] = $filterValue;
		}

		// Assign the filters to the template.
		$templateMgr->assign($templateSearchFilters);

		// Special case: publication date filters.
		foreach(array('From', 'To') as $fromTo) {
			$month = $request->getUserVar("date${fromTo}Month");
			$day = $request->getUserVar("date${fromTo}Day");
			$year = $request->getUserVar("date${fromTo}Year");
			if (empty($year)) {
				$date = NULL;
				$hasEmptyFilters = true;
			} else {
				$defaultMonth = ($fromTo == 'From' ? 1 : 12);
				$defaultDay = ($fromTo == 'From' ? 1 : 31);
				$date = date(
					'Y-m-d H:i:s',
					mktime(
						0, 0, 0, empty($month) ? $defaultMonth : $month,
						empty($day) ? $defaultDay : $day, $year
					)
				);
				$hasActiveFilters = true;
			}
			$templateMgr->assign(array(
				"date${fromTo}Month" => $month,
				"date${fromTo}Day" => $day,
				"date${fromTo}Year" => $year,
				"date${fromTo}" => $date
			));
		}

		// Assign the year range.
		$yearRange = Services::get('publication')->getDateBoundaries(['contextIds' => $journalId]);
		$yearStart = substr($yearRange[0], 0, 4);
		$yearEnd = substr($yearRange[1], 0, 4);
		$templateMgr->assign(array(
			'yearStart' => $yearStart,
			'yearEnd' => $yearEnd,
		));
	}

	/**
	 * Show the search form
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function search($args, $request) {
		$this->validate(null, $request);

		// Get and transform active filters.
		$articleSearch = new ArticleSearch();
		$searchFilters = $articleSearch->getSearchFilters($request);
		$keywords = $articleSearch->getKeywordsFromSearchFilters($searchFilters);

		// Get the range info.
		$rangeInfo = $this->getRangeInfo($request, 'search');

		// Retrieve results.
		$error = '';
		$results = $articleSearch->retrieveResults(
			$request, $searchFilters['searchJournal'], $keywords, $error,
			$searchFilters['fromDate'], $searchFilters['toDate'],
			$rangeInfo
		);

		// Prepare and display the search template.
		$this->setupTemplate($request);
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->setCacheability(CACHEABILITY_NO_STORE);

		// Result set ordering options.
		$orderByOptions = $articleSearch->getResultSetOrderingOptions($request);
		$templateMgr->assign('searchResultOrderOptions', $orderByOptions);
		$orderDirOptions = $articleSearch->getResultSetOrderingDirectionOptions();
		$templateMgr->assign('searchResultOrderDirOptions', $orderDirOptions);

		// Result set ordering selection.
		list($orderBy, $orderDir) = $articleSearch->getResultSetOrdering($request);
		$templateMgr->assign('orderBy', $orderBy);
		$templateMgr->assign('orderDir', $orderDir);

		// Similar documents.
		$templateMgr->assign('simDocsEnabled', true);

		// Result set display.
		$this->_assignSearchFilters($request, $templateMgr, $searchFilters);
		$templateMgr->assign('results', $results);
		$templateMgr->assign('error', $error);
		$templateMgr->display('frontend/pages/search.tpl');
	}

	/**
	 * Redirect to a search query that shows documents
	 * similar to the one identified by an article id in the
	 * request.
	 * @param $args array
	 * @param $request Request
	 */
	function similarDocuments($args, &$request) {
		$this->validate(null, $request);

		// Retrieve the (mandatory) ID of the article that
		// we want similar documents for.
		$articleId = $request->getUserVar('articleId');
		if (!is_numeric($articleId)) {
			$request->redirect(null, 'search');
		}

		// Check whether a search plugin provides terms for a similarity search.
		$articleSearch = new ArticleSearch();
		$searchTerms = $articleSearch->getSimilarityTerms($articleId);

		// Redirect to a search query with the identified search terms (if any).
		if (empty($searchTerms)) {
			$searchParams = null;
		} else {
			$searchParams = array('query' => implode(' ', $searchTerms));
		}
		$request->redirect(null, 'search', 'search', null, $searchParams);
	}

	/**
	 * Show index of published submissions by author.
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function authors($args, $request) {
		$this->validate(null, $request);
		$this->setupTemplate($request);

		$journal = $request->getJournal();
		$user = $request->getUser();

		$authorDao = DAORegistry::getDAO('AuthorDAO'); /* @var $authorDao AuthorDAO */

		if (isset($args[0]) && $args[0] == 'view') {
			// View a specific author
			$authorName = $request->getUserVar('authorName');
			$givenName = $request->getUserVar('givenName');
			$familyName = $request->getUserVar('familyName');
			$affiliation = $request->getUserVar('affiliation');
			$country = $request->getUserVar('country');

			$authorRecords = iterator_to_array(Services::get('author')->getMany([
				'contextIds' => $journal?[$journal->getId()]:[],
				'givenName' => $givenName,
				'familyName' => $familyName,
				'affiliation' => $affiliation,
				'country' => $country,
			]));
			$publicationIds = array_map(function($author) {
				return $author->getData('publicationId');
			}, $authorRecords);
			$submissionIds = array_filter(array_map(function($publicationId) {
				$publication = Services::get('publication')->get($publicationId);
				return $publication->getData('status') == STATUS_PUBLISHED ? $publication->getData('submissionId') : null;
			}, array_unique($publicationIds)));
			$submissions = array_map(function($submissionId) {
				return Services::get('submission')->get($submissionId);
			}, array_unique($submissionIds));

			// Load information associated with each article.
			$journals = array();
			$issues = array();
			$sections = array();
			$issuesUnavailable = array();

			$issueDao = DAORegistry::getDAO('IssueDAO'); /* @var $issueDao IssueDAO */
			$sectionDao = DAORegistry::getDAO('SectionDAO'); /* @var $sectionDao SectionDAO */
			$journalDao = DAORegistry::getDAO('JournalDAO'); /* @var $journalDao JournalDAO */

			foreach ($submissions as $article) {
				$articleId = $article->getId();
				$issueId = $article->getCurrentPublication()->getData('issueId');
				$sectionId = $article->getSectionId();
				$journalId = $article->getData('contextId');

				if (!isset($journals[$journalId])) {
					$journals[$journalId] = $journalDao->getById($journalId);
				}
				if (!isset($issues[$issueId])) {
					import('classes.issue.IssueAction');
					$issue = $issueDao->getById($issueId);
					$issues[$issueId] = $issue;
					$issueAction = new IssueAction();
					$issuesUnavailable[$issueId] = $issueAction->subscriptionRequired($issue, $journals[$journalId]) && (!$issueAction->subscribedUser($user, $journals[$journalId], $issueId, $articleId) && !$issueAction->subscribedDomain($request, $journals[$journalId], $issueId, $articleId));
				}
				if (!isset($sections[$sectionId])) {
					$sections[$sectionId] = $sectionDao->getById($sectionId, $journalId, true);
				}
			}

			if (empty($submissions)) {
				$request->redirect(null, $request->getRequestedPage());
			}

			$templateMgr = TemplateManager::getManager($request);
			$templateMgr->assign(array(
				'submissions' => $submissions,
				'issues' => $issues,
				'issuesUnavailable' => $issuesUnavailable,
				'sections' => $sections,
				'journals' => $journals,
				'givenName' => $givenName,
				'familyName' => $familyName,
				'affiliation' => $affiliation,
				'authorName' => $authorName
			));

			$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
			$countries = $countries = $isoCodes->getCountries();
			$country = $countries->getByAlpha2($country);
			$templateMgr->assign('country', $country?$country->getLocalName():'');

			$templateMgr->display('frontend/pages/searchAuthorDetails.tpl');
		} else {
			// Show the author index
			$searchInitial = $request->getUserVar('searchInitial');
			$rangeInfo = $this->getRangeInfo($request, 'authors');

			$authors = $authorDao->getAuthorsAlphabetizedByJournal(
				isset($journal)?$journal->getId():null,
				$searchInitial,
				$rangeInfo
			);

			$templateMgr = TemplateManager::getManager($request);
			$templateMgr->assign(array(
				'searchInitial' => $request->getUserVar('searchInitial'),
				'alphaList' => array_merge(array('-'), explode(' ', __('common.alphaList'))),
				'authors' => $authors,
			));
			$templateMgr->display('frontend/pages/searchAuthorIndex.tpl');
		}
	}

	/**
	 * Setup common template variables.
	 * @param $request PKPRequest
	 */
	function setupTemplate($request) {
		parent::setupTemplate($request);
		$templateMgr = TemplateManager::getManager($request);
		$journal = $request->getJournal();
		if (!$journal || !$journal->getData('restrictSiteAccess')) {
			$templateMgr->setCacheability(CACHEABILITY_PUBLIC);
		}
	}
}


