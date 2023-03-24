<?php

/**
 * @file classes/oai/ojs/OAIDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class OAIDAO
 * @ingroup oai_ojs
 * @see OAI
 *
 * @brief DAO operations for the OJS OAI interface.
 */

import('lib.pkp.classes.oai.PKPOAIDAO');
import('classes.issue.Issue');
use Illuminate\Database\Capsule\Manager as Capsule;

class OAIDAO extends PKPOAIDAO {

 	/** Helper DAOs */
 	var $journalDao;
 	var $sectionDao;
	var $articleGalleyDao;
	var $issueDao;
 	var $authorDao;

 	var $journalCache;
	var $sectionCache;
	var $issueCache;

 	/**
	 * Constructor.
	 */
	function __construct() {
		parent::__construct();
		$this->journalDao = DAORegistry::getDAO('JournalDAO');
		$this->sectionDao = DAORegistry::getDAO('SectionDAO');
		$this->articleGalleyDao = DAORegistry::getDAO('ArticleGalleyDAO');
		$this->issueDao = DAORegistry::getDAO('IssueDAO');
		$this->authorDao = DAORegistry::getDAO('AuthorDAO');

		$this->journalCache = [];
		$this->sectionCache = [];
	}

	/**
	 * @copydoc PKPOAIDAO::getEarliestDatestampQuery()
	 */
	function getEarliestDatestampQuery() {
	}

	/**
	 * Cached function to get a journal
	 * @param $journalId int
	 * @return object
	 */
	function &getJournal($journalId) {
		if (!isset($this->journalCache[$journalId])) {
			$this->journalCache[$journalId] = $this->journalDao->getById($journalId);
		}
		return $this->journalCache[$journalId];
	}

	/**
	 * Cached function to get an issue
	 * @param $issueId int
	 * @return object
	 */
	function &getIssue($issueId) {
		if (!isset($this->issueCache[$issueId])) {
			$this->issueCache[$issueId] = $this->issueDao->getById($issueId);
		}
		return $this->issueCache[$issueId];
	}

	/**
	 * Cached function to get a journal section
	 * @param $sectionId int
	 * @return object
	 */
	function &getSection($sectionId) {
		if (!isset($this->sectionCache[$sectionId])) {
			$this->sectionCache[$sectionId] = $this->sectionDao->getById($sectionId);
		}
		return $this->sectionCache[$sectionId];
	}


	//
	// Sets
	//
	/**
	 * Return hierarchy of OAI sets (journals plus journal sections).
	 * @param $journalId int
	 * @param $offset int
	 * @param $total int
	 * @return array OAISet
	 */
	function &getJournalSets($journalId, $offset, $limit, &$total) {
		if (isset($journalId)) {
			$journals = array($this->journalDao->getById($journalId));
		} else {
			$journals = $this->journalDao->getAll(true);
			$journals = $journals->toArray();
		}

		// FIXME Set descriptions
		$sets = array();
		foreach ($journals as $journal) {
			$title = $journal->getLocalizedName();
			$abbrev = $journal->getPath();
			array_push($sets, new OAISet(urlencode($abbrev), $title, ''));

			$tombstoneDao = DAORegistry::getDAO('DataObjectTombstoneDAO'); /* @var $tombstoneDao DataObjectTombstoneDAO */
			$articleTombstoneSets = $tombstoneDao->getSets(ASSOC_TYPE_JOURNAL, $journal->getId());

			$sections = $this->sectionDao->getByJournalId($journal->getId());
			foreach ($sections->toArray() as $section) {
				if (array_key_exists(urlencode($abbrev) . ':' . urlencode($section->getLocalizedAbbrev()), $articleTombstoneSets)) {
					unset($articleTombstoneSets[urlencode($abbrev) . ':' . urlencode($section->getLocalizedAbbrev())]);
				}
				array_push($sets, new OAISet(urlencode($abbrev) . ':' . urlencode($section->getLocalizedAbbrev()), $section->getLocalizedTitle(), ''));
			}
			foreach ($articleTombstoneSets as $articleTombstoneSetSpec => $articleTombstoneSetName) {
				array_push($sets, new OAISet($articleTombstoneSetSpec, $articleTombstoneSetName, ''));
			}
		}

		HookRegistry::call('OAIDAO::getJournalSets', array($this, $journalId, $offset, $limit, $total, &$sets));

		$total = count($sets);
		$sets = array_slice($sets, $offset, $limit);

		return $sets;
	}

	/**
	 * Return the journal ID and section ID corresponding to a journal/section pairing.
	 * @param $journalSpec string
	 * @param $sectionSpec string
	 * @param $restrictJournalId int
	 * @return array (int, int)
	 */
	function getSetJournalSectionId($journalSpec, $sectionSpec, $restrictJournalId = null) {
		$journal =& $this->journalDao->getByPath($journalSpec);
		if (!isset($journal) || (isset($restrictJournalId) && $journal->getId() != $restrictJournalId)) {
			return array(0, 0);
		}

		$journalId = $journal->getId();
		$sectionId = null;

		if (isset($sectionSpec)) {
			$section = $this->sectionDao->getByAbbrev($sectionSpec, $journal->getId());
			if (isset($section)) {
				$sectionId = $section->getId();
			} else {
				$sectionId = 0;
			}
		}

		return array($journalId, $sectionId);
	}

