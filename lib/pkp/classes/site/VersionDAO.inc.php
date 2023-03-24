<?php

/**
 * @file classes/site/VersionDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class VersionDAO
 * @ingroup site
 * @see Version
 *
 * @brief Operations for retrieving and modifying Version objects.
 */


import('lib.pkp.classes.site.Version');

class VersionDAO extends DAO {

	/**
	 * Retrieve the current version.
	 * @param $productType string
	 * @param $product string
	 * @param $isPlugin boolean
	 * @return Version?
	 */
	function getCurrentVersion($productType = null, $product = null, $isPlugin = false) {
		if(!$productType || !$product) {
			$application = Application::get();
			$productType = 'core';
			$product = $application->getName();
		}

		$result = $this->retrieve(
			'SELECT * FROM versions WHERE current = 1 AND product_type = ? AND product = ?',
			[$productType, $product]
		);
		$row = (array) $result->current();
		return $row?$this->_returnVersionFromRow($row):null;
	}

	/**
	 * Retrieve the complete version history, ordered by date (most recent first).
	 * @param $productType string
	 * @param $product string
	 * @return array Versions
	 */
	function getVersionHistory($productType = null, $product = null) {
		$versions = array();

		if(!$productType || !$product) {
			$application = Application::get();
			$productType = 'core';
			$product = $application->getName();
		}

		$result = $this->retrieve(
			'SELECT * FROM versions WHERE product_type = ? AND product = ? ORDER BY date_installed DESC',
			array($productType, $product)
		);

		foreach ($result as $row) {
			$versions[] = $this->_returnVersionFromRow((array) $row);
		}
		return $versions;
	}

	/**
	 * Internal function to return a Version object from a row.
	 * @param $row array
	 * @return Version
	 */
	function _returnVersionFromRow($row) {
		$version = new Version(
			$row['major'],
			$row['minor'],
			$row['revision'],
			$row['build'],
			$this->datetimeFromDB($row['date_installed']),
			$row['current'],
			(isset($row['product_type']) ? $row['product_type'] : null),
			(isset($row['product']) ? $row['product'] : null),
			(isset($row['product_class_name']) ? $row['product_class_name'] : ''),
			(isset($row['lazy_load']) ? $row['lazy_load'] : 0),
			(isset($row['sitewide']) ? $row['sitewide'] : 0)
		);

		HookRegistry::call('VersionDAO::_returnVersionFromRow', array(&$version, &$row));

		return $version;
	}

	/**
	 * Insert a new version.
	 * @param $version Version
	 * @param $isPlugin boolean
	 */
	function insertVersion($version, $isPlugin = false) {
		$isNewVersion = true;

		if ($version->getCurrent()) {
			// Find out whether the last installed version is the same as the
			// one to be inserted.
			$versionHistory = $this->getVersionHistory($version->getProductType(), $version->getProduct());

			$oldVersion = array_shift($versionHistory);
			if ($oldVersion) {
				if ($version->compare($oldVersion) == 0) {
					// The old and the new current versions are the same so we need
					// to update the existing version entry.
					$isNewVersion = false;
				} elseif ($version->compare($oldVersion) == 1) {
					// Version to insert is newer than the existing version entry.
					// We reset existing entry.
					$this->update('UPDATE versions SET current = 0 WHERE current = 1 AND product = ?', [$version->getProduct()]);
				} else {
					// We do not support downgrades.
					fatalError('You are trying to downgrade the product "'.$version->getProduct().'" from version ['.$oldVersion->getVersionString(false).'] to version ['.$version->getVersionString(false).']. Downgrades are not supported.');
				}
			}
		}

		if ($isNewVersion) {
			// We only change the install date when we insert new
			// version entries.
			if ($version->getDateInstalled() == null) {
				$version->setDateInstalled(Core::getCurrentDate());
			}

			// Insert new version entry
			return $this->update(
				sprintf('INSERT INTO versions
					(major, minor, revision, build, date_installed, current, product_type, product, product_class_name, lazy_load, sitewide)
					VALUES
					(?, ?, ?, ?, %s, ?, ?, ?, ?, ?, ?)',
					$this->datetimeToDB($version->getDateInstalled())),
				[
					(int) $version->getMajor(),
					(int) $version->getMinor(),
					(int) $version->getRevision(),
					(int) $version->getBuild(),
					(int) $version->getCurrent(),
					$version->getProductType(),
					$version->getProduct(),
					$version->getProductClassName(),
					($version->getLazyLoad()?1:0),
					($version->getSitewide()?1:0)
				]
			);
		} else {
			// Update existing version entry
			return $this->update(
				'UPDATE versions SET current = ?, product_class_name = ?, lazy_load = ?, sitewide = ?
					WHERE product_type = ? AND product = ? AND major = ? AND minor = ? AND revision = ? AND build = ?',
				[
					(int) $version->getCurrent(),
					$version->getProductClassName(),
					($version->getLazyLoad()?1:0),
					($version->getSitewide()?1:0),
					$version->getProductType(),
					$version->getProduct(),
					(int) $version->getMajor(),
					(int) $version->getMinor(),
					(int) $version->getRevision(),
					(int) $version->getBuild()
				]
			);
		}
	}

	/**
	 * Retrieve all currently enabled products within the
	 * given context as a two dimensional array with the
	 * first key representing the product type, the second
	 * key the product name and the value the product version.
	 *
	 * @param $context array the application context, only
	 *  products enabled in that context will be returned.
	 * @return array
	 */
	function getCurrentProducts($context) {

		if (count($context)) {
			assert(count($context)==1); // Context depth > 1 no longer supported here.
			$contextWhereClause = 'AND (context_id = ? OR v.sitewide = 1)';
		} else {
			$contextWhereClause = '';
		}

		$result = $this->retrieve(
			'SELECT v.*
			FROM versions v LEFT JOIN plugin_settings ps ON
				lower(v.product_class_name) = ps.plugin_name
				AND ps.setting_name = \'enabled\' '.$contextWhereClause.'
			WHERE v.current = 1 AND (ps.setting_value = \'1\' OR v.lazy_load <> 1)',
			array_values($context), false
		);

		$productArray = [];
		foreach ($result as $row) {
			$productArray[$row->product_type][$row->product] = $this->_returnVersionFromRow((array) $row);
		}
		return $productArray;
	}

	/**
	 * Disable a product by setting its 'current' column to 0
	 * @param $productType string
	 * @param $product string
	 */
	function disableVersion($productType, $product) {
		$this->update(
			'UPDATE versions SET current = 0 WHERE current = 1 AND product_type = ? AND product = ?',
			[$productType, $product]
		);
	}
}


