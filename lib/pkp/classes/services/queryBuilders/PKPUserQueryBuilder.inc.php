<?php
/**
 * @file classes/services/QueryBuilders/PKPUserQueryBuilder.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPUserQueryBuilder
 * @ingroup query_builders
 *
 * @brief Submission list Query builder
 */

namespace PKP\Services\QueryBuilders;

use Illuminate\Database\Capsule\Manager as Capsule;
use PKP\Services\QueryBuilders\Interfaces\EntityQueryBuilderInterface;

class PKPUserQueryBuilder implements EntityQueryBuilderInterface {

	/** @var int Context ID */
	protected $contextId = null;

	/** @var array list of columns for query */
	protected $columns = array();

	/** @var string order by column */
	protected $orderColumn = 'u.user_id';

	/** @var string order by direction */
	protected $orderDirection = 'DESC';

	/** @var string enabled or disabled users */
	protected $status = null;

	/** @var array list of role ids */
	protected $roleIds = null;

	/** @var array list of user group ids */
	protected $userGroupIds = null;

	/** @var array list of user ids */
	protected $userIds = [];

	/** @var int Assigned as editor to this category id */
	protected $assignedToCategoryId = null;

	/** @var int Assigned as editor to this section id */
	protected $assignedToSectionId = null;

	/** @var int submission ID */
	protected $assignedToSubmissionId = null;

	/** @var int submission stage ID */
	protected $assignedToSubmissionStageId = null;

	/** @var string get users registered after this date */
	protected $registeredAfter = '';

	/** @var string get users registered before this date */
	protected $registeredBefore = '';

	/** @var array user IDs */
	protected $includeUsers = null;

	/** @var array user IDs */
	protected $excludeUsers = null;

	/** @var string search phrase */
	protected $searchPhrase = null;

	/** @var bool whether to return reviewer activity data */
	protected $getReviewerData = null;

	/** @var int filter by review stage id */
	protected $reviewStageId = null;

	/** @var int filter by minimum reviewer rating */
	protected $reviewerRating = null;

	/** @var int|array filter by reviews completed by user */
	protected $reviewsCompleted = null;

	/** @var int|array filter by active review assignments for user */
	protected $reviewsActive = null;

	/** @var int|array filter by days since last review assignment */
	protected $daysSinceLastAssignment = null;

	/** @var int|array filter by average days to complete a review */
	protected $averageCompletion = null;

	/** @var int|null whether to limit the number of results returned */
	protected $limit = null;

	/** @var int whether to offset the number of results returned. Use to return a second page of results. */
	protected $offset = 0;

