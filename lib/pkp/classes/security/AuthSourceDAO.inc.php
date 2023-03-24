<?php

/**
 * @file classes/security/AuthSourceDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class AuthSourceDAO
 * @ingroup security
 * @see AuthSource
 *
 * @brief Operations for retrieving and modifying AuthSource objects.
 */


import('lib.pkp.classes.security.AuthSource');

class AuthSourceDAO extends DAO {
	var $plugins;

	/**
	 * Constructor.
	 */
	function __construct() {
		parent::__construct();
		$this->plugins = PluginRegistry::loadCategory(AUTH_PLUGIN_CATEGORY);
	}

	/**
	 * Get plugin instance corresponding to the ID.
	 * @param $authId int
	 * @return AuthPlugin
	 */
	function getPlugin($authId) {
		$plugin = null;
		$auth = $this->getSource($authId);
		if ($auth != null) {
			$plugin = $auth->getPluginClass();
			if ($plugin != null) {
				$plugin = $plugin->getInstance($auth->getSettings(), $auth->getAuthId());
			}
		}
		return $plugin;
	}

	/**
	 * Get plugin instance for the default authentication source.
	 * @return AuthPlugin
	 */
	function getDefaultPlugin() {
		$plugin = null;
		$auth = $this->getDefaultSource();
		if ($auth != null) {
			$plugin = $auth->getPluginClass();
			if ($plugin != null) {
				$plugin = $plugin->getInstance($auth->getSettings(), $auth->getAuthId());
			}
		}
		return $plugin;
	}

	/**
	 * Retrieve a source.
	 * @param $authId int
	 * @return AuthSource
	 */
	function getSource($authId) {
		$result = $this->retrieve(
			'SELECT * FROM auth_sources WHERE auth_id = ?',
			[(int) $authId]
		);
		$row = $result->current();
		return $row ? $this->_fromRow((array) $row) : null;
	}

	/**
	 * Retrieve the default authentication source.
	 * @return AuthSource
	 */
	function getDefaultSource() {
		$result = $this->retrieve(
			'SELECT * FROM auth_sources WHERE auth_default = 1'
		);
		$row = $result->current();
		return $row ? $this->_fromRow((array) $row) : null;
	}

	/**
	 * Instantiate and return a new data object.
	 * @return AuthSource
	 */
	function newDataObject() {
		return new AuthSource();
	}

	/**
	 * Internal function to return an AuthSource object from a row.
	 * @param $row array
	 * @return AuthSource
	 */
	function _fromRow($row) {
		$auth = $this->newDataObject();
		$auth->setAuthId($row['auth_id']);
		$auth->setTitle($row['title']);
		$auth->setPlugin($row['plugin']);
		$auth->setPluginClass(@$this->plugins[$row['plugin']]);
		$auth->setDefault($row['auth_default']);
		$auth->setSettings(unserialize($row['settings']));
		return $auth;
	}

	/**
	 * Insert a new source.
	 * @param $auth AuthSource
	 */
	function insertObject($auth) {
		if (!isset($this->plugins[$auth->getPlugin()])) return false;
		if (!$auth->getTitle()) $auth->setTitle($this->plugins[$auth->getPlugin()]->getDisplayName());
		$this->update(
			'INSERT INTO auth_sources
				(title, plugin, settings)
				VALUES
				(?, ?, ?)',
			[
				$auth->getTitle(),
				$auth->getPlugin(),
				serialize($auth->getSettings() ? $auth->getSettings() : [])
			]
		);

		$auth->setAuthId($this->_getInsertId('auth_sources', 'auth_id'));
		return $auth->getAuthId();
	}

	/**
	 * Update a source.
	 * @param $auth AuthSource
	 */
	function updateObject($auth) {
		$this->update(
			'UPDATE auth_sources SET
				title = ?,
				settings = ?
			WHERE	auth_id = ?',
			[
				$auth->getTitle(),
				serialize($auth->getSettings() ? $auth->getSettings() : array()),
				(int) $auth->getAuthId()
			]
		);
	}

	/**
	 * Delete a source.
	 * @param $authId int
	 */
	function deleteObject($authId) {
		$this->update(
			'DELETE FROM auth_sources WHERE auth_id = ?', [$authId]
		);
	}

	/**
	 * Set the default authentication source.
	 * @param $authId int
	 */
	function setDefault($authId) {
		$this->update(
			'UPDATE auth_sources SET auth_default = 0'
		);
		$this->update(
			'UPDATE auth_sources SET auth_default = 1 WHERE auth_id = ?',
			[(int) $authId]
		);
	}

	/**
	 * Retrieve a list of all auth sources for the site.
	 * @return array AuthSource
	 */
	function getSources($rangeInfo = null) {
		$result = $this->retrieveRange(
			'SELECT * FROM auth_sources ORDER BY auth_id',
			[],
			$rangeInfo
		);

		return new DAOResultFactory($result, $this, '_fromRow');
	}
}


