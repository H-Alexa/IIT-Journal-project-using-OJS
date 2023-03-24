<?php

/**
 * @file classes/services/PKPStatsEditorialService.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPStatsEditorialService
 * @ingroup services
 *
 * @brief Helper class that encapsulates business logic for getting
 *   editorial stats
 */

namespace PKP\Services;

class PKPStatsEditorialService {

	/**
	 * Get overview of key editorial stats
	 *
	 * @param array $args See self::getQueryBuilder()
	 * @return array
	 */
	public function getOverview($args = []) {
		import('classes.workflow.EditorDecisionActionsManager');
		import('lib.pkp.classes.submission.PKPSubmission');
		\AppLocale::requireComponents(LOCALE_COMPONENT_PKP_MANAGER, LOCALE_COMPONENT_APP_MANAGER);

		$received = $this->countSubmissionsReceived($args);
		$accepted = $this->countByDecisions(SUBMISSION_EDITOR_DECISION_ACCEPT, $args);
		$declinedDesk = $this->countByDecisions(SUBMISSION_EDITOR_DECISION_INITIAL_DECLINE, $args);
		$declinedReview = $this->countByDecisions(SUBMISSION_EDITOR_DECISION_DECLINE, $args);
		$declined = $declinedDesk + $declinedReview;

		// Calculate the acceptance/decline rates
		if (!$received) {
			// Never divide by 0
			$acceptanceRate = 0;
			$declineRate = 0;
			$declinedDeskRate = 0;
			$declinedReviewRate = 0;
		} elseif (empty($args['dateStart']) && empty($args['dateEnd'])) {
			$acceptanceRate = $accepted / $received;
			$declineRate = $declined / $received;
			$declinedDeskRate = $declinedDesk / $received;
			$declinedReviewRate = $declinedReview / $received;
		} else {
			// To calculate the acceptance/decline rates within a date range
			// we must collect the total number of all submissions made within
			// that date range which have received a decision. The acceptance
			// rate is the number of submissions made within the date range
			// that were accepted divided by the number of submissions made
			// within the date range that were accepted or declined. This
			// excludes submissions that were made within the date range but
			// have not yet been accepted or declined.
			$acceptedForSubmissionDate = $this->countByDecisionsForSubmittedDate(SUBMISSION_EDITOR_DECISION_ACCEPT, $args);
			$declinedDeskForSubmissionDate = $this->countByDecisionsForSubmittedDate(SUBMISSION_EDITOR_DECISION_INITIAL_DECLINE, $args);
			$declinedReviewForSubmissionDate = $this->countByDecisionsForSubmittedDate(SUBMISSION_EDITOR_DECISION_DECLINE, $args);
			$totalDecidedForSubmissionDate = $acceptedForSubmissionDate + $declinedDeskForSubmissionDate + $declinedReviewForSubmissionDate;

			// Never divide by 0
			if (!$totalDecidedForSubmissionDate) {
				$acceptanceRate = 0;
				$declineRate = 0;
				$declinedDeskRate = 0;
				$declinedReviewRate = 0;
			} else {
				$acceptanceRate =  $acceptedForSubmissionDate / $totalDecidedForSubmissionDate;
				$declineRate = ($declinedDeskForSubmissionDate + $declinedReviewForSubmissionDate) / $totalDecidedForSubmissionDate;
				$declinedDeskRate =  $declinedDeskForSubmissionDate / $totalDecidedForSubmissionDate;
				$declinedReviewRate =  $declinedReviewForSubmissionDate / $totalDecidedForSubmissionDate;
			}
		}

		// Calculate the number of days it took for most submissions to
		// receive decisions
		$firstDecisionDays = $this->getDaysToDecisions([], $args);
		$acceptDecisionDays = $this->getDaysToDecisions([SUBMISSION_EDITOR_DECISION_SEND_TO_PRODUCTION, SUBMISSION_EDITOR_DECISION_ACCEPT], $args);
		$declineDecisionDays = $this->getDaysToDecisions([SUBMISSION_EDITOR_DECISION_DECLINE, SUBMISSION_EDITOR_DECISION_INITIAL_DECLINE], $args);
		$firstDecisionDaysRate = empty($firstDecisionDays) ? 0 : $this->calculateDaysToDecisionRate($firstDecisionDays, 0.8);
		$acceptDecisionDaysRate = empty($acceptDecisionDays) ? 0 : $this->calculateDaysToDecisionRate($acceptDecisionDays, 0.8);
		$declineDecisionDaysRate = empty($declineDecisionDays) ? 0 : $this->calculateDaysToDecisionRate($declineDecisionDays, 0.8);

		$overview = [
			[
				'key' => 'submissionsReceived',
				'name' => 'stats.name.submissionsReceived',
				'value' => $received,
			],
			[
				'key' => 'submissionsAccepted',
				'name' => 'stats.name.submissionsAccepted',
				'value' => $accepted,
			],
			[
				'key' => 'submissionsDeclined',
				'name' => 'stats.name.submissionsDeclined',
				'value' => $declined,
			],
			[
				'key' => 'submissionsDeclinedDeskReject',
				'name' => 'stats.name.submissionsDeclinedDeskReject',
				'value' => $declinedDesk,
			],
			[
				'key' => 'submissionsDeclinedPostReview',
				'name' => 'stats.name.submissionsDeclinedPostReview',
				'value' => $declinedReview,
			],
			[
				'key' => 'submissionsPublished',
				'name' => 'stats.name.submissionsPublished',
				'value' => $this->countSubmissionsPublished($args),
			],
			[
				'key' => 'daysToDecision',
				'name' => 'stats.name.daysToDecision',
				'value' => $firstDecisionDaysRate,
			],
			[
				'key' => 'daysToAccept',
				'name' => 'stats.name.daysToAccept',
				'value' => $acceptDecisionDaysRate,
			],
			[
				'key' => 'daysToReject',
				'name' => 'stats.name.daysToReject',
				'value' => $declineDecisionDaysRate,
			],
			[
				'key' => 'acceptanceRate',
				'name' => 'stats.name.acceptanceRate',
				'value' => round($acceptanceRate, 2),
			],
			[
				'key' => 'declineRate',
				'name' => 'stats.name.declineRate',
				'value' => round($declineRate, 2),
			],
			[
				'key' => 'declinedDeskRate',
				'name' => 'stats.name.declinedDeskRate',
				'value' => round($declinedDeskRate, 2),
			],
			[
				'key' => 'declinedReviewRate',
				'name' => 'stats.name.declinedReviewRate',
				'value' => round($declinedReviewRate, 2),
			],
		];

		\HookRegistry::call('EditorialStats::overview', [&$overview, $args]);

		return $overview;
	}

