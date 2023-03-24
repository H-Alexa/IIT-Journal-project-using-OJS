<?php

/**
 * @file classes/services/IssueService.php
*
* Copyright (c) 2014-2021 Simon Fraser University
* Copyright (c) 2000-2021 John Willinsky
* Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
*
* @class IssueService
* @ingroup services
*
* @brief Helper class that encapsulates issue business logic
*/

namespace APP\Services;

use \Journal;
use \Services;
use \DBResultRange;
use \DAORegistry;
use \DAOResultFactory;
use \PKP\Services\interfaces\EntityPropertyInterface;
use \PKP\Services\interfaces\EntityReadInterface;
use \APP\Services\QueryBuilders\IssueQueryBuilder;

class IssueService implements EntityPropertyInterface, EntityReadInterface {

	/**
	 * @copydoc \PKP\Services\interfaces\EntityReadInterface::get()
	 */
	public function get($issueId) {
		$issueDao = DAORegistry::getDAO('IssueDAO'); /* @var $issueDao IssueDAO */
		return $issueDao->getById($issueId);
	}

	/**
	 * @copydoc \PKP\Services\interfaces\EntityReadInterface::getCount()
	 */
	public function getCount($args = []) {
		return $this->getQueryBuilder($args)->getCount();
	}

	/**
	 * @copydoc \PKP\Services\interfaces\EntityReadInterface::getIds()
	 */
	public function getIds($args = []) {
		return $this->getQueryBuilder($args)->getIds();
	}

	/**
	 * Get a collection of Issue objects limited, filtered
	 * and sorted by $args
	 *
	 * @param array $args {
	 *		@option int contextId If not supplied, CONTEXT_ID_NONE will be used and
	 *			no submissions will be returned. To retrieve issues from all
	 *			contexts, use CONTEXT_ID_ALL.
	 * 		@option int volumes
	 * 		@option int numbers
	 * 		@option int years
	 * 		@option boolean isPublished
	 * 		@option int count
	 * 		@option int offset
	 * 		@option string orderBy
	 * 		@option string orderDirection
	 * }
	 *
	 * @return \Iterator
	 */
	public function getMany($args = []) {
		$range = null;
		if (isset($args['count'])) {
			import('lib.pkp.classes.db.DBResultRange');
			$range = new \DBResultRange($args['count'], null, isset($args['offset']) ? $args['offset'] : 0);
		}
		// Pagination is handled by the DAO, so don't pass count and offset
		// arguments to the QueryBuilder.
		if (isset($args['count'])) unset($args['count']);
		if (isset($args['offset'])) unset($args['offset']);
		$issueListQO = $this->getQueryBuilder($args)->getQuery();
		$issueDao = DAORegistry::getDAO('IssueDAO'); /* @var $issueDao IssueDAO */
		$result = $issueDao->retrieveRange($issueListQO->toSql(), $issueListQO->getBindings(), $range);
		$queryResults = new DAOResultFactory($result, $issueDao, '_fromRow');

		return $queryResults->toIterator();
	}

	/**
	 * @copydoc \PKP\Services\interfaces\EntityReadInterface::getMax()
	 */
	public function getMax($args = []) {
		// Don't accept args to limit the results
		if (isset($args['count'])) unset($args['count']);
		if (isset($args['offset'])) unset($args['offset']);
		return $this->getQueryBuilder($args)->getCount();
	}

	/**
	 * @copydoc \PKP\Services\interfaces\EntityReadInterface::getQueryBuilder()
	 * @return \APP\Services\QueryBuilders\IssueQueryBuilder
	 */
	public function getQueryBuilder($args = []) {

		$defaultArgs = array(
			'contextId' => CONTEXT_ID_NONE,
			'orderBy' => 'datePublished',
			'orderDirection' => 'DESC',
			'isPublished' => null,
			'volumes' => null,
			'numbers' => null,
			'years' => null,
			'searchPhrase' => '',
		);

		$args = array_merge($defaultArgs, $args);

		$issueListQB = new IssueQueryBuilder();
		$issueListQB
			->filterByContext($args['contextId'])
			->orderBy($args['orderBy'], $args['orderDirection'])
			->filterByPublished($args['isPublished'])
			->filterByVolumes($args['volumes'])
			->filterByNumbers($args['numbers'])
			->filterByYears($args['years'])
			->searchPhrase($args['searchPhrase']);

			if (isset($args['count'])) {
				$issueListQB->limitTo($args['count']);
			}

			if (isset($args['offset'])) {
				$issueListQB->offsetBy($args['count']);
			}

		\HookRegistry::call('Issue::getMany::queryBuilder', array(&$issueListQB, $args));

		return $issueListQB;
	}

	/**
	 * Determine if a user can access galleys for a specific issue
	 *
	 * @param \Journal $journal
	 * @param \Issue $issue
	 *
	 * @return boolean
	 */
	public function userHasAccessToGalleys(\Journal $journal, \Issue $issue) {
		import('classes.issue.IssueAction');
		$issueAction = new \IssueAction();

		$subscriptionRequired = $issueAction->subscriptionRequired($issue, $journal);
		$subscribedUser = $issueAction->subscribedUser($journal, $issue);
		$subscribedDomain = $issueAction->subscribedDomain($journal, $issue);

		return !$subscriptionRequired || $issue->getAccessStatus() == ISSUE_ACCESS_OPEN || $subscribedUser || $subscribedDomain;
	}

