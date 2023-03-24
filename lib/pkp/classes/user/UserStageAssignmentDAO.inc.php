<?php

/**
 * @file classes/user/UserStageAssignmentDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UserStageAssignmentDAO
 * @ingroup user
 * @see User, StageAssignment, and UserDAO
 *
 * @brief Operations for users as related to their stage assignments
 */

import('lib.pkp.classes.user.UserDAO');
class UserStageAssignmentDAO extends UserDAO {

	/**
	 * Retrieve a set of users not assigned to a given submission stage as a user group
	 * @param $submissionId int
	 * @param $stageId int
	 * @param $userGroupId int
	 * @return object DAOResultFactory
	 */
	function getUsersNotAssignedToStageInUserGroup($submissionId, $stageId, $userGroupId) {
		$result = $this->retrieve(
			'SELECT	u.*
			FROM	users u
				LEFT JOIN user_user_groups uug ON (u.user_id = uug.user_id)
				LEFT JOIN stage_assignments s ON (s.user_id = uug.user_id AND s.user_group_id = uug.user_group_id AND s.submission_id = ?)
				JOIN user_group_stage ugs ON (uug.user_group_id = ugs.user_group_id AND ugs.stage_id = ?)
			WHERE	uug.user_group_id = ? AND
				s.user_group_id IS NULL',
			[(int) $submissionId, (int) $stageId, (int) $userGroupId]
		);

		return new DAOResultFactory($result, $this, '_returnUserFromRowWithData');
	}

	/**
	 * Retrieve StageAssignments by submission and stage IDs.
	 * @param $submissionId int
	 * @param $stageId int (optional)
	 * @param $userGroupId int (optional)
	 * @param $roleId int (optional)
	 * @param $userId int (optional)
	 * @return DAOResultFactory StageAssignment
	 */
	function getUsersBySubmissionAndStageId($submissionId, $stageId = null, $userGroupId = null, $roleId = null, $userId = null) {
		$params = [(int) $submissionId];
		if (isset($stageId)) $params[] = (int) $stageId;
		if (isset($userGroupId)) $params[] = (int) $userGroupId;
		if (isset($userId)) $params[] = (int) $userId;
		if (isset($roleId)) $params[] = (int) $roleId;

		$result = $this->retrieve(
			'SELECT u.*
			FROM stage_assignments sa
			INNER JOIN user_group_stage ugs ON (sa.user_group_id = ugs.user_group_id)
			INNER JOIN users u ON (u.user_id = sa.user_id) ' .
			(isset($roleId) ? 'INNER JOIN user_groups ug ON (ug.user_group_id = sa.user_group_id) ' : '') .
			'WHERE submission_id = ?' .
			(isset($stageId) ? ' AND ugs.stage_id = ?' : '') .
			(isset($userGroupId) ? ' AND sa.user_group_id = ?':'') .
			(isset($userId)?' AND u.user_id = ? ' : '') .
			(isset($roleId)?' AND ug.role_id = ?' : ''),
			$params
		);

		return new DAOResultFactory($result, $this, '_returnUserFromRowWithData');
	}

	/**
	 * Delete a stage assignment by Id.
	 * @param  $assignmentId
	 * @return bool
	 */
	function deleteAssignment($assignmentId) {
		return $this->update('DELETE FROM stage_assignments WHERE stage_assignment_id = ?', [(int) $assignmentId]);
	}

	/**
	 * Retrieve a set of users of a user group not assigned to a given submission stage and matching the specified settings.
	 * @param $submissionId int
	 * @param $stageId int
	 * @param $userGroupId int
	 * @param $name string|null Partial string match with user name
	 * @param $rangeInfo|null object The desired range of results to return
	 * @return object DAOResultFactory
	 */
	function filterUsersNotAssignedToStageInUserGroup($submissionId, $stageId, $userGroupId, $name = null, $rangeInfo = null) {
		$site = Application::get()->getRequest()->getSite();
		$primaryLocale = $site->getPrimaryLocale();
		$locale = AppLocale::getLocale();
		$params = [
			(int) $submissionId,
			(int) $stageId,
			IDENTITY_SETTING_GIVENNAME, $primaryLocale,
			IDENTITY_SETTING_FAMILYNAME, $primaryLocale,
			IDENTITY_SETTING_GIVENNAME, $locale,
			IDENTITY_SETTING_FAMILYNAME, $locale,
			(int) $userGroupId,
		];
		if ($name !== null) {
			$params = array_merge($params, array_fill(0, 6, '%'.(string) $name.'%'));
		}
		$result = $this->retrieveRange(
			$sql = 'SELECT	u.*
			FROM	users u
				LEFT JOIN user_user_groups uug ON (u.user_id = uug.user_id)
				LEFT JOIN stage_assignments s ON (s.user_id = uug.user_id AND s.user_group_id = uug.user_group_id AND s.submission_id = ?)
				JOIN user_group_stage ugs ON (uug.user_group_id = ugs.user_group_id AND ugs.stage_id = ?)
				LEFT JOIN user_settings usgs_pl ON (usgs_pl.user_id = u.user_id AND usgs_pl.setting_name = ? AND usgs_pl.locale = ?)
				LEFT JOIN user_settings usfs_pl ON (usfs_pl.user_id = u.user_id AND usfs_pl.setting_name = ? AND usfs_pl.locale = ?)
				LEFT JOIN user_settings usgs_l ON (usgs_l.user_id = u.user_id AND usgs_l.setting_name = ? AND usgs_l.locale = ?)
				LEFT JOIN user_settings usfs_l ON (usfs_l.user_id = u.user_id AND usfs_l.setting_name = ? AND usfs_l.locale = ?)

			WHERE	uug.user_group_id = ? AND
				s.user_group_id IS NULL'
				. ($name !== null ? ' AND (usgs_pl.setting_value LIKE ? OR usgs_l.setting_value LIKE ? OR usfs_pl.setting_value LIKE ? OR usfs_l.setting_value LIKE ? OR u.username LIKE ? OR u.email LIKE ?)' : '')
			. ' ORDER BY COALESCE(usfs_l.setting_value, usfs_pl.setting_value)',
				$params,
				$rangeInfo);
		return new DAOResultFactory($result, $this, '_returnUserFromRowWithData', [], $sql, $params, $rangeInfo);
	}
}