	/**
	 * Get the yearly averages of key editorial stats
	 *
	 * Averages are calculated over full years. If no dateStart and
	 * dateEnd are passed, it will determine the first and last
	 * full years during which the activity occurred. This means that
	 * if the first submission was received in October 2017 and the
	 * last submission was received in the current calendar year, only
	 * submissions from 2018 up until the end of the previous calendar
	 * year will be used to calculate the average.
	 *
	 * This method does not yet support getting averages for date ranges.
	 *
	 * @see https://github.com/pkp/pkp-lib/issues/4844#issuecomment-554011922
	 * @param array $args See self::getQueryBuilder(). No date range supported
	 * @return array
	 */
	public function getAverages($args = []) {
		import('classes.workflow.EditorDecisionActionsManager');
		import('lib.pkp.classes.submission.PKPSubmission');

		unset($args['dateStart']);
		unset($args['dateEnd']);

		// Submissions received
		$received = -1;
		$receivedDates = $this->getQueryBuilder($args)->getSubmissionsReceivedDates();
		if (empty($receivedDates[0])) {
			$received = 0;
		} else {
			$yearStart = ((int) substr($receivedDates[0], 0, 4)) + 1;
			$yearEnd = (int) substr($receivedDates[1], 0, 4);
			if ($yearEnd >= date('Y')) {
				$yearEnd--;
			}
			$years = ($yearEnd - $yearStart) + 1;
			if ($years) {
				$argsReceived = array_merge(
					$args,
					[
						'dateStart' => sprintf('%s-01-01', $yearStart),
						'dateEnd' => sprintf('%s-12-31', $yearEnd),
					]
				);
				$received = round($this->countSubmissionsReceived($argsReceived) / $years);
			}
		}

		// Editorial decisions (accepted and declined)
		$decisionsList = [
			'submissionsAccepted' => [SUBMISSION_EDITOR_DECISION_ACCEPT],
			'submissionsDeclined' => [SUBMISSION_EDITOR_DECISION_INITIAL_DECLINE, SUBMISSION_EDITOR_DECISION_DECLINE],
			'submissionsDeclinedDeskReject' => [SUBMISSION_EDITOR_DECISION_INITIAL_DECLINE],
			'submissionsDeclinedPostReview' => [SUBMISSION_EDITOR_DECISION_DECLINE],
		];
		$yearlyDecisions = [];
		foreach ($decisionsList as $key => $decisions) {
			$yearly = -1;
			$dates = $this->getQueryBuilder($args)->getDecisionsDates($decisions);
			if (empty($dates[0])) {
				$yearly = 0;
			} else {
				$yearStart = ((int) substr($dates[0], 0, 4)) + 1;
				$yearEnd = (int) substr($dates[1], 0, 4);
				if ($yearEnd >= date('Y')) {
					$yearEnd--;
				}
				$years = ($yearEnd - $yearStart) + 1;
				if ($years) {
					$argsYearly = array_merge(
						$args,
						[
							'dateStart' => sprintf('%s-01-01', $yearStart),
							'dateEnd' => sprintf('%s-12-31', $yearEnd),
						]
					);
					$yearly = round($this->countByDecisions($decisions, $argsYearly) / $years);
				}
			}
			$yearlyDecisions[$key] = $yearly;
		}

		// Submissions published
		$published = -1;
		$publishedDates = $this->getQueryBuilder($args)->getPublishedDates();
		if (empty($publishedDates[0])) {
			$published = 0;
		} else {
			$yearStart = ((int) substr($publishedDates[0], 0, 4)) + 1;
			$yearEnd = (int) substr($publishedDates[1], 0, 4);
			if ($yearEnd >= date('Y')) {
				$yearEnd--;
			}
			$years = ($yearEnd - $yearStart) + 1;
			if ($years) {
				$argsPublished = array_merge(
					$args,
					[
						'dateStart' => sprintf('%s-01-01', $yearStart),
						'dateEnd' => sprintf('%s-12-31', $yearEnd),
					]
				);
				$published = round($this->countSubmissionsPublished($argsPublished) / $years);
			}
		}

		$averages = array_merge(
			['submissionsReceived' => $received],
			$yearlyDecisions,
			['submissionsPublished' => $published]
		);

		\HookRegistry::call('EditorialStats::averages', [&$averages, $args]);

		return $averages;
	}

