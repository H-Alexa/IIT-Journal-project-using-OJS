<?php

/**
 * @file classes/issue/IssueDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class IssueDAO
 * @ingroup issue
 * @see Issue
 *
 * @brief Operations for retrieving and modifying Issue objects.
 */

import('classes.issue.Issue');
import('lib.pkp.classes.submission.PKPSubmission'); // STATUS_... constants
import('lib.pkp.classes.plugins.PKPPubIdPluginDAO');

use Illuminate\Database\Capsule\Manager as Capsule;

class IssueDAO extends DAO implements PKPPubIdPluginDAO {
	var $caches;

	/**
	 * Handle a cache miss.
	 * @param $cache GenericCache
	 * @param $id string
	 * @return Issue
	 */
	function _cacheMiss($cache, $id) {
		if ($cache->getCacheId() === 'current') {
			$issue = $this->getCurrent($id, false);
		} else {
			$issue = $this->getByBestId($id, null, false);
		}
		$cache->setCache($id, $issue);
		return $issue;
	}

	/**
	 * Get an issue cache by cache ID.
	 * @param $cacheId string
	 * @return GenericCache
	 */
	function _getCache($cacheId) {
		if (!isset($this->caches)) $this->caches = array();
		if (!isset($this->caches[$cacheId])) {
			$cacheManager = CacheManager::getManager();
			$this->caches[$cacheId] = $cacheManager->getObjectCache('issues', $cacheId, array($this, '_cacheMiss'));
		}
		return $this->caches[$cacheId];
	}

	/**
	 * Retrieve Issue by issue id
	 * @param $issueId int
	 * @param $journalId int optional
	 * @param $useCache boolean optional
	 * @return Issue?
	 */
	function getById($issueId, $journalId = null, $useCache = false) {
		if ($useCache) {
			$cache = $this->_getCache('issues');
			$returner = $cache->get($issueId);
			if ($returner && $journalId != null && $journalId != $returner->getJournalId()) $returner = null;
			return $returner;
		}

		$params = [(int) $issueId];
		if ($journalId) $params[] = (int) $journalId;
		$result = $this->retrieve(
			'SELECT i.* FROM issues i WHERE issue_id = ?'
			. ($journalId?' AND journal_id = ?':''),
			$params
		);

		$row = $result->current();
		return $row ? $this->_returnIssueFromRow((array) $row) : null;
	}

	/**
	 * Retrieve Issue by public issue id
	 * @param $pubIdType string One of the NLM pub-id-type values or
	 * 'other::something' if not part of the official NLM list
	 * (see <http://dtd.nlm.nih.gov/publishing/tag-library/n-4zh0.html>).
	 * @param $pubId string
	 * @param $journalId int optional
	 * @param $useCache boolean optional
	 * @return Issue object
	 */
	function getByPubId($pubIdType, $pubId, $journalId = null, $useCache = false) {
		if ($useCache && $pubIdType == 'publisher-id') {
			$cache = $this->_getCache('issues');
			$returner = $cache->get($pubId);
			if ($returner && $journalId != null && $journalId != $returner->getJournalId()) $returner = null;
			return $returner;
		}

		$issues = $this->getBySetting('pub-id::'.$pubIdType, $pubId, $journalId);
		if (empty($issues)) {
			return null;
		} else {
			assert(count($issues) == 1);
			return $issues[0];
		}
	}

