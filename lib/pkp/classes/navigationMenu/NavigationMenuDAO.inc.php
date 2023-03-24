<?php

/**
 * @file classes/navigationMenu/NavigationMenuDAO.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class NavigationMenuDAO
 * @ingroup navigationMenu
 * @see NavigationMenu
 *
 * @brief Operations for retrieving and modifying NavigationMenu objects.
 */


import('lib.pkp.classes.navigationMenu.NavigationMenu');

class NavigationMenuDAO extends DAO {
	/**
	 * Generate a new data object.
	 * @return NavigationMenu
	 */
	function newDataObject() {
		return new NavigationMenu();
	}

	/**
	 * Retrieve a navigation menu by navigation menu ID.
	 * @param $navigationMenuId int navigation menu ID
	 * @param $contextId int Context Id
	 * @return NavigationMenu?
	 */
	function getById($navigationMenuId, $contextId = null) {
		$params = [(int) $navigationMenuId];
		if ($contextId !== null) $params[] = (int) $contextId;
		$result = $this->retrieve(
			'SELECT * FROM navigation_menus WHERE navigation_menu_id = ?' .
			($contextId !== null?' AND context_id = ?':''),
			$params
		);

		$row = (array) $result->current();
		return $row?$this->_fromRow($row):null;
	}

	/**
	 * Retrieve a navigation menu by context Id.
	 * @param $contextId int Context Id
	 * @return NavigationMenu
	 */
	function getByContextId($contextId) {
		$result = $this->retrieve('SELECT * FROM navigation_menus WHERE context_id = ?', [(int) $contextId]);
		return new DAOResultFactory($result, $this, '_fromRow');
	}

	/**
	 * Retrieve a navigation menu by navigation menu area.
	 * @param $contextId int Context Id
	 * @param $areaName string Template Area name
	 * @return NavigationMenu
	 */
	function getByArea($contextId, $areaName) {
		$result = $this->retrieve('SELECT * FROM navigation_menus WHERE area_name = ? and context_id = ?', [$areaName, (int) $contextId]);
		return new DAOResultFactory($result, $this, '_fromRow');
	}

	/**
	 * Retrieve a navigation menu by title
	 * @param $contextId int Context Id
	 * @param $title string
	 * @return NavigationMenu?
	 */
	function getByTitle($contextId, $title) {
		$result = $this->retrieve('SELECT * FROM navigation_menus WHERE context_id = ? and title = ?', [(int) $contextId, $title]);
		$row = (array) $result->current();
		return $row?$this->_fromRow($row):null;
	}

	/**
	 * Check if a navigationMenu exists with the given title.
	 * @param $contextId int
	 * @param $title int
	 *
	 * @return boolean True if a NM exists by that title
	 */
	function navigationMenuExistsByTitle($contextId, $title) {
		$result = $this->retrieve('SELECT COUNT(*) AS row_count FROM navigation_menus WHERE title = ? AND context_id = ?', [$title, (int) $contextId]);
		$row = (array) $result->current();
		return $row && $row['row_count'] != 0;
	}

	/**
	 * Get the locale field names.
	 * @return array
	 */
	function getLocaleFieldNames() {
		return [];
	}

	/**
	 * Internal function to return an NavigationMenu object from a row.
	 * @param $row array
	 * @return NavigationMenu
	 */
	function _fromRow($row) {
		$navigationMenu = $this->newDataObject();
		$navigationMenu->setId($row['navigation_menu_id']);
		$navigationMenu->setTitle($row['title']);
		$navigationMenu->setAreaName($row['area_name']);
		$navigationMenu->setContextId($row['context_id']);

		return $navigationMenu;
	}

	/**
	 * Insert a new NavigationMenu.
	 * @param $navigationMenu NavigationMenu
	 * @return int
	 */
	function insertObject($navigationMenu) {
		$this->update('INSERT INTO navigation_menus (title, area_name, context_id) VALUES (?, ?, ?)',
			[$navigationMenu->getTitle(), $navigationMenu->getAreaName(), (int) $navigationMenu->getContextId()]
		);
		$navigationMenu->setId($this->getInsertId());
		return $navigationMenu->getId();
	}

	/**
	 * Update an existing NavigationMenu
	 * @param NavigationMenu $navigationMenu
	 * @return boolean
	 */
	function updateObject($navigationMenu) {
		$returner = $this->update(
			'UPDATE	navigation_menus
			SET	title = ?,
				area_name = ?,
				context_id = ?
			WHERE	navigation_menu_id = ?',
			[
				$navigationMenu->getTitle(),
				$navigationMenu->getAreaName(),
				(int) $navigationMenu->getContextId(),
				(int) $navigationMenu->getId(),
			]
		);
		$this->unCache($navigationMenu->getId());
		return (boolean) $returner;
	}

	/**
	 * Delete a NavigationMenu.
	 * @param $navigationMenu NavigationMenu
	 * @return boolean
	 */
	function deleteObject($navigationMenu) {
		return $this->deleteById($navigationMenu->getId());
	}

