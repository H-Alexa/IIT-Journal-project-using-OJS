<?php

/**
 * @file api/v1/stats/PKPStatsHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPStatsPublicationHandler
 * @ingroup api_v1_stats
 *
 * @brief Handle API requests for publication statistics.
 *
 */

import('lib.pkp.classes.handler.APIHandler');
import('classes.core.Services');
import('classes.statistics.StatisticsHelper');
import('lib.pkp.classes.submission.PKPSubmission'); // import STATUS_ constants

abstract class PKPStatsPublicationHandler extends APIHandler {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->_handlerPath = 'stats/publications';
		$roles = array(ROLE_ID_SITE_ADMIN, ROLE_ID_MANAGER, ROLE_ID_SUB_EDITOR);
		$this->_endpoints = array(
			'GET' => array (
				array(
					'pattern' => $this->getEndpointPattern(),
					'handler' => array($this, 'getMany'),
					'roles' => $roles
				),
				array(
					'pattern' => $this->getEndpointPattern() . '/abstract',
					'handler' => array($this, 'getManyAbstract'),
					'roles' => $roles
				),
				array(
					'pattern' => $this->getEndpointPattern() . '/galley',
					'handler' => array($this, 'getManyGalley'),
					'roles' => $roles
				),
				array(
					'pattern' => $this->getEndpointPattern() . '/{submissionId}',
					'handler' => array($this, 'get'),
					'roles' => $roles
				),
				array(
					'pattern' => $this->getEndpointPattern() . '/{submissionId}/abstract',
					'handler' => array($this, 'getAbstract'),
					'roles' => $roles
				),
				array(
					'pattern' => $this->getEndpointPattern() . '/{submissionId}/galley',
					'handler' => array($this, 'getGalley'),
					'roles' => $roles
				),
			),
		);
		parent::__construct();
	}

	//
	// Implement methods from PKPHandler
	//
	function authorize($request, &$args, $roleAssignments) {
		$routeName = null;
		$slimRequest = $this->getSlimRequest();

		import('lib.pkp.classes.security.authorization.ContextAccessPolicy');
		$this->addPolicy(new ContextAccessPolicy($request, $roleAssignments));

		import('lib.pkp.classes.security.authorization.PolicySet');
		$rolePolicy = new PolicySet(COMBINING_PERMIT_OVERRIDES);
		import('lib.pkp.classes.security.authorization.RoleBasedHandlerOperationPolicy');
		foreach ($roleAssignments as $role => $operations) {
			$rolePolicy->addPolicy(new RoleBasedHandlerOperationPolicy($request, $role, $operations));
		}
		$this->addPolicy($rolePolicy);

		if (!is_null($slimRequest) && ($route = $slimRequest->getAttribute('route'))) {
			$routeName = $route->getName();
		}
		if (in_array($routeName, ['get', 'getAbstract', 'getGalley'])) {
			import('lib.pkp.classes.security.authorization.SubmissionAccessPolicy');
			$this->addPolicy(new SubmissionAccessPolicy($request, $args, $roleAssignments));
		}

		return parent::authorize($request, $args, $roleAssignments);
	}

	/**
	 * Get usage stats for a set of publications
	 *
	 * Returns total views by abstract, all galleys, pdf galleys,
	 * html galleys, and other galleys.
	 *
	 * @param $slimRequest Request Slim request object
	 * @param $response object Response
	 * @param $args array
	 * @return object Response
	 */
	public function getMany($slimRequest, $response, $args) {
		$request = $this->getRequest();

		if (!$request->getContext()) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$defaultParams = [
			'count' => 30,
			'offset' => 0,
			'orderDirection' => STATISTICS_ORDER_DESC,
		];

		$requestParams = array_merge($defaultParams, $slimRequest->getQueryParams());

		$allowedParams = $this->_processAllowedParams($requestParams, [
			'dateStart',
			'dateEnd',
			'count',
			'offset',
			'orderDirection',
			'searchPhrase',
			$this->sectionIdsQueryParam,
			'submissionIds',
		]);

		$allowedParams['contextIds'] = $request->getContext()->getId();

		\HookRegistry::call('API::stats::publications::params', array(&$allowedParams, $slimRequest));

		$result = $this->_validateStatDates($allowedParams);
		if ($result !== true) {
			return $response->withStatus(400)->withJsonError($result);
		}

		if (!in_array($allowedParams['orderDirection'], [STATISTICS_ORDER_ASC, STATISTICS_ORDER_DESC])) {
			return $response->withStatus(400)->withJsonError('api.stats.400.invalidOrderDirection');
		}

		// Identify submissions which should be included in the results when a searchPhrase is passed
		if (!empty($allowedParams['searchPhrase'])) {
			$allowedSubmissionIds = empty($allowedParams['submissionIds']) ? [] : $allowedParams['submissionIds'];
			$allowedParams['submissionIds'] = $this->_processSearchPhrase($allowedParams['searchPhrase'], $allowedSubmissionIds);

			if (empty($allowedParams['submissionIds'])) {
				return $response->withJson([
					'items' => [],
					'itemsMax' => 0,
				], 200);
			}
		}

		// Get a list of top publications by total abstract and file views
		$statsService = \Services::get('stats');
		$totals = $statsService->getOrderedObjects(STATISTICS_DIMENSION_SUBMISSION_ID, $allowedParams['orderDirection'], array_merge($allowedParams, [
			'assocTypes' => [ASSOC_TYPE_SUBMISSION, ASSOC_TYPE_SUBMISSION_FILE]
		]));

		// Get the stats for each publication
		$items = [];
		foreach ($totals as $total) {
			if (empty($total['id'])) {
				continue;
			}

			$galleyRecords = $statsService->getRecords(array_merge($allowedParams, [
				'assocTypes' => ASSOC_TYPE_SUBMISSION_FILE,
				'submissionIds' => [$total['id']],
			]));

			// Get the galley totals for each file type (pdf, html, other)
			$galleyViews = array_reduce($galleyRecords, [$statsService, 'sumMetric'], 0);
			$pdfViews = array_reduce(array_filter($galleyRecords, [$statsService, 'filterRecordPdf']), [$statsService, 'sumMetric'], 0);
			$htmlViews = array_reduce(array_filter($galleyRecords, [$statsService, 'filterRecordHtml']), [$statsService, 'sumMetric'], 0);
			$otherViews = array_reduce(array_filter($galleyRecords, [$statsService, 'filterRecordOther']), [$statsService, 'sumMetric'], 0);

			// Get the abstract records
			$abstractRecords = $statsService->getRecords(array_merge($allowedParams, [
				'assocTypes' => ASSOC_TYPE_SUBMISSION,
				'submissionIds' => [$total['id']],
			]));
			$abstractViews = array_reduce($abstractRecords, [$statsService, 'sumMetric'], 0);

			// Get the publication
			$submission = \Services::get('submission')->get($total['id']);
			$getPropertiesArgs = [
				'request' => $request,
				'slimRequest' => $slimRequest,
			];
			// Stats may still exist for deleted publications
			$submissionProps = ['id' => $total['id']];
			if ($submission) {
				$submissionProps = \Services::get('submission')->getProperties(
					$submission,
					[
						'_href',
						'id',
						'urlWorkflow',
						'urlPublished',
					],
					$getPropertiesArgs
				);
				$submissionProps = array_merge(
					$submissionProps,
					\Services::get('publication')->getProperties(
						$submission->getCurrentPublication(),
						[
							'authorsStringShort',
							'fullTitle',
						],
						$getPropertiesArgs
					)
				);
			}

			$items[] = [
				'abstractViews' => $abstractViews,
				'galleyViews' => $galleyViews,
				'pdfViews' => $pdfViews,
				'htmlViews' => $htmlViews,
				'otherViews' => $otherViews,
				'publication' => $submissionProps,
			];
		}

		// Get a count of all submission ids that have stats matching this request
		$statsQB = new \PKP\Services\QueryBuilders\PKPStatsQueryBuilder();
		$statsQB
			->filterByContexts(\Application::get()->getRequest()->getContext()->getId())
			->before(isset($allowedParams['dateEnd']) ? $allowedParams['dateEnd'] : STATISTICS_YESTERDAY)
			->after(isset($allowedParams['dateStart']) ? $allowedParams['dateStart'] : STATISTICS_EARLIEST_DATE);
		if (isset($allowedParams[$this->sectionIdsQueryParam])) {
			$statsQB->filterBySections($allowedParams[$this->sectionIdsQueryParam]);
		}
		if (isset($allowedParams['submissionIds'])) {
			$statsQB->filterBySubmissions($allowedParams['submissionIds']);
		}
		$statsQO = $statsQB->getSubmissionIds();

		$metricsDao = \DAORegistry::getDAO('MetricsDAO'); /** @var MetricsDAO */
		return $response->withJson([
			'items' => $items,
			'itemsMax' => $metricsDao->countRecords($statsQO->toSql(), $statsQO->getBindings()),
		], 200);
	}

	/**
	 * Get the total abstract views for a set of publications
	 * in a timeline broken down month or day
	 *
	 * @param $slimRequest Request Slim request object
	 * @param $response object Response
	 * @param $args array
	 * @return object Response
	 */
	public function getManyAbstract($slimRequest, $response, $args) {
		$request = $this->getRequest();

		if (!$request->getContext()) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$defaultParams = [
			'timelineInterval' => STATISTICS_DIMENSION_MONTH,
		];

		$requestParams = array_merge($defaultParams, $slimRequest->getQueryParams());

		$allowedParams = $this->_processAllowedParams($requestParams, [
			'dateStart',
			'dateEnd',
			'timelineInterval',
			'searchPhrase',
			$this->sectionIdsQueryParam,
			'submissionIds',
		]);

		\HookRegistry::call('API::stats::publications::abstract::params', array(&$allowedParams, $slimRequest));

		if (!in_array($allowedParams['timelineInterval'], [STATISTICS_DIMENSION_DAY, STATISTICS_DIMENSION_MONTH])) {
			return $response->withStatus(400)->withJsonError('api.stats.400.wrongTimelineInterval');
		}

		$result = $this->_validateStatDates($allowedParams);
		if ($result !== true) {
			return $response->withStatus(400)->withJsonError($result);
		}

		$allowedParams['contextIds'] = $request->getContext()->getId();
		$allowedParams['assocTypes'] = ASSOC_TYPE_SUBMISSION;

		// Identify submissions which should be included in the results when a searchPhrase is passed
		if (!empty($allowedParams['searchPhrase'])) {
			$allowedSubmissionIds = empty($allowedParams['submissionIds']) ? [] : $allowedParams['submissionIds'];
			$allowedParams['submissionIds'] = $this->_processSearchPhrase($allowedParams['searchPhrase'], $allowedSubmissionIds);

			if (empty($allowedParams['submissionIds'])) {
				$dateStart = empty($allowedParams['dateStart']) ? STATISTICS_EARLIEST_DATE : $allowedParams['dateStart'];
				$dateEnd = empty($allowedParams['dateEnd']) ? date('Ymd', strtotime('yesterday')) : $allowedParams['dateEnd'];
				$emptyTimeline = \Services::get('stats')->getEmptyTimelineIntervals($dateStart, $dateEnd, $allowedParams['timelineInterval']);
				return $response->withJson($emptyTimeline, 200);
			}
		}

		$data = \Services::get('stats')->getTimeline($allowedParams['timelineInterval'], $allowedParams);

		return $response->withJson($data, 200);
	}

	/**
	 * Get the total galley views for a set of publications
	 * in a timeline broken down month or day
	 *
	 * @param $slimRequest Request Slim request object
	 * @param $response object Response
	 * @param $args array
	 * @return object Response
	 */
	public function getManyGalley($slimRequest, $response, $args) {
		$request = $this->getRequest();

		if (!$request->getContext()) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$defaultParams = [
			'timelineInterval' => STATISTICS_DIMENSION_MONTH,
		];

		$requestParams = array_merge($defaultParams, $slimRequest->getQueryParams());

		$allowedParams = $this->_processAllowedParams($requestParams, [
			'dateStart',
			'dateEnd',
			'timelineInterval',
			'searchPhrase',
			$this->sectionIdsQueryParam,
			'submissionIds',
		]);

		\HookRegistry::call('API::stats::publications::galley::params', array(&$allowedParams, $slimRequest));

		if (!in_array($allowedParams['timelineInterval'], [STATISTICS_DIMENSION_DAY, STATISTICS_DIMENSION_MONTH])) {
			return $response->withStatus(400)->withJsonError('api.stats.400.wrongTimelineInterval');
		}

		$result = $this->_validateStatDates($allowedParams);
		if ($result !== true) {
			return $response->withStatus(400)->withJsonError($result);
		}

		$allowedParams['contextIds'] = $request->getContext()->getId();
		$allowedParams['assocTypes'] = ASSOC_TYPE_SUBMISSION_FILE;

		// Identify submissions which should be included in the results when a searchPhrase is passed
		if (!empty($allowedParams['searchPhrase'])) {
			$allowedSubmissionIds = empty($allowedParams['submissionIds']) ? [] : $allowedParams['submissionIds'];
			$allowedParams['submissionIds'] = $this->_processSearchPhrase($allowedParams['searchPhrase'], $allowedSubmissionIds);

			if (empty($allowedParams['submissionIds'])) {
				$dateStart = empty($allowedParams['dateStart']) ? STATISTICS_EARLIEST_DATE : $allowedParams['dateStart'];
				$dateEnd = empty($allowedParams['dateEnd']) ? date('Ymd', strtotime('yesterday')) : $allowedParams['dateEnd'];
				$emptyTimeline = \Services::get('stats')->getEmptyTimelineIntervals($dateStart, $dateEnd, $allowedParams['timelineInterval']);
				return $response->withJson($emptyTimeline, 200);
			}
		}

		$data = \Services::get('stats')->getTimeline($allowedParams['timelineInterval'], $allowedParams);

		return $response->withJson($data, 200);
	}

	/**
	 * Get a single publication's usage statistics
	 * @param $slimRequest object Request Slim request
	 * @param $response object Response
	 * @param $args array
	 * @return object Response
	 */
	public function get($slimRequest, $response, $args) {
		$request = $this->getRequest();

		if (!$request->getContext()) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);

		$allowedParams = $this->_processAllowedParams($slimRequest->getQueryParams(), [
			'dateStart',
			'dateEnd',
		]);

		\HookRegistry::call('API::stats::publication::params', array(&$allowedParams, $slimRequest));

		$result = $this->_validateStatDates($allowedParams);
		if ($result !== true) {
			return $response->withStatus(400)->withJsonError($result);
		}

		$allowedParams['submissionIds'] = [$submission->getId()];
		$allowedParams['contextIds'] = $request->getContext()->getId();

		$statsService = Services::get('stats');

		$abstractRecords = $statsService->getRecords(array_merge($allowedParams, [
			'assocTypes' => [ASSOC_TYPE_SUBMISSION],
		]));
		$abstractViews = array_reduce($abstractRecords, [$statsService, 'sumMetric'], 0);

		// Get the galley totals for each file type (pdf, html, other)
		$galleyRecords = $statsService->getRecords(array_merge($allowedParams, [
			'assocTypes' => [ASSOC_TYPE_SUBMISSION_FILE],
		]));
		$galleyViews = array_reduce($galleyRecords, [$statsService, 'sumMetric'], 0);
		$pdfViews = array_reduce(array_filter($galleyRecords, [$statsService, 'filterRecordPdf']), [$statsService, 'sumMetric'], 0);
		$htmlViews = array_reduce(array_filter($galleyRecords, [$statsService, 'filterRecordHtml']), [$statsService, 'sumMetric'], 0);
		$otherViews = array_reduce(array_filter($galleyRecords, [$statsService, 'filterRecordOther']), [$statsService, 'sumMetric'], 0);

		$submissionProps = Services::get('submission')->getProperties(
			$submission,
			[
				'_href',
				'id',
				'urlWorkflow',
				'urlPublished',
			],
			[
				'request' => $request,
				'slimRequest' => $slimRequest,
			]
		);
		$submissionProps = array_merge(
			$submissionProps,
			Services::get('publication')->getProperties(
				$submission->getCurrentPublication(),
				[
					'authorsStringShort',
					'fullTitle',
				],
				[
					'request' => $request,
					'slimRequest' => $slimRequest,
				]
			)
		);

		return $response->withJson([
			'abstractViews' => $abstractViews,
			'galleyViews' => $galleyViews,
			'pdfViews' => $pdfViews,
			'htmlViews' => $htmlViews,
			'otherViews' => $otherViews,
			'publication' => $submissionProps,
		], 200);
	}

	/**
	 * Get the total abstract views for a set of publications broken down by
	 * month or day
	 *
	 * @param $slimRequest Request Slim request object
	 * @param $response object Response
	 * @param $args array
	 * @return object Response
	 */
	public function getAbstract($slimRequest, $response, $args) {
		$request = $this->getRequest();

		if (!$request->getContext()) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		if (!$submission) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$defaultParams = [
			'timelineInterval' => STATISTICS_DIMENSION_MONTH,
		];

		$requestParams = array_merge($defaultParams, $slimRequest->getQueryParams());

		$allowedParams = $this->_processAllowedParams($requestParams, [
			'dateStart',
			'dateEnd',
			'timelineInterval',
		]);

		$allowedParams['contextIds'] = $request->getContext()->getId();
		$allowedParams['submissionIds'] = $submission->getId();
		$allowedParams['assocTypes'] = ASSOC_TYPE_SUBMISSION;
		$allowedParams['assocIds'] = $submission->getId();

		\HookRegistry::call('API::stats::publication::abstract::params', array(&$allowedParams, $slimRequest));

		$result = $this->_validateStatDates($allowedParams);
		if ($result !== true) {
			return $response->withStatus(400)->withJsonError($result);
		}

		$statsService = \Services::get('stats');
		$data = $statsService->getTimeline($allowedParams['timelineInterval'], $allowedParams);

		return $response->withJson($data, 200);
	}

	/**
	 * Get the total galley views for a publication broken down by
	 * month or day
	 *
	 * @param $slimRequest Request Slim request object
	 * @param $response object Response
	 * @param $args array
	 * @return object Response
	 */
	public function getGalley($slimRequest, $response, $args) {
		$request = $this->getRequest();


		if (!$request->getContext()) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$submission = $this->getAuthorizedContextObject(ASSOC_TYPE_SUBMISSION);
		if (!$submission) {
			return $response->withStatus(404)->withJsonError('api.404.resourceNotFound');
		}

		$defaultParams = [
			'timelineInterval' => STATISTICS_DIMENSION_MONTH,
		];

		$requestParams = array_merge($defaultParams, $slimRequest->getQueryParams());

		$allowedParams = $this->_processAllowedParams($requestParams, [
			'dateStart',
			'dateEnd',
			'timelineInterval',
		]);

		$allowedParams['contextIds'] = $request->getContext()->getId();
		$allowedParams['submissionIds'] = $submission->getId();
		$allowedParams['assocTypes'] = ASSOC_TYPE_SUBMISSION_FILE;

		\HookRegistry::call('API::stats::publication::galley::params', array(&$allowedParams, $slimRequest));

		$result = $this->_validateStatDates($allowedParams);
		if ($result !== true) {
			return $response->withStatus(400)->withJsonError($result);
		}

		$statsService = \Services::get('stats');
		$data = $statsService->getTimeline($allowedParams['timelineInterval'], $allowedParams);

		return $response->withJson($data, 200);
	}

	/**
	 * A helper method to filter and sanitize the request params
	 *
	 * Only allows the specified params through and enforces variable
	 * type where needed.
	 *
	 * @param array $requestParams
	 * @param array $allowedParams
	 * @return array
	 */
	protected function _processAllowedParams($requestParams, $allowedParams) {

		$returnParams = [];
		foreach ($requestParams as $requestParam => $value) {
			if (!in_array($requestParam, $allowedParams)) {
				continue;
			}
			switch ($requestParam) {
				case 'dateStart':
				case 'dateEnd':
				case 'timelineInterval':
				case 'searchPhrase':
					$returnParams[$requestParam] = $value;
					break;

				case 'count':
					$returnParams[$requestParam] = min(100, (int) $value);
					break;

				case 'offset':
					$returnParams[$requestParam] = (int) $value;
					break;

				case 'orderDirection':
					$returnParams[$requestParam] = strtoupper($value);
					break;

				case $this->sectionIdsQueryParam:
				case 'submissionIds':
					if (is_string($value) && strpos($value, ',') > -1) {
						$value = explode(',', $value);
					} elseif (!is_array($value)) {
						$value = array($value);
					}
					$returnParams[$requestParam] = array_map('intval', $value);
					break;

			}
		}

		// Get the earliest date of publication if no start date set
		if (in_array('dateStart', $allowedParams) && !isset($returnParams['dateStart'])) {
			$dateRange = Services::get('publication')->getDateBoundaries(['contextIds' => $this->getRequest()->getContext()->getId()]);
			$returnParams['dateStart'] = $dateRange[0];
		}

		return $returnParams;
	}

	/**
	 * A helper method to get the submissionIds param when a searchPhase
	 * param is also passed.
	 *
	 * If the searchPhrase and submissionIds params were both passed in the
	 * request, then we only return ids that match both conditions.
	 *
	 * @param string $searchPhrase
	 * @param array $submissionIds List of allowed submission Ids
	 * @return array submission ids
	 */
	protected function _processSearchPhrase($searchPhrase, $submissionIds = []) {
		$searchPhraseSubmissionIds = \Services::get('submission')->getIds([
			'contextId' => \Application::get()->getRequest()->getContext()->getId(),
			'searchPhrase' => $searchPhrase,
			'status' => STATUS_PUBLISHED,
		]);

		if (!empty($submissionIds)) {
			$submissionIds = array_intersect($submissionIds, $searchPhraseSubmissionIds);
		} else {
			$submissionIds = $searchPhraseSubmissionIds;
		}

		return $submissionIds;
	}
}
