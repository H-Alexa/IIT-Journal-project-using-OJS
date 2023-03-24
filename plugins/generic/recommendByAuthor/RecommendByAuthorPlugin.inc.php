<?php

/**
 * @file plugins/generic/recommendByAuthor/RecommendByAuthorPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class RecommendByAuthorPlugin
 * @ingroup plugins_generic_recommendByAuthor
 *
 * @brief Plugin to recommend articles from the same author.
 */


import('lib.pkp.classes.plugins.GenericPlugin');

define('RECOMMEND_BY_AUTHOR_PLUGIN_COUNT', 10);

class RecommendByAuthorPlugin extends GenericPlugin {

	//
	// Implement template methods from Plugin.
	//
	/**
	 * @copydoc Plugin::register()
	 */
	function register($category, $path, $mainContextId = null) {
		$success = parent::register($category, $path, $mainContextId);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return $success;

		if ($success && $this->getEnabled($mainContextId)) {
			HookRegistry::register('Templates::Article::Footer::PageFooter', array($this, 'callbackTemplateArticlePageFooter'));
		}
		return $success;
	}

	/**
	 * @see Plugin::getDisplayName()
	 */
	function getDisplayName() {
		return __('plugins.generic.recommendByAuthor.displayName');
	}

	/**
	 * @see Plugin::getDescription()
	 */
	function getDescription() {
		return __('plugins.generic.recommendByAuthor.description');
	}


	//
	// View level hook implementations.
	//
	/**
	 * @see templates/article/footer.tpl
	 */
	function callbackTemplateArticlePageFooter($hookName, $params) {
		$smarty =& $params[1];
		$output =& $params[2];

		// Find articles of the same author(s).
		$displayedArticle = $smarty->getTemplateVars('article');
		$authors = $displayedArticle->getAuthors();
		$foundArticles = array();
		foreach($authors as $author) { /* @var $author Author */
			// The following article search is by name only as authors are
			// not normalized in OJS. This is rather crude and may produce
			// false positives or miss some entries. But there's no other way
			// until OJS allows users to consistently normalize authors (via name,
			// email, ORCID, whatever).
			$authorsIterator = Services::get('author')->getMany([
				'contextIds' => $displayedArticle->getData('contextId'),
				'givenName' => $author->getLocalizedGivenName(),
				'familyName' => $author->getLocalizedFamilyName(),
			]);
			$publicationIds = [];
			foreach ($authorsIterator as $thisAuthor) {
				$publicationIds[] = $thisAuthor->getData('publicationId');
			}
			$submissionIds = array_map(function($publicationId) {
				$publication = Services::get('publication')->get($publicationId);
				return $publication->getData('status') == STATUS_PUBLISHED ? $publication->getData('submissionId') : null;
			}, array_unique($publicationIds));
			$foundArticles = array_unique(array_merge($foundArticles, $submissionIds));
		}

		$results = array_filter($foundArticles, function($value) use ($displayedArticle) {
			if ($value !== $displayedArticle->getId()) return $value;
			return null;
		});

		// Order results by metric.
		$application = Application::get();
		$metricType = $application->getDefaultMetricType();
		if (empty($metricType)) $smarty->assign('noMetricSelected', true);
		$column = STATISTICS_DIMENSION_SUBMISSION_ID;
		$filter = array(
				STATISTICS_DIMENSION_ASSOC_TYPE => array(ASSOC_TYPE_GALLEY, ASSOC_TYPE_SUBMISSION),
				STATISTICS_DIMENSION_SUBMISSION_ID => array($results)
		);
		$orderBy = array(STATISTICS_METRIC => STATISTICS_ORDER_DESC);
		$statsReport = $application->getMetrics($metricType, $column, $filter, $orderBy);
		$orderedResults = array();
		foreach ((array) $statsReport as $reportRow) {
			$orderedResults[] = $reportRow['submission_id'];
		}
		// Make sure we even get results that have no statistics (yet) and that
		// we get them in some consistent order for paging.
		$remainingResults = array_diff($results, $orderedResults);
		sort($remainingResults);
		$orderedResults = array_merge($orderedResults, $remainingResults);

		// Pagination.
		$request = Application::get()->getRequest();
		$rangeInfo = Handler::getRangeInfo($request, 'articlesBySameAuthor');
		if ($rangeInfo && $rangeInfo->isValid()) {
			$page = $rangeInfo->getPage();
		} else {
			$page = 1;
		}
		$totalResults = count($orderedResults);
		$itemsPerPage = RECOMMEND_BY_AUTHOR_PLUGIN_COUNT;
		$offset = $itemsPerPage * ($page-1);
		$length = max($totalResults - $offset, 0);
		$length = min($itemsPerPage, $length);
		if ($length == 0) {
			$pagedResults = array();
		} else {
			$pagedResults = array_slice(
				$orderedResults,
				$offset,
				$length
			);
		}

		// Visualization.
		import('classes.search.ArticleSearch');
		$articleSearch = new ArticleSearch();
		$pagedResults = $articleSearch->formatResults($pagedResults);
		import('lib.pkp.classes.core.VirtualArrayIterator');
		$returner = new VirtualArrayIterator($pagedResults, $totalResults, $page, $itemsPerPage);
		$smarty->assign('articlesBySameAuthor', $returner);
		$output .= $smarty->fetch($this->getTemplateResource('articleFooter.tpl'));
		return false;
	}
}