	/**
	 * Delete a NavigationMenu.
	 * @param $navigationMenuId int
	 */
	function deleteById($navigationMenuId) {
		$this->unCache($navigationMenuId);
		$this->update('DELETE FROM navigation_menus WHERE navigation_menu_id = ?', [(int) $navigationMenuId]);
		$navigationMenuItemAssignmentDao = DAORegistry::getDAO('NavigationMenuItemAssignmentDAO'); /* @var $navigationMenuItemAssignmentDao NavigationMenuItemAssignmentDAO */
		$navigationMenuItemAssignmentDao->deleteByMenuId($navigationMenuId);
	}

	/**
	 * Delete NavigationMenus by contextId.
	 * @param $contextId int
	 */
	function deleteByContextId($contextId) {
		$navigationMenus = $this->getByContextId($contextId);
		while ($navigationMenu = $navigationMenus->next()) $this->deleteObject($navigationMenu);
	}

	/**
	 * Get the ID of the last inserted NavigationMenu
	 * @return int
	 */
	function getInsertId() {
		return $this->_getInsertId('navigation_menus', 'navigation_menu_id');
	}

	/**
	 * Load the XML file and move the settings to the DB
	 * @param $contextId
	 * @param $filename
	 * @return boolean true === success
	 */
	function installSettings($contextId, $filename) {
		$xmlParser = new PKPXMLParser();
		$tree = $xmlParser->parse($filename);

		if ($contextId == CONTEXT_ID_NONE) {
			$siteDao = DAORegistry::getDAO('SiteDAO'); /* @var $siteDao SiteDAO */
			$site = $siteDao->getSite();
		}
		if (!$tree) return false;

		foreach ($tree->getChildren() as $navigationMenuNode) {
			$site = $navigationMenuNode->getAttribute('site');
			if ($contextId == CONTEXT_ID_NONE && !$site) continue;

			if ($navigationMenuNode->name == 'navigationMenu') {
				$title = $navigationMenuNode->getAttribute('title');
				$area = $navigationMenuNode->getAttribute('area');

				$navigationMenu = null;

				// Check if the given area has a NM attached.
				// If it does the NM is not being processed and a warning is being thrown
				$navigationMenusWithArea = $this->getByArea($contextId, $area)->toArray();
				if (count($navigationMenusWithArea) != 0) {
					error_log("WARNING: The NavigationMenu (ContextId: $contextId, Title: $title, Area: $area) will be skipped because the specified area has already a NavigationMenu attached.");
					continue;
				}

				if ($this->navigationMenuExistsByTitle($contextId, $title)) {
					$navigationMenu = $this->getByTitle($contextId, $title);
					$navigationMenu->setAreaName($area);

					// update the navigationMenu into the DB
					$navigationMenuId = $this->updateObject($navigationMenu);
				} else {
					$navigationMenu = $this->newDataObject();
					$navigationMenu->setTitle($title);
					$navigationMenu->setContextId($contextId);
					$navigationMenu->setAreaName($area);

					// insert the navigationMenu into the DB
					$navigationMenuId = $this->insertObject($navigationMenu);
					$navigationMenu->setId($navigationMenuId);
				}

				$seq = 0;
				foreach ($navigationMenuNode->getChildren() as $navigationMenuItemFirstLevelNode) {
					$navigationMenuItemDao = DAORegistry::getDAO('NavigationMenuItemDAO'); /* @var $navigationMenuItemDao NavigationMenuItemDAO */
					$navigationMenuItemDao->installNodeSettings($contextId, $navigationMenuItemFirstLevelNode, $navigationMenu->getId(), null, $seq, true);

					$seq++;
				}
			} elseif ($navigationMenuNode->name == 'navigationMenuItem') {
				$navigationMenuItemDao = DAORegistry::getDAO('NavigationMenuItemDAO'); /* @var $navigationMenuItemDao NavigationMenuItemDAO */
				$navigationMenuItemDao->installNodeSettings($contextId, $navigationMenuNode, null, null, 0, true);
			}
		}

		return true;
	}

	/**
	 * unCache the NM with id
	 * @param int $id
	 */
	function unCache($id){
		$cache = $this->getCache($id);
		if ($cache) $cache->flush();
	}

	/**
	 * Get the settings cache for a given ID
	 * @param $id
	 * @return array|null (Null indicates caching disabled)
	 */
	function getCache($id) {
		static $navigationMenuCache;
		if (!isset($navigationMenuCache)) {
			$navigationMenuCache = array();
		}
		if (!isset($navigationMenuCache[$id])) {
			$cacheManager = \CacheManager::getManager();
			$navigationMenuCache[$id] = $cacheManager->getCache(
				'navigationMenu', $id,
				array($this, '_cacheMiss')
			);
		}
		return $navigationMenuCache[$id];
	}

	/**
	 * Callback for a cache miss.
	 * @param $cache Cache
	 * @param $id string
	 * @return mixed
	 */
	function _cacheMiss($cache, $id) {
		$navigationMenuDao = \DAORegistry::getDAO('NavigationMenuDAO');
		$navigationMenu = $navigationMenuDao->GetById($cache->getCacheId());
		import('classes.core.Services');
		Services::get('navigationMenu')->getMenuTree($navigationMenu);

		return $navigationMenu;
	}
}