	/**
	 * Set context submissions filter
	 *
	 * @param int|string $contextId
	 *
	 * @return \APP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByContext($contextId) {
		$this->contextId = $contextId;
		return $this;
	}

	/**
	 * Set result order column and direction
	 *
	 * @param $column string
	 * @param $direction string
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function orderBy($column, $direction = 'DESC') {
		if ($column === 'givenName') {
			$this->orderColumn = 'user_given';
		} elseif ($column === 'familyName') {
			$this->orderColumn = 'user_family';
		} else {
			$this->orderColumn = 'u.user_id';
		}
		$this->orderDirection = $direction;
		return $this;
	}

	/**
	 * Set status filter
	 *
	 * @param $status string
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByStatus($status) {
		$this->status = $status;
		return $this;
	}

	/**
	 * Set roles filter
	 *
	 * @param $roleIds int|array
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByRoleIds($roleIds) {
		if (!is_null($roleIds) && !is_array($roleIds)) {
			$roleIds = array($roleIds);
		}
		$this->roleIds = $roleIds;
		return $this;
	}

	/**
	 * Set user groups filter
	 *
	 * @param array $userGroupIds
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByUserGroupIds(array $userGroupIds) {
		$this->userGroupIds = $userGroupIds;
		return $this;
	}

	/**
	 * Set user ID filter
	 *
	 * @param array $userIds
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByUserIds(array $userIds) {
		$this->userIds = $userIds;
		return $this;
	}

	/**
	 * Limit results to users assigned as editors to this category
	 *
	 * @param $categoryId int
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function assignedToCategory($categoryId) {
		$this->assignedToCategoryId = $categoryId;
		return $this;
	}

	/**
	 * Limit results to users assigned as editors to this section
	 *
	 * @param $sectionId int
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function assignedToSection($sectionId) {
		$this->assignedToSectionId = $sectionId;
		return $this;
	}

	/**
	 * Limit results to users assigned to this submission
	 *
	 * @param $submissionId int
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function assignedToSubmission($submissionId, $submissionStage) {
		$this->assignedToSubmissionId = $submissionId;
		if ($submissionStage && $this->assignedToSubmissionId) {
			$this->assignedToSubmissionStageId = $submissionStage;
		}
		return $this;
	}

	/**
	 * Limit results to users who registered after this date
	 *
	 * @param $date string
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function registeredAfter($date) {
		$this->registeredAfter = $date;
		return $this;
	}

	/**
	 * Limit results to users who registered before this date
	 *
	 * @param $date string
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function registeredBefore($date) {
		$this->registeredBefore = $date;
		return $this;
	}

	/**
	 * Include selected users
	 *
	 * This will include a user even if they do not match
	 * the query conditions.
	 *
	 * @param $userIds array
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function includeUsers($userIds) {
		$this->includeUsers = $userIds;
		return $this;
	}

	/**
	 * Exclude selected users
	 *
	 * This will exclude a user even if they match all of the
	 * query conditions.
	 *
	 * @param $userIds array
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function excludeUsers($userIds) {
		$this->excludeUsers = $userIds;
		return $this;
	}

	/**
	 * Set query search phrase
	 *
	 * @param $phrase string
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function searchPhrase($phrase) {
		$this->searchPhrase = $phrase;
		return $this;
	}

	/**
	 * Whether to return reviewer activity data
	 *
	 * @param $enable bool
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function getReviewerData($enable = true) {
		$this->getReviewerData = $enable;
		return $this;
	}

	/**
	 * Limit results to reviewers for a particular stage
	 *
	 * @param $reviewStageId int WORKFLOW_STAGE_ID_*_REVIEW
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByReviewStage($reviewStageId = null) {
		if (!is_null($reviewStageId)) {
			$this->reviewStageId = $reviewStageId;
		}

		return $this;
	}

	/**
	 * Limit results to those who have a minimum reviewer rating
	 *
	 * @param $reviewerRating int
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByReviewerRating($reviewerRating = null) {
		if (!is_null($reviewerRating)) {
			$this->reviewerRating = $reviewerRating;
		}

		return $this;
	}

	/**
	 * Limit results to those who have completed at least this many reviews
	 *
	 * @param $reviewsCompleted int|array
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByReviewsCompleted($reviewsCompleted = null) {
		if (!is_null($reviewsCompleted)) {
			$this->reviewsCompleted = $reviewsCompleted;
		}

		return $this;
	}

	/**
	 * Limit results to those who have at least this many active review assignments
	 *
	 * @param $reviewsActive int|array
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByReviewsActive($reviewsActive = null) {
		if (!is_null($reviewsActive)) {
			$this->reviewsActive = $reviewsActive;
		}

		return $this;
	}

	/**
	 * Limit results to those who's last review assignment was at least this many
	 * days ago.
	 *
	 * @param $daysSinceLastAssignment int|array
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByDaysSinceLastAssignment($daysSinceLastAssignment = null) {
		if (!is_null($daysSinceLastAssignment)) {
			$this->daysSinceLastAssignment = $daysSinceLastAssignment;
		}

		return $this;
	}

	/**
	 * Limit results to those who complete a review on average less than this many
	 * days after their assignment.
	 *
	 * @param $averageCompletion int|array
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function filterByAverageCompletion($averageCompletion = null) {
		if (!is_null($averageCompletion)) {
			$this->averageCompletion = $averageCompletion;
		}

		return $this;
	}

	/**
	 * Set query limit
	 *
	 * @param int $count
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function limitTo($count) {
		$this->limit = $count;
		return $this;
	}

	/**
	 * Set how many results to skip
	 *
	 * @param int $offset
	 *
	 * @return \PKP\Services\QueryBuilders\PKPUserQueryBuilder
	 */
	public function offsetBy($offset) {
		$this->offset = $offset;
		return $this;
	}

	/**
	 * @copydoc PKP\Services\QueryBuilders\Interfaces\EntityQueryBuilderInterface::getCount()
	 */
	public function getCount() {
		$q = $this->getQuery();
		// Reset the groupBy and orderBy
		$q->groups = ['u.user_id'];
		$q->orders = [];
		return $q->select('u.user_id')
			->get()
			->count();
	}

	/**
	 * @copydoc PKP\Services\QueryBuilders\Interfaces\EntityQueryBuilderInterface::getIds()
	 */
	public function getIds() {
		$q = $this->getQuery();
		// Reset the groupBy and orderBy
		$q->groups = ['u.user_id'];
		$q->orders = [];
		return $q->select('u.user_id')
			->pluck('u.user_id')
			->toArray();
	}

