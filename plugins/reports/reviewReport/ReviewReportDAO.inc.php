<?php

/**
 * @file plugins/reports/reviewReport/ReviewReportDAO.inc.php
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ReviewReportDAO
 * @ingroup plugins_reports_review
 * @see ReviewReportPlugin
 *
 * @brief Review report DAO
 */

import('lib.pkp.classes.submission.SubmissionComment');

class ReviewReportDAO extends DAO {
	/**
	 * Get the review report data.
	 * @param $contextId int Context ID
	 * @return array
	 */
	function getReviewReport($contextId) {
		$locale = AppLocale::getLocale();

		$commentsReturner = $this->retrieve(
			'SELECT	sc.submission_id,
				sc.comments,
				sc.author_id
			FROM	submission_comments sc
				JOIN submissions s ON (s.submission_id = sc.submission_id)
			WHERE	comment_type = ?
				AND s.context_id = ?',
			[COMMENT_TYPE_PEER_REVIEW, (int) $contextId]
		);

		$userDao = DAORegistry::getDAO('UserDAO');
		$site = Application::get()->getRequest()->getSite();
		$sitePrimaryLocale = $site->getPrimaryLocale();

		$reviewsReturner = $this->retrieve(
			'SELECT	r.stage_id AS stage_id,
				r.review_id as review_id,
				r.round AS round,
				COALESCE(asl.setting_value, aspl.setting_value) AS submission,
				a.submission_id AS submission_id,
				u.user_id AS reviewer_id,
				u.username AS reviewer,
				' . $userDao->getFetchColumns() .',
				u.email AS email,
				u.country AS country,
				us.setting_value AS orcid,
				COALESCE(uasl.setting_value, uas.setting_value) AS affiliation,
				r.date_assigned AS date_assigned,
				r.date_notified AS date_notified,
				r.date_confirmed AS date_confirmed,
				r.date_completed AS date_completed,
				r.date_acknowledged AS date_acknowledged,
				r.date_reminded AS date_reminded,
				r.date_due AS date_due,
				r.date_response_due AS date_response_due,
				(r.declined=1) AS declined,
				(r.unconsidered=1) AS unconsidered,
				r.recommendation AS recommendation
			FROM	review_assignments r
				LEFT JOIN submissions a ON r.submission_id = a.submission_id
				LEFT JOIN publications p ON a.current_publication_id = p.publication_id
				LEFT JOIN publication_settings asl ON (p.publication_id = asl.publication_id AND asl.locale = ? AND asl.setting_name = ?)
				LEFT JOIN publication_settings aspl ON (p.publication_id = aspl.publication_id AND aspl.locale = a.locale AND aspl.setting_name = ?)
				LEFT JOIN users u ON (u.user_id = r.reviewer_id)
				' . $userDao->getFetchJoins() .'
				LEFT JOIN user_settings uas ON (u.user_id = uas.user_id AND uas.setting_name = ? AND uas.locale = a.locale)
				LEFT JOIN user_settings uasl ON (u.user_id = uasl.user_id AND uasl.setting_name = ? AND uasl.locale = ?)
				LEFT JOIN user_settings us ON (u.user_id = us.user_id AND us.setting_name = ?)
			WHERE	 a.context_id = ?
			ORDER BY submission',
			array_merge(
				[
					$locale, // Submission title
					'title',
					'title',
				],
				$userDao->getFetchParameters(),
				[
					'affiliation',
					'affiliation',
					$sitePrimaryLocale,
					'orcid',
					(int) $contextId
				]
			)
		);

		import('lib.pkp.classes.user.InterestManager');
		$interestManager = new InterestManager();
		$assignedReviewerIds = $this->retrieve(
			'SELECT	r.reviewer_id
			FROM	review_assignments r
				LEFT JOIN submissions a ON r.submission_id = a.submission_id
			WHERE	 a.context_id = ?
			ORDER BY r.reviewer_id',
			[(int) $contextId]
		);
		$interests = [];
		while ($row = $assignedReviewerIds->next()) {
			if (!array_key_exists($row['reviewer_id'], $interests)) {
				$user = $userDao->getById($row['reviewer_id']);
				$reviewerInterests = $interestManager->getInterestsString($user);
				if (!empty($reviewerInterests))	$interests[$row['reviewer_id']] = $reviewerInterests;
			}
		}
		return [$commentsReturner, $reviewsReturner, $interests];
	}
}