	//
	// Protected methods.
	//
	/**
	 * @see lib/pkp/classes/oai/PKPOAIDAO::setOAIData()
	 */
	function setOAIData($record, $row, $isRecord = true) {
		$journal = $this->getJournal($row['journal_id']);
		$section = $this->getSection($row['section_id']);
		$articleId = $row['submission_id'];

		$record->identifier = $this->oai->articleIdToIdentifier($articleId);
		$record->sets = array(urlencode($journal->getPath()) . ':' . urlencode($section->getLocalizedAbbrev()));

		if ($isRecord) {
			$submission = Services::get('submission')->get($articleId);
			$issue = $this->getIssue($row['issue_id']);
			$galleys = $this->articleGalleyDao->getByPublicationId($submission->getCurrentPublication()->getId())->toArray();

			$record->setData('article', $submission);
			$record->setData('journal', $journal);
			$record->setData('section', $section);
			$record->setData('issue', $issue);
			$record->setData('galleys', $galleys);
		}

		return $record;
	}

	/**
	 * Get a OAI records record set.
	 * @param $setIds array Objects ids that specify an OAI set,
	 * in hierarchical order.
	 * @param $from int/string *nix timestamp or ISO datetime string
	 * @param $until int/string *nix timestamp or ISO datetime string
	 * @param $set string
	 * @param $submissionId int optional
	 * @param $orderBy string UNFILTERED
	 * @return Iterable
	 */
	function _getRecordsRecordSet($setIds, $from, $until, $set, $submissionId = null, $orderBy = 'journal_id, submission_id') {
		$journalId = array_shift($setIds);
		$sectionId = array_shift($setIds);

		# Exlude all journals that do not have Oai specifically turned on, see #pkp/pkp-lib#6503
		$excludeJournals = Capsule::table('journals')
			->whereNotIn('journal_id',function($query){
				$query->select('journal_id')
				->from('journal_settings')
				->where('setting_name', 'enableOai')
				->where('setting_value', 1);
			})
		->groupBy('journal_id')
		->pluck('journal_id')
		->all();

		$params = array((int) STATUS_PUBLISHED);
		if (isset($journalId)) $params[] = (int) $journalId;
		if (isset($sectionId)) $params[] = (int) $sectionId;
		if ($submissionId) $params[] = (int) $submissionId;
		if (isset($journalId)) $params[] = (int) $journalId;
		if (isset($sectionId)) $params[] = (int) $sectionId;
		if (isset($set)) {
			$params[] = $set;
			$params[] = $set . ':%';
		}
		if ($submissionId) $params[] = (int) $submissionId;
		return $this->retrieve(
			'SELECT	GREATEST(a.last_modified, i.last_modified) AS last_modified,
				a.submission_id AS submission_id,
				j.journal_id AS journal_id,
				s.section_id AS section_id,
				i.issue_id,
				NULL AS tombstone_id,
				NULL AS set_spec,
				NULL AS oai_identifier
			FROM
				submissions a
				JOIN publications p ON (a.current_publication_id = p.publication_id)
				JOIN publication_settings psissue ON (psissue.publication_id = p.publication_id AND psissue.setting_name=\'issueId\' AND psissue.locale=\'\')
				JOIN issues i ON (CAST(i.issue_id AS CHAR(20)) = psissue.setting_value)
				JOIN sections s ON (s.section_id = p.section_id)
				JOIN journals j ON (j.journal_id = a.context_id)
			WHERE	i.published = 1 AND j.enabled = 1 AND a.status = ?
				' . ($excludeJournals ?' AND j.journal_id NOT IN ('.implode(',', $excludeJournals).')':'') . '
				' . (isset($journalId) ?' AND j.journal_id = ?':'') . '
				' . (isset($sectionId) ?' AND p.section_id = ?':'') . '
				' . ($from?' AND GREATEST(a.last_modified, i.last_modified) >= ' . $this->datetimeToDB($from):'') . '
				' . ($until?' AND GREATEST(a.last_modified, i.last_modified) <= ' . $this->datetimeToDB($until):'') . '
				' . ($submissionId?' AND a.submission_id = ?':'') . '
			UNION
			SELECT	dot.date_deleted AS last_modified,
				dot.data_object_id AS submission_id,
				' . (isset($journalId) ? 'tsoj.assoc_id' : 'NULL') . ' AS assoc_id,' . '
				' . (isset($sectionId)? 'tsos.assoc_id' : 'NULL') . ' AS section_id,
				NULL AS issue_id,
				dot.tombstone_id,
				dot.set_spec,
				dot.oai_identifier
			FROM	data_object_tombstones dot' . '
				' . (isset($journalId) ? 'JOIN data_object_tombstone_oai_set_objects tsoj ON (tsoj.tombstone_id = dot.tombstone_id AND tsoj.assoc_type = ' . ASSOC_TYPE_JOURNAL . ' AND tsoj.assoc_id = ?)' : '') . '
				' . (isset($sectionId)? 'JOIN data_object_tombstone_oai_set_objects tsos ON (tsos.tombstone_id = dot.tombstone_id AND tsos.assoc_type = ' . ASSOC_TYPE_SECTION . ' AND tsos.assoc_id = ?)' : '') . '
			WHERE	1=1
				' . (isset($set)?' AND (dot.set_spec = ? OR dot.set_spec LIKE ?)':'') . '
				' . ($from?' AND dot.date_deleted >= ' . $this->datetimeToDB($from):'') . '
				' . ($until?' AND dot.date_deleted <= ' . $this->datetimeToDB($until):'') . '
				' . ($submissionId?' AND dot.data_object_id = ?':'') . '
			ORDER BY ' . $orderBy,
			$params
		);
	}
}


