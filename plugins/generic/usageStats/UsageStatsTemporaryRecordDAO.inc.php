<?php

/**
 * @file plugins/generic/usageStats/UsageStatsTemporaryRecordDAO.inc.php
 *
 * Copyright (c) 2013-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UsageStatsTemporaryRecordDAO
 * @ingroup plugins_generic_usageStats
 *
 * @brief Operations for retrieving and adding temporary usage statistics records.
 */


class UsageStatsTemporaryRecordDAO extends DAO {

	/** @var Enumerable|false */
	var $_result;

	/** @var string|null */
	var $_loadId;

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();

		$this->_result = false;
		$this->_loadId = null;
	}

	/**
	 * Add the passed usage statistic record.
	 * @param $assocType int
	 * @param $assocId int
	 * @param $day string
	 * @param $time int
	 * @param $countryCode string
	 * @param $region string
	 * @param $cityName string
	 * @param $fileType int
	 * @param $loadId string
	 * @return boolean
	 */
	function insert($assocType, $assocId, $day, $time, $countryCode, $region, $cityName, $fileType, $loadId) {
		$this->update(
			'INSERT INTO usage_stats_temporary_records
				(assoc_type, assoc_id, day, entry_time, country_id, region, city, file_type, load_id)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?)',
			[
				(int) $assocType,
				(int) $assocId,
				$day,
				(int) $time,
				$countryCode,
				$region,
				$cityName,
				(int) $fileType,
				$loadId // Not number.
			]
		);

		return true;
	}

	/**
	 * Get next temporary stats record by load id.
	 * @param string $loadId
	 * @return Enumerable
	 */
	function getByLoadId($loadId) {
		return $this->_getGrouped($loadId);
	}

	/**
	 * Delete all temporary records associated
	 * with the passed load id.
	 * @param $loadId string
	 * @return boolean
	 */
	function deleteByLoadId($loadId) {
		return $this->update(
			'DELETE from usage_stats_temporary_records WHERE load_id = ?',
			[$loadId] // $loadId is not a number
		);
	}

	/**
	 * Delete the record with the passed assoc id and type with
	 * the most recent day value.
	 * @param $assocType int
	 * @param $assocId int
	 * @param $time int
	 * @param $loadId string
	 * @return boolean
	 */
	function deleteRecord($assocType, $assocId, $time, $loadId) {
		return $this->update('DELETE from usage_stats_temporary_records
			WHERE assoc_type = ? AND assoc_id = ? AND entry_time = ? AND load_id = ?',
			[(int) $assocType, (int) $assocId, $time, $loadId] // $loadId is not a number
		);
	}


	//
	// Private helper methods.
	//
	/**
	* Get all temporary records with the passed load id grouped.
	* @param $loadId string
	* @return Enumerable
	*/
	function _getGrouped($loadId) {
		return $this->retrieve(
			'SELECT assoc_type, assoc_id, day, country_id, region, city, file_type, load_id, count(metric) as metric
			FROM usage_stats_temporary_records WHERE load_id = ?
			GROUP BY assoc_type, assoc_id, day, country_id, region, city, file_type, load_id',
			[$loadId] // $loadId is not a number.
		);
	}
}