	/**
	 * Find issues by querying issue settings.
	 * @param $settingName string
	 * @param $settingValue mixed
	 * @param $journalId int optional
	 * @return array The issues identified by setting.
	 */
	function getBySetting($settingName, $settingValue, $journalId = null) {
		$params = array($settingName);
		$sql = 'SELECT	i.*
			FROM	issues i ';
		if (is_null($settingValue)) {
			$sql .= 'LEFT JOIN issue_settings ist ON i.issue_id = ist.issue_id AND ist.setting_name = ?
				WHERE	(ist.setting_value IS NULL OR ist.setting_value = \'\')';
		} else {
			$params[] = (string) $settingValue;
			$sql .= 'INNER JOIN issue_settings ist ON i.issue_id = ist.issue_id
				WHERE	ist.setting_name = ? AND ist.setting_value = ?';
		}
		if ($journalId) {
			$params[] = (int) $journalId;
			$sql .= ' AND i.journal_id = ?';
		}
		$sql .= ' ORDER BY i.issue_id';
		$result = $this->retrieve($sql, $params);

		$issues = array();
		foreach ($result as $row) {
			$issues[] = $this->_returnIssueFromRow((array) $row);
		}
		return $issues;
	}

	/**
	 * Retrieve Issue by some combination of volume, number, and year
	 * @param $journalId int
	 * @param $volume int
	 * @param $number int
	 * @param $year int
	 * @return DAOResultFactory object
	 */
	function getPublishedIssuesByNumber($journalId, $volume = null, $number = null, $year = null) {
		$sql = 'SELECT i.* FROM issues i WHERE i.published = 1 AND i.journal_id = ?';
		$params = array((int) $journalId);

		if ($volume !== null) {
			$sql .= ' AND i.volume = ?';
			$params[] = (int) $volume;
		}
		if ($number !== null) {
			$sql .= ' AND i.number = ?';
			$params[] = $number;
		}
		if ($year !== null) {
			$sql .= ' AND i.year = ?';
			$params[] = $year;
		}

		$result = $this->retrieve($sql, $params);
		return new DAOResultFactory($result, $this, '_returnIssueFromRow');
	}

	/**
	 * Retrieve Issues by identification
	 * @param $journalId int
	 * @param $volume int
	 * @param $number string
	 * @param $year int
	 * @param $titles array
	 * @return DAOResultFactory
	 */
	function getIssuesByIdentification($journalId, $volume = null, $number = null, $year = null, $titles = array()) {
		$params = [];

		$i = 1;
		$sqlTitleJoin = '';
		foreach ($titles as $title) {
			$sqlTitleJoin .= ' JOIN issue_settings iss' .$i .' ON (i.issue_id = iss' .$i .'.issue_id AND iss' .$i .'.setting_name = \'title\' AND iss' .$i .'.setting_value = ?)';
			$params[] = $title;
			$i++;
		}
		$params[] = (int) $journalId;
		if ($volume !== null) {
			$params[] = (int) $volume;
		}
		if ($number !== null) {
			$params[] = $number;
		}
		if ($year !== null) {
			$params[] = (int) $year;
		}

		$result = $this->retrieve(
			'SELECT i.*
			FROM issues i'
			.$sqlTitleJoin
			.' WHERE i.journal_id = ?'
			.(($volume !== null)?' AND i.volume = ?':'')
			.(($number !== null)?' AND i.number = ?':'')
			.(($year !== null)?' AND i.year = ?':''),
			$params
		);
		return new DAOResultFactory($result, $this, '_returnIssueFromRow');
	}

	/**
	 * Retrieve Issue by "best" issue id -- urlPath if it exists,
	 * falling back on the internal issue ID otherwise.
	 * @param $issueId string
	 * @param $contextId int optional
	 * @param $useCache boolean optional
	 * @return Issue object
	 */
	function getByBestId($issueId, $contextId = null, $useCache = false) {
		$params = [$issueId];
		if ($contextId) $params[] = (int) $contextId;

		$result = $this->retrieve(
			'SELECT i.* FROM issues i WHERE url_path = ?'
			. ($contextId?' AND journal_id = ?':''),
			$params
		);

		if ($row = (array) $result->current()) {
			$issue = $this->_returnIssueFromRow($row);
		} elseif (is_int($issueId) || ctype_digit($issueId)) {
			$issue = $this->getById($issueId, $contextId);
		}

		return $issue ?? null;
	}

	/**
	 * Retrieve current issue
	 * @param $journalId int
	 * @param $useCache boolean optional
	 * @return Issue?
	 */
	function getCurrent($journalId, $useCache = false) {
		if ($useCache) {
			$cache = $this->_getCache('current');
			return $cache->get($journalId);
		}

		$result = $this->retrieve(
			'SELECT i.* FROM issues i WHERE journal_id = ? AND current = 1', [(int) $journalId]
		);

		$row = (array) $result->current();
		return $row?$this->_returnIssueFromRow($row):null;
	}

	/**
	 * update current issue
	 * @return Issue object
	 */
	function updateCurrent($journalId, $issue = null) {
		$this->update(
			'UPDATE issues SET current = 0 WHERE journal_id = ? AND current = 1', [(int) $journalId]
		);
		if ($issue) $this->updateObject($issue);

		$this->flushCache();
	}


	/**
	 * Construct a new data object.
	 * @return Issue
	 */
	function newDataObject() {
		return new Issue();
	}

	/**
	 * creates and returns an issue object from a row
	 * @param $row array
	 * @return Issue object
	 */
	function _fromRow($row) {
		$issue = $this->newDataObject();
		$issue->setId($row['issue_id']);
		$issue->setJournalId($row['journal_id']);
		$issue->setVolume($row['volume']);
		$issue->setNumber($row['number']);
		$issue->setYear($row['year']);
		$issue->setPublished($row['published']);
		$issue->setCurrent($row['current']);
		$issue->setDatePublished($this->datetimeFromDB($row['date_published']));
		$issue->setDateNotified($this->datetimeFromDB($row['date_notified']));
		$issue->setLastModified($this->datetimeFromDB($row['last_modified']));
		$issue->setAccessStatus($row['access_status']);
		$issue->setOpenAccessDate($this->datetimeFromDB($row['open_access_date']));
		$issue->setShowVolume($row['show_volume']);
		$issue->setShowNumber($row['show_number']);
		$issue->setShowYear($row['show_year']);
		$issue->setShowTitle($row['show_title']);
		$issue->setData('urlPath', $row['url_path']);

		$this->getDataObjectSettings('issue_settings', 'issue_id', $row['issue_id'], $issue);

		HookRegistry::call('IssueDAO::_fromRow', array(&$issue, &$row));

		return $issue;
	}

	/**
	 * @copydoc self::_fromRow()
	 * @deprecated 2018-01-05
	 */
	function _returnIssueFromRow($row) {
		$issue = self::_fromRow($row);
		HookRegistry::call('IssueDAO::_returnIssueFromRow', array(&$issue, &$row));
		return $issue;
	}

	/**
	 * Get a list of fields for which localized data is supported
	 * @return array
	 */
	function getLocaleFieldNames() {
		return array('title', 'description', 'coverImageAltText', 'coverImage');
	}

	/**
	 * Get a list of additional fields that do not have
	 * dedicated accessors.
	 * @return array
	 */
	function getAdditionalFieldNames() {
		$additionalFields = parent::getAdditionalFieldNames();
		// FIXME: Move this to a PID plug-in.
		$additionalFields[] = 'pub-id::publisher-id';
		return $additionalFields;
	}

	/**
	 * Update the localized fields for this object.
	 * @param $issue
	 */
	function updateLocaleFields(&$issue) {
		$this->updateDataObjectSettings('issue_settings', $issue, array(
			'issue_id' => $issue->getId()
		));
	}

	/**
	 * inserts a new issue into issues table
	 * @param Issue object
	 * @return Issue Id int
	 */
	function insertObject($issue) {
		$this->update(
			sprintf('INSERT INTO issues
				(journal_id, volume, number, year, published, current, date_published, date_notified, last_modified, access_status, open_access_date, show_volume, show_number, show_year, show_title, url_path)
				VALUES
				(?, ?, ?, ?, ?, ?, %s, %s, %s, ?, %s, ?, ?, ?, ?, ?)',
				$this->datetimeToDB($issue->getDatePublished()), $this->datetimeToDB($issue->getDateNotified()), $this->datetimeToDB($issue->getLastModified()), $this->datetimeToDB($issue->getOpenAccessDate())),
			array(
				(int) $issue->getJournalId(),
				$this->nullOrInt($issue->getVolume()),
				$issue->getNumber(),
				$this->nullOrInt($issue->getYear()),
				(int) $issue->getPublished(),
				(int) $issue->getCurrent(),
				(int) $issue->getAccessStatus(),
				(int) $issue->getShowVolume(),
				(int) $issue->getShowNumber(),
				(int) $issue->getShowYear(),
				(int) $issue->getShowTitle(),
				$issue->getData('urlPath'),
			)
		);

		$issue->setId($this->getInsertId());

		$this->updateLocaleFields($issue);

		$this->resequenceCustomIssueOrders($issue->getJournalId());

		return $issue->getId();
	}

	/**
	 * Get the ID of the last inserted issue.
	 * @return int
	 */
	function getInsertId() {
		return $this->_getInsertId('issues', 'issue_id');
	}

	/**
	 * Check if volume, number and year have already been issued
	 * @param $journalId int
	 * @param $volume int
	 * @param $number int
	 * @param $year int
	 * @param $issueId int Issue ID to exclude from results
	 * @return boolean
	 */
	function issueExists($journalId, $volume, $number, $year, $issueId) {
		$result = $this->retrieve(
			'SELECT i.* FROM issues i WHERE journal_id = ? AND volume = ? AND number = ? AND year = ? AND issue_id <> ?',
			array((int) $journalId, $this->nullOrInt($volume), $number, $year, (int) $issueId)
		);
		return (boolean) $result->current();
	}

	/**
	 * updates an issue
	 * @param Issue object
	 */
	function updateObject($issue) {
		$issue->stampModified();
		$this->update(
			sprintf('UPDATE issues
				SET
					journal_id = ?,
					volume = ?,
					number = ?,
					year = ?,
					published = ?,
					current = ?,
					date_published = %s,
					date_notified = %s,
					last_modified = %s,
					open_access_date = %s,
					access_status = ?,
					show_volume = ?,
					show_number = ?,
					show_year = ?,
					show_title = ?,
					url_path = ?
				WHERE issue_id = ?',
			$this->datetimeToDB($issue->getDatePublished()), $this->datetimeToDB($issue->getDateNotified()), $this->datetimeToDB($issue->getLastModified()), $this->datetimeToDB($issue->getOpenAccessDate())),
			array(
				(int) $issue->getJournalId(),
				$this->nullOrInt($issue->getVolume()),
				$issue->getNumber(),
				$this->nullOrInt($issue->getYear()),
				(int) $issue->getPublished(),
				(int) $issue->getCurrent(),
				(int) $issue->getAccessStatus(),
				(int) $issue->getShowVolume(),
				(int) $issue->getShowNumber(),
				(int) $issue->getShowYear(),
				(int) $issue->getShowTitle(),
				$issue->getData('urlPath'),
				(int) $issue->getId(),
			)
		);

		$this->updateLocaleFields($issue);

		$this->resequenceCustomIssueOrders($issue->getJournalId());

		$this->flushCache();
	}

	/**
	 * Delete issue. Deletes associated issue galleys, cover pages, and published submissions.
	 * @param $issue object issue
	 */
	function deleteObject($issue) {
		import('classes.file.PublicFileManager');
		$publicFileManager = new PublicFileManager();

		if (is_array($issue->getCoverImage(null))) {
			foreach ($issue->getCoverImage(null) as $coverImage) {
				if ($coverImage != '') {
					$publicFileManager->removeContextFile($issue->getJournalId(), $coverImage);
				}
			}
		}

		$issueId = $issue->getId();

		// Delete issue-specific ordering if it exists.
		$sectionDao = DAORegistry::getDAO('SectionDAO'); /* @var $sectionDao SectionDAO */
		$sectionDao->deleteCustomSectionOrdering($issueId);

		// Delete published issue galleys and issue files
		$issueGalleyDao = DAORegistry::getDAO('IssueGalleyDAO'); /* @var $issueGalleyDao IssueGalleyDAO */
		$issueGalleyDao->deleteByIssueId($issueId);

		$issueFileDao = DAORegistry::getDAO('IssueFileDAO'); /* @var $issueFileDao IssueFileDAO */
		$issueFileDao->deleteByIssueId($issueId);

		import('classes.file.IssueFileManager');
		$issueFileManager = new IssueFileManager($issueId);
		$issueFileManager->deleteIssueTree();

		// Delete issue settings and issue
		$this->update('DELETE FROM issue_settings WHERE issue_id = ?', [(int) $issueId]);
		$this->update('DELETE FROM issues WHERE issue_id = ?', [(int) $issueId]);
		$this->update('DELETE FROM custom_issue_orders WHERE issue_id = ?', [(int) $issueId]);
		$this->resequenceCustomIssueOrders($issue->getJournalId());

		$this->flushCache();
	}

	/**
	 * Delete issues by journal id. Deletes dependent entities.
	 * @param $journalId int
	 */
	function deleteByJournalId($journalId) {
		$issues = $this->getIssues($journalId);
		while ($issue = $issues->next()) {
			$this->deleteObject($issue);
		}
	}

	/**
	 * Checks if issue exists
	 * @param $issueId int
	 * @param $journalId int
	 * @return boolean
	 */
	function issueIdExists($issueId, $journalId) {
		$result = $this->retrieve(
			'SELECT COUNT(*) AS row_count FROM issues WHERE issue_id = ? AND journal_id = ?',
			[(int) $issueId, (int) $journalId]
		);
		$row = $result->current();
		return $row ? (boolean) $row->row_count : false;
	}

	/**
	 * Get issue by article id
	 * @param articleId int
	 * @param journalId int optional
	 * @return Issue?
	 */
	function getBySubmissionId($articleId, $journalId = null) {
		$params = ['issueId', (int) $articleId];
		if ($journalId) $params[] = (int) $journalId;

		$result = $this->retrieve(
			'SELECT	i.*
			FROM	submissions s
				JOIN publications p ON (p.publication_id = s.current_publication_id)
				JOIN publication_settings ps ON (ps.publication_id = p.publication_id AND ps.setting_name = ? AND ps.locale = \'\')
				JOIN issues i ON ps.setting_value = CAST(i.issue_id AS CHAR(20))
			WHERE	s.submission_id = ? AND
				s.context_id = i.journal_id' .
				($journalId?' AND i.journal_id = ?':''),
			$params
		);

		$row = $result->current();
		return $row ? $this->_returnIssueFromRow((array) $row) : null;
	}

	/**
	 * Get all issues organized by published date
	 * @param $journalId int
	 * @param $rangeInfo object DBResultRange (optional)
	 * @return DAOResultFactory
	 */
	function getIssues($journalId, $rangeInfo = null) {
		$result = $this->retrieveRange(
			$sql = 'SELECT i.* FROM issues i WHERE journal_id = ? ORDER BY current DESC, date_published DESC',
			$params = [(int) $journalId], $rangeInfo
		);

		return new DAOResultFactory($result, $this, '_returnIssueFromRow', [], $sql, $params, $rangeInfo); // Counted in ExportableIssuesListGridHandler
	}

	/**
	 * Get published issues organized by published date
	 * @param $journalId int
	 * @param $rangeInfo object DBResultRange
	 * @return DAOResultFactory
	 */
	function getPublishedIssues($journalId, $rangeInfo = null) {
		$result = $this->retrieveRange(
			'SELECT i.* FROM issues i LEFT JOIN custom_issue_orders o ON (o.issue_id = i.issue_id) WHERE i.journal_id = ? AND i.published = 1 ORDER BY o.seq ASC, i.current DESC, i.date_published DESC',
			[(int) $journalId], $rangeInfo
		);

		return new DAOResultFactory($result, $this, '_returnIssueFromRow');
	}

	/**
	 * Get unpublished issues organized by published date
	 * @param $journalId int
	 * @param $rangeInfo object DBResultRange
	 * @return DAOResultFactory
	 */
	function getUnpublishedIssues($journalId, $rangeInfo = null) {
		$result = $this->retrieveRange(
			'SELECT i.* FROM issues i WHERE journal_id = ? AND published = 0 ORDER BY year ASC, volume ASC, number ASC',
			[(int) $journalId], $rangeInfo
		);

		return new DAOResultFactory($result, $this, '_returnIssueFromRow');
	}

	/**
	 * Get all published issues (eventually with a pubId assigned and) matching the specified settings.
	 * @param $contextId integer optional
	 * @param $pubIdType string
	 * @param $pubIdSettingName string optional
	 * (e.g. crossref::registeredDoi)
	 * @param $pubIdSettingValue string optional
	 * @param $rangeInfo DBResultRange optional
	 * @return DAOResultFactory
	 */
	function getExportable($contextId, $pubIdType = null, $pubIdSettingName = null, $pubIdSettingValue = null, $rangeInfo = null) {
		$params = [];
		if ($pubIdSettingName) $params[] = $pubIdSettingName;
		$params[] = (int) $contextId;
		if ($pubIdType) $params[] = 'pub-id::'.$pubIdType;

		import('classes.plugins.PubObjectsExportPlugin');
		if ($pubIdSettingName && $pubIdSettingValue && $pubIdSettingValue != EXPORT_STATUS_NOT_DEPOSITED) {
			$params[] = $pubIdSettingValue;
		}

		$result = $this->retrieveRange(
			$sql = 'SELECT i.*
			FROM issues i
				LEFT JOIN custom_issue_orders o ON (o.issue_id = i.issue_id)
				' . ($pubIdType != null?' LEFT JOIN issue_settings ist ON (i.issue_id = ist.issue_id)':'')
				. ($pubIdSettingName != null?' LEFT JOIN issue_settings iss ON (i.issue_id = iss.issue_id AND iss.setting_name = ?)':'') .'
			WHERE
				i.published = 1  AND i.journal_id = ?
				' . ($pubIdType != null?' AND ist.setting_name = ? AND ist.setting_value IS NOT NULL':'')
				. (($pubIdSettingName != null && $pubIdSettingValue != null && $pubIdSettingValue == EXPORT_STATUS_NOT_DEPOSITED)?' AND iss.setting_value IS NULL':'')
				. (($pubIdSettingName != null && $pubIdSettingValue != null && $pubIdSettingValue != EXPORT_STATUS_NOT_DEPOSITED)?' AND iss.setting_value = ?':'')
				. (($pubIdSettingName != null && is_null($pubIdSettingValue))?' AND (iss.setting_value IS NULL OR iss.setting_value = \'\')':'')
				.' ORDER BY i.date_published DESC',
			$params,
			$rangeInfo
		);

		return new DAOResultFactory($result, $this, '_returnIssueFromRow', [], $sql, $params, $rangeInfo);
	}

	/**
	 * Return number of articles assigned to an issue.
	 * @param $issueId int
	 * @return int
	 */
	function getNumArticles($issueId) {
		$result = $this->retrieve(
			'SELECT COUNT(*) AS row_count
			FROM submissions s
				JOIN publications p ON (p.publication_id = s.current_publication_id)
				JOIN publication_settings ps ON (ps.publication_id = p.publication_id AND ps.setting_name = ? AND ps.locale=\'\')
			WHERE ps.setting_value = ? AND (s.status = ? or s.status = ?) ',
			['issueId', (int) $issueId, (int) STATUS_SCHEDULED, (int) STATUS_PUBLISHED]
		);
		$row = $result->current();
		return $row ? $row->row_count : 0;
	}

	/**
	 * Delete the custom ordering of a published issue.
	 * @param $journalId int
	 */
	function deleteCustomIssueOrdering($journalId) {
		$this->update(
			'DELETE FROM custom_issue_orders WHERE journal_id = ?', [(int) $journalId]
		);
	}

	/**
	 * Sequentially renumber custom issue orderings in their sequence order.
	 * @param $journalId int
	 */
	function resequenceCustomIssueOrders($journalId) {
		// If no custom issue ordering already exists, there is nothing to do
		if (!$this->customIssueOrderingExists($journalId)) {
			return;
		}
		$result = $this->retrieve(
			'SELECT i.issue_id FROM issues i LEFT JOIN custom_issue_orders o ON (o.issue_id = i.issue_id) WHERE i.journal_id = ? ORDER BY o.seq',
			[(int) $journalId]
		);

		for ($i=1; $row = $result->current(); $i++) {
			$this->replace(
				'custom_issue_orders',
				[
					'issue_id' => $row->issue_id,
					'journal_id' => (int) $journalId,
					'seq' => $i
				],
				['issue_id', 'journal_id']
			);
			$result->next();
		}
	}

	/**
	 * Check if a journal has custom issue ordering.
	 * @param $journalId int
	 * @return boolean
	 */
	function customIssueOrderingExists($journalId) {
		$result = $this->retrieve(
			'SELECT COUNT(*) AS row_count FROM custom_issue_orders WHERE journal_id = ?',
			[(int) $journalId]
		);
		$row = $result->current();
		return $row && $row->row_count != 0;
	}

	/**
	 * Get the custom issue order of a journal.
	 * @param $journalId int
	 * @param $issueId int
	 * @return int?
	 */
	function getCustomIssueOrder($journalId, $issueId) {
		$result = $this->retrieve(
			'SELECT seq FROM custom_issue_orders WHERE journal_id = ? AND issue_id = ?',
			[(int) $journalId, (int) $issueId]
		);

		$row = $result->current();
		return $row ? $row->seq : null;
	}

	/**
	 * Import the current issue orders into the specified journal as custom
	 * issue orderings.
	 * @param $journalId int
	 */
	function setDefaultCustomIssueOrders($journalId) {
		$publishedIssues = $this->getPublishedIssues($journalId);
		for ($i=1; $issue = $publishedIssues->next(); $i++) {
			$this->insertCustomIssueOrder($journalId, $issue->getId(), $i);
		}
	}

	/**
	 * INTERNAL USE ONLY: Insert a custom issue ordering
	 * @param $journalId int
	 * @param $issueId int
	 * @param $seq int
	 */
	function insertCustomIssueOrder($journalId, $issueId, $seq) {
		$this->update(
			'INSERT INTO custom_issue_orders (issue_id, journal_id, seq) VALUES (?, ?, ?)',
			[(int) $issueId, (int) $journalId, $seq]
		);
	}

	/**
	 * Move a custom issue ordering up or down, resequencing as necessary.
	 * @param $journalId int
	 * @param $issueId int
	 * @param $newPos int The new position (0-based) of this section
	 */
	function moveCustomIssueOrder($journalId, $issueId, $newPos) {
		if (!$this->update(
			'UPDATE custom_issue_orders SET seq = ? WHERE journal_id = ? AND issue_id = ?',
			[$newPos, (int) $journalId, (int) $issueId]
		)) {
			// This entry is missing. Create it.
			$this->insertCustomIssueOrder($journalId, $issueId, $newPos);
		}
	}

	/**
	 * @copydoc PKPPubIdPluginDAO::pubIdExists()
	 */
	function pubIdExists($pubIdType, $pubId, $excludePubObjectId, $contextId) {
		$result = $this->retrieve(
			'SELECT COUNT(*) AS row_count
			FROM issue_settings ist
				INNER JOIN issues i ON ist.issue_id = i.issue_id
			WHERE ist.setting_name = ? AND ist.setting_value = ? AND i.issue_id <> ? AND i.journal_id = ?',
			[
				'pub-id::' . $pubIdType,
				$pubId,
				(int) $excludePubObjectId,
				(int) $contextId
			]
		);
		$row = $result->current();
		return $row && $row->row_count;
	}

	/**
	 * @copydoc PKPPubIdPluginDAO::changePubId()
	 */
	function changePubId($pubObjectId, $pubIdType, $pubId) {
		$this->replace(
			'issue_settings',
			[
				'issue_id' => (int) $pubObjectId,
				'locale' => '',
				'setting_name' => 'pub-id::' . $pubIdType,
				'setting_type' => 'string',
				'setting_value' => (string) $pubId
			],
			['issue_id', 'locale', 'setting_name']
		);
		$this->flushCache();
	}

	/**
	 * @copydoc PKPPubIdPluginDAO::deletePubId()
	 */
	function deletePubId($pubObjectId, $pubIdType) {
		$this->update(
			'DELETE FROM issue_settings WHERE setting_name = ? AND issue_id = ?',
			[
				'pub-id::' . $pubIdType,
				(int)$pubObjectId
			]
		);
		$this->flushCache();
	}

	/**
	 * @copydoc PKPPubIdPluginDAO::deleteAllPubIds()
	 */
	function deleteAllPubIds($contextId, $pubIdType) {
		$issues = $this->getIssues($contextId);
		while ($issue = $issues->next()) {
			$this->update(
				'DELETE FROM issue_settings WHERE setting_name = ? AND issue_id = ?',
				[
					'pub-id::' . $pubIdType,
					(int)$issue->getId()
				]
			);
		}
		$this->flushCache();
	}

	/**
	 * Flush the issue cache.
	 */
	function flushCache() {
		$this->_getCache('issues')->flush();
		$this->_getCache('current')->flush();
	}
}