	/**
	 * Get a count of the number of submissions that have been received
	 *
	 * Any date restrictions will be applied to the submission date, so it
	 * will only count submissions completed within the date range.
	 *
	 * @param array $args See self::getQueryBuilder()
	 * @return int
	 */
	public function countSubmissionsReceived($args = []) {
		return $this->getQueryBuilder($args)->countSubmissionsReceived();
	}


	/**
	 * Get a count of the number of submissions that have been published
	 *
	 * Any date restrictions will be applied to the initial publication date,
	 * so it will only count submissions published within the date range.
	 *
	 * @param array $args See self::getQueryBuilder()
	 * @return int
	 */
	public function countSubmissionsPublished($args = []) {
		return $this->getQueryBuilder($args)->countPublished();
	}

	/**
	 * Get a count of the submissions receiving one or more editorial decisions
	 *
	 * Any date restrictions will be applied to the decision, so it will only
	 * count decisions that occurred within the date range.
	 *
	 * @param int|array $decisions One or more SUBMISSION_EDITOR_DECISION_*
	 * @param array $args See self::getQueryBuilder()
	 * @return int
	 */
	public function countByDecisions($decisions, $args = []) {
		return $this->getQueryBuilder($args)->countByDecisions((array) $decisions);
	}

	/**
	 * Get a count of the submissions receiving one or more editorial decisions
	 *
	 * Any date restrictions will be applied to the submission date, so it will
	 * only count submissions made within the date range which eventually received
	 * one of the decisions.
	 *
	 * @param int|array $decisions One or more SUBMISSION_EDITOR_DECISION_*
	 * @param array $args See self::getQueryBuilder()
	 * @return int
	 */
	public function countByDecisionsForSubmittedDate($decisions, $args = []) {
		return $this->getQueryBuilder($args)->countByDecisions((array) $decisions, true);
	}