	/**
	 * Determine issue access status based on journal publishing mode
	 * @param \Journal $journal
	 *
	 * @return int
	 */
	public function determineAccessStatus(Journal $journal) {
		import('classes.issue.Issue');
		$accessStatus = null;

		switch ($journal->getData('publishingMode')) {
			case PUBLISHING_MODE_SUBSCRIPTION:
			case PUBLISHING_MODE_NONE:
				$accessStatus = ISSUE_ACCESS_SUBSCRIPTION;
				break;
			case PUBLISHING_MODE_OPEN:
			default:
				$accessStatus = ISSUE_ACCESS_OPEN;
				break;
		}

		return $accessStatus;
	}

	/**
	 * @copydoc \PKP\Services\interfaces\EntityPropertyInterface::getProperties()
	 */
	public function getProperties($issue, $props, $args = null) {
		\PluginRegistry::loadCategory('pubIds', true);
		$request = $args['request'];
		$context = $request->getContext();
		$dispatcher = $request->getDispatcher();
		$router = $request->getRouter();
		$values = array();

		foreach ($props as $prop) {
			switch ($prop) {
				case 'id':
					$values[$prop] = (int) $issue->getId();
					break;
				case '_href':
					$values[$prop] = null;
					if (!empty($args['slimRequest'])) {
						$route = $args['slimRequest']->getAttribute('route');
						$arguments = $route->getArguments();
						$values[$prop] = $dispatcher->url(
							$args['request'],
							ROUTE_API,
							$arguments['contextPath'],
							'issues/' . $issue->getId()
						);
					}
					break;
				case 'title':
					$values[$prop] = $issue->getTitle(null);
					break;
				case 'description':
					$values[$prop] = $issue->getDescription(null);
					break;
				case 'identification':
					$values[$prop] = $issue->getIssueIdentification();
					break;
				case 'volume':
					$values[$prop] = (int) $issue->getVolume();
					break;
				case 'number':
					$values[$prop] = $issue->getNumber();
					break;
				case 'year':
					$values[$prop] = (int) $issue->getYear();
					break;
				case 'isCurrent':
					$values[$prop] = (bool) $issue->getCurrent();
					break;
				case 'datePublished':
					$values[$prop] = $issue->getDatePublished();
					break;
				case 'dateNotified':
					$values[$prop] = $issue->getDateNotified();
					break;
				case 'lastModified':
					$values[$prop] = $issue->getLastModified();
					break;
				case 'publishedUrl':
					$values[$prop] = null;
					if ($context) {
						$values[$prop] = $dispatcher->url(
							$request,
							ROUTE_PAGE,
							$context->getPath(),
							'issue',
							'view',
							$issue->getBestIssueId()
						);
					}
					break;
				case 'articles':
					$values[$prop] = array();
					$submissionsIterator = Services::get('submission')->getMany([
						'contextId' => $issue->getJournalId(),
						'issueIds' => $issue->getId(),
						'count' => 1000, // large upper limit
					]);
					foreach ($submissionsIterator as $submission) {
						$values[$prop][] = \Services::get('submission')->getSummaryProperties($submission, $args);
					}
					break;
				case 'sections':
					$values[$prop] = array();
					$sectionDao = \DAORegistry::getDAO('SectionDAO');
					$sections = $sectionDao->getByIssueId($issue->getId());
					if (!empty($sections)) {
						foreach ($sections as $section) {
							$sectionProperties = \Services::get('section')->getSummaryProperties($section, $args);
							$customSequence = $sectionDao->getCustomSectionOrder($issue->getId(), $section->getId());
							if ($customSequence) {
								$sectionProperties['seq'] = $customSequence;
							}
							$values[$prop][] = $sectionProperties;
						}
					}
					break;
				case 'coverImageUrl':
					$values[$prop] = $issue->getCoverImageUrls(null);
					break;
				case 'coverImageAltText':
					$values[$prop] = $issue->getCoverImageAltText(null);
					break;
				case 'galleys':
				case 'galleysSummary';
					$data = array();
					$issueGalleyDao = \DAORegistry::getDAO('IssueGalleyDAO');
					$galleys = $issueGalleyDao->getByIssueId($issue->getId());
					if ($galleys) {
						$galleyArgs = array_merge($args, array('issue' => $issue));
						foreach ($galleys as $galley) {
							$data[] = ($prop === 'galleys')
								? \Services::get('galley')->getFullProperties($galley, $galleyArgs)
								: \Services::get('galley')->getSummaryProperties($galley, $galleyArgs);
						}
					}
					$values['galleys'] = $data;
					break;
			}
		}

		$values = Services::get('schema')->addMissingMultilingualValues(SCHEMA_ISSUE, $values, $context->getSupportedFormLocales());

		\HookRegistry::call('Issue::getProperties::values', array(&$values, $issue, $props, $args));

		ksort($values);

		return $values;
	}

	/**
	 * @copydoc \PKP\Services\interfaces\EntityPropertyInterface::getSummaryProperties()
	 */
	public function getSummaryProperties($issue, $args = null) {
		$props = array (
			'id','_href','title','description','identification','volume','number','year',
			'datePublished', 'publishedUrl', 'coverImageUrl','coverImageAltText','galleysSummary',
		);

		\HookRegistry::call('Issue::getProperties::summaryProperties', array(&$props, $issue, $args));

		return $this->getProperties($issue, $props, $args);
	}

	/**
	 * @copydoc \PKP\Services\interfaces\EntityPropertyInterface::getFullProperties()
	 */
	public function getFullProperties($issue, $args = null) {
		$props = array (
			'id','_href','title','description','identification','volume','number','year','isPublished',
			'isCurrent','datePublished','dateNotified','lastModified','publishedUrl','coverImageUrl',
			'coverImageAltText','articles','sections','tableOfContetnts','galleysSummary',
		);

		\HookRegistry::call('Issue::getProperties::fullProperties', array(&$props, $issue, $args));

		return $this->getProperties($issue, $props, $args);
	}
}