	/**
	 * Execute query builder
	 *
	 * @return object Query object
	 */
	public function getQuery() {
		$locale = \AppLocale::getLocale();
		// the users register for the site, thus
		// the site primary locale should be the default locale
		$site = \Application::get()->getRequest()->getSite();
		$primaryLocale = $site->getPrimaryLocale();

		$this->columns = ['u.*'];
		$this->columns[] = Capsule::raw('COALESCE(ugl.setting_value, ugpl.setting_value) AS user_given');
		$this->columns[] = Capsule::raw('CASE WHEN ugl.setting_value <> \'\' THEN ufl.setting_value ELSE ufpl.setting_value END AS user_family');
		$q = Capsule::table('users as u')
			->leftJoin('user_user_groups as uug', 'uug.user_id', '=', 'u.user_id')
			->leftJoin('user_groups as ug', 'ug.user_group_id', '=', 'uug.user_group_id')
			->leftJoin('user_settings as ugl', function ($join) use ($locale) {
				$join->on('ugl.user_id', '=', 'u.user_id')
					->where('ugl.setting_name', '=', IDENTITY_SETTING_GIVENNAME)
					->where('ugl.locale', '=', $locale);
			})
			->leftJoin('user_settings as ugpl', function ($join) use ($primaryLocale) {
				$join->on('ugpl.user_id', '=', 'u.user_id')
					->where('ugpl.setting_name', '=', IDENTITY_SETTING_GIVENNAME)
					->where('ugpl.locale', '=', $primaryLocale);
			})
			->leftJoin('user_settings as ufl', function ($join) use ($locale) {
				$join->on('ufl.user_id', '=', 'u.user_id')
					->where('ufl.setting_name', '=', IDENTITY_SETTING_FAMILYNAME)
					->where('ufl.locale', '=', $locale);
			})
			->leftJoin('user_settings as ufpl', function ($join) use ($primaryLocale) {
				$join->on('ufpl.user_id', '=', 'u.user_id')
					->where('ufpl.setting_name', '=', IDENTITY_SETTING_FAMILYNAME)
					->where('ufpl.locale', '=', $primaryLocale);
			});

		// context
		// Never permit a query without a context_id clause unless the CONTEXT_ID_ALL wildcard
		// has been set explicitely.
		if (is_null($this->contextId)) {
			$q->where('ug.context_id', '=', CONTEXT_ID_NONE);
		} elseif ($this->contextId !== CONTEXT_ID_ALL) {
			$q->where('ug.context_id', '=' , $this->contextId);
		}

		// roles
		if (!is_null($this->roleIds)) {
			$q->whereIn('ug.role_id', $this->roleIds);
		}

		// user groups
		if (!empty($this->userGroupIds)) {
			$q->whereIn('ug.user_group_id', $this->userGroupIds);
		}

		// user ids
		if (!empty($this->userIds)) {
			$q->whereIn('u.user_id', $this->userIds);
		}

		// Exclude users
		if (!is_null($this->excludeUsers)) {
			$excludeUsers = $this->excludeUsers;
			$q->whereNotIn('u.user_id', $excludeUsers);
		}
		// status
		if (!is_null($this->status)) {
			if ($this->status === 'disabled') {
				$q->where('u.disabled', '=', 1);
			} elseif ($this->status === 'active') {
				$q->where('u.disabled', '=', 0);
			}
		}

		// assigned to submission
		if (!is_null($this->assignedToSubmissionId)) {
			$submissionId = $this->assignedToSubmissionId;

			$q->leftJoin('stage_assignments as sa', function($table) use ($submissionId) {
				$table->on('u.user_id', '=', 'sa.user_id');
				$table->on('sa.submission_id', '=', Capsule::raw((int) $submissionId));
			});

			$q->whereNotNull('sa.stage_assignment_id');

			if (!is_null($this->assignedToSubmissionStageId)) {
				$stageId = $this->assignedToSubmissionStageId;

				$q->leftJoin('user_group_stage as ugs', 'sa.user_group_id', '=', 'ugs.user_group_id');
				$q->where('ugs.stage_id', '=', Capsule::raw((int) $stageId));
			}
		}

		// date registered
		if (!empty($this->registeredAfter)) {
			$q->where('u.date_registered', '>=', $this->registeredAfter);
		}
		if (!empty($this->registeredBefore)) {
			// Include useres who registered up to the end of the day
			$dateTime = new \DateTime($this->registeredBefore);
			$dateTime->add(new \DateInterval('P1D'));
			$q->where('u.date_registered', '<', $dateTime->format('Y-m-d'));
		}

		// review stage id
		if (!is_null($this->reviewStageId)) {
			$q->leftJoin('user_group_stage as ugs', 'uug.user_group_id', '=', 'ugs.user_group_id');
			$q->where('ugs.stage_id', '=', Capsule::raw((int) $this->reviewStageId));
		}

		// search phrase
		if (!empty($this->searchPhrase)) {
			$words = explode(' ', $this->searchPhrase);
			if (count($words)) {
				$q->leftJoin('user_settings as us', 'u.user_id', '=', 'us.user_id');
				$q->leftJoin('user_interests as ui', 'u.user_id', '=', 'ui.user_id');
				$q->leftJoin('controlled_vocab_entry_settings as cves', 'ui.controlled_vocab_entry_id', '=', 'cves.controlled_vocab_entry_id');
				foreach ($words as $word) {
					$word = strtolower(addcslashes($word, '%_'));
					$q->where(function($q) use ($word) {
						$q->where(Capsule::raw('lower(u.username)'), 'LIKE', "%{$word}%")
							->orWhere(Capsule::raw('lower(u.email)'), 'LIKE', "%{$word}%")
							->orWhere(function($q) use ($word) {
								$q->where('us.setting_name', IDENTITY_SETTING_GIVENNAME);
								$q->where(Capsule::raw('lower(us.setting_value)'), 'LIKE', "%{$word}%");
							})
							->orWhere(function($q) use ($word) {
								$q->where('us.setting_name', IDENTITY_SETTING_FAMILYNAME);
								$q->where(Capsule::raw('lower(us.setting_value)'), 'LIKE', "%{$word}%");
							})
							->orWhere(function($q) use ($word) {
								$q->where('us.setting_name', 'preferredPublicName');
								$q->where(Capsule::raw('lower(us.setting_value)'), 'LIKE', "%{$word}%");
							})
							->orWhere(function($q) use ($word) {
								$q->where('us.setting_name', 'affiliation');
								$q->where(Capsule::raw('lower(us.setting_value)'), 'LIKE', "%{$word}%");
							})
							->orWhere(function($q) use ($word) {
								$q->where('us.setting_name', 'biography');
								$q->where(Capsule::raw('lower(us.setting_value)'), 'LIKE', "%{$word}%");
							})
							->orWhere(function($q) use ($word) {
								$q->where('us.setting_name', 'orcid');
								$q->where(Capsule::raw('lower(us.setting_value)'), 'LIKE', "%{$word}%");
							})
							->orWhere(Capsule::raw('lower(cves.setting_value)'), 'LIKE', "%{$word}%");
					});
				}
			}
		}

		// reviewer data
		if (!empty($this->getReviewerData)) {
			$q->leftJoin('review_assignments as ra', 'u.user_id', '=', 'ra.reviewer_id');
			$this->columns[] = Capsule::raw('MAX(ra.date_assigned) as last_assigned');
			$this->columns[] = Capsule::raw('(SELECT SUM(CASE WHEN ra.date_completed IS NULL AND ra.declined <> 1 THEN 1 ELSE 0 END) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id) as incomplete_count');
			$this->columns[] = Capsule::raw('(SELECT SUM(CASE WHEN ra.date_completed IS NOT NULL AND ra.declined <> 1 THEN 1 ELSE 0 END) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id) as complete_count');
			$this->columns[] = Capsule::raw('(SELECT SUM(CASE WHEN ra.declined = 1 THEN 1 ELSE 0 END) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id) as declined_count');
			$this->columns[] = Capsule::raw('(SELECT SUM(CASE WHEN ra.cancelled = 1 THEN 1 ELSE 0 END) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id) as cancelled_count');
			switch (\Config::getVar('database', 'driver')) {
				case 'mysql':
				case 'mysqli':
					$dateDiffClause = 'DATEDIFF(ra.date_completed, ra.date_notified)';
					break;
				default:
					$dateDiffClause = 'DATE_PART(\'day\', ra.date_completed - ra.date_notified)';
			}
			$this->columns[] = Capsule::raw('AVG(' . $dateDiffClause . ') as average_time');
			$this->columns[] = Capsule::raw('(SELECT AVG(ra.quality) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id AND ra.quality IS NOT NULL) as reviewer_rating');

			// reviewer rating
			if (!empty($this->reviewerRating)) {
				$q->havingRaw('(SELECT AVG(ra.quality) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id AND ra.quality IS NOT NULL) >= ' . (int) $this->reviewerRating);
			}

			// completed reviews
			if (!empty($this->reviewsCompleted)) {
				$doneMin = is_array($this->reviewsCompleted) ? $this->reviewsCompleted[0] : $this->reviewsCompleted;
				$subqueryStatement = '(SELECT SUM(CASE WHEN ra.date_completed IS NOT NULL THEN 1 ELSE 0 END) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id)';
				$q->having(Capsule::raw($subqueryStatement), '>=', $doneMin);
				if (is_array($this->reviewsCompleted) && !empty($this->reviewsCompleted[1])) {
					$q->having(Capsule::raw($subqueryStatement), '<=', $this->reviewsCompleted[1]);
				}
			}

			// active reviews
			if (!empty($this->reviewsActive)) {
				$activeMin = is_array($this->reviewsActive) ? $this->reviewsActive[0] : $this->reviewsActive;
				$subqueryStatement = '(SELECT SUM(CASE WHEN ra.date_completed IS NULL AND ra.declined <> 1 THEN 1 ELSE 0 END) FROM review_assignments AS ra WHERE u.user_id = ra.reviewer_id)';
				$q->having(Capsule::raw($subqueryStatement), '>=', $activeMin);
				if (is_array($this->reviewsActive) && !empty($this->reviewsActive[1])) {
					$q->having(Capsule::raw($subqueryStatement), '<=', $this->reviewsActive[1]);
				}
			}

			// days since last review assignment
			if (!empty($this->daysSinceLastAssignment)) {
				$daysSinceMin = is_array($this->daysSinceLastAssignment) ? $this->daysSinceLastAssignment[0] : $this->daysSinceLastAssignment;
				$userDao = \DAORegistry::getDAO('UserDAO');
				$dbTimeMin = $userDao->dateTimeToDB(time() - ((int) $daysSinceMin * 86400));
				$q->havingRaw('MAX(ra.date_assigned) <= ' . $dbTimeMin);
				if (is_array($this->daysSinceLastAssignment) && !empty($this->daysSinceLastAssignment[1])) {
					$daysSinceMax = $this->daysSinceLastAssignment[1];
					// Subtract an extra day so that our outer bound rounds "up". This accounts
					// for the UI rounding "down" in the string "X days ago".
					$dbTimeMax = $userDao->dateTimeToDB(time() - ((int) $daysSinceMax * 86400) - 84600);
					$q->havingRaw('MAX(ra.date_assigned) >= ' . $dbTimeMax);
				}
			}

			// average days to complete review
			if (!empty($this->averageCompletion)) {
				$q->havingRaw('AVG(' . $dateDiffClause . ') <= ' . (int) $this->averageCompletion);
			}
		}

		// Include users
		if (!is_null($this->includeUsers)) {
			$includeUsers = $this->includeUsers;
			$q->orWhereIn('u.user_id', $includeUsers);
		}

		// Limit and offset results for pagination
		if (!is_null($this->limit)) {
			$q->limit($this->limit);
		}
		if (!empty($this->offset)) {
			$q->offset($this->offset);
		}

		// Section assignments
		if (!is_null($this->assignedToSectionId)) {
			$sectionId = $this->assignedToSectionId;

			$q->leftJoin('subeditor_submission_group as ssg', function($table) use ($sectionId) {
				$table->on('u.user_id', '=', 'ssg.user_id');
				$table->on('ssg.assoc_type', '=', Capsule::raw((int) ASSOC_TYPE_SECTION));
				$table->on('ssg.assoc_id', '=', Capsule::raw((int) $sectionId));
			});

			$q->whereNotNull('ssg.assoc_id');
		}

		// Category assignments
		if (!is_null($this->assignedToCategoryId)) {
			$categoryId = $this->assignedToCategoryId;

			$q->leftJoin('subeditor_submission_group as ssg', function($table) use ($categoryId) {
				$table->on('u.user_id', '=', 'ssg.user_id');
				$table->on('ssg.assoc_type', '=', Capsule::raw((int) ASSOC_TYPE_CATEGORY));
				$table->on('ssg.assoc_id', '=', Capsule::raw((int) $categoryId));
			});

			$q->whereNotNull('ssg.assoc_id');
		}

		// Add app-specific query statements
		\HookRegistry::call('User::getMany::queryObject', array(&$q, $this));

		$q->select($this->columns)
			->groupBy('u.user_id', 'user_given', 'user_family')
			->orderBy($this->orderColumn, $this->orderDirection);

		return $q;
	}
}