	/**
	 * Get a count of the submissions with one or more statuses
	 *
	 * Date restrictions will not be applied. It will return the count of
	 * all submissions with the passed statuses.
	 *
	 * @param int|array $statuses One or more STATUS_*
	 * @param array $args See self::getQueryBuilder()
	 * @return int
	 */
	public function countByStatus($statuses, $args = []) {
		return $this->getQueryBuilder($args)->countByStatus((array) $statuses);
	}

	/**
	 * Get a count of the active submissions in one or more stages
	 *
	 * Date restrictions will not be applied. It will return the count of
	 * all submissions with the passed statuses.
	 *
	 * @param int|array $stages One or more WORKFLOW_STAGE_ID_*
	 * @param array $args See self::getQueryBuilder()
	 * @return int
	 */
	public function countActiveByStages($stages, $args = []) {
		return $this->getQueryBuilder($args)->countActiveByStages((array) $stages);
	}

	/**
	 * Get the number of days it took for each submission to reach
	 * one or more editorial decisions
	 *
	 * Any date restrictions will be applied to the submission date, so it will
	 * only return the days to a decision for submissions that were made within
	 * the selected date range.
	 *
	 * @param int|array $decisions One or more SUBMISSION_EDITOR_DECISION_*
	 * @param array $args See self::getQueryBuilder()
	 * @return array
	 */
	public function getDaysToDecisions($decisions, $args = []) {
		return $this->getQueryBuilder($args)->getDaysToDecisions((array) $decisions);
	}

	/**
	 * Get the average number of days to reach one or more editorial decisions
	 *
	 * Any date restrictions will be applied to the submission date, so it will
	 * only average the days to a decision for submissions that were made within
	 * the selected date range.
	 *
	 * @param int|array $decisions One or more SUBMISSION_EDITOR_DECISION_*
	 * @param array $args See self::getQueryBuilder()
	 * @return int
	 */
	public function getAverageDaysToDecisions($decisions, $args = []) {
		return ceil($this->getQueryBuilder($args)->getAverageDaysToDecisions((array) $decisions));
	}

	/**
	 * A helper function to calculate the number of days it took reach an
	 * editorial decision on a given portion of submission decisions
	 *
	 * This can be used to answer questions like how many days it took for
	 * a decision to be reached in 80% of submissions.
	 *
	 * For example, if passed an array of [5, 8, 10, 20] and a percentage of
	 * .75, it would return 10 since 75% of the array values are 10 or less.
	 *
	 * @param array $days An array of integers representing the dataset of
	 *  days to reach a decision.
	 * @param float $percentage The percentage of the dataset that must be
	 *  included in the rate. 75% = 0.75
	 * @return int The number of days X% of submissions received the decision
	 */
	public function calculateDaysToDecisionRate($days, $percentage) {
		sort($days);
		$arrayPart = array_slice($days, 0, ceil(count($days) * $percentage));
		return end($arrayPart) ?? 0;
	}

	/**
	 * Get a QueryBuilder object with the passed args
	 *
	 * @param array $args [
	 * 		@option string dateStart
	 *  	@option string dateEnd
	 *  	@option array|int contextIds
	 *    @option array|int sectionIds (will match seriesId in OMP)
	 * ]
	 * @return \APP\Services\QueryBuilders\StatsEditorialQueryBuilder
	 */
	protected function getQueryBuilder($args = []) {
		$qb = new \APP\Services\QueryBuilders\StatsEditorialQueryBuilder();

		if (!empty($args['dateStart'])) {
			$qb->after($args['dateStart']);
		}
		if (!empty($args['dateEnd'])) {
			$qb->before($args['dateEnd']);
		}
		if (!empty($args['contextIds'])) {
			$qb->filterByContexts($args['contextIds']);
		}

		\HookRegistry::call('Stats::editorial::queryBuilder', array(&$qb, $args));

		return $qb;
	}
}