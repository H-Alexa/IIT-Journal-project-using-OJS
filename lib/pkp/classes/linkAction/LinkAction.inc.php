<?php
/**
 * @defgroup linkAction LinkActions
 * Link actions are representations of various kinds of actions that can be
 * invoked by clicking a link.
 */

/**
 * @file classes/linkAction/LinkAction.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class LinkAction
 * @ingroup linkAction
 *
 * @brief Base class defining an action that can be performed by the user
 *  in the user interface.
 */

class LinkAction {
	/** @var string the id of the action */
	var $_id;

	/** @var LinkActionRequest The action to be taken when the link action is activated */
	var $_actionRequest;

	/** @var string The localized title of the action. */
	var $_title;

	/** @var string The localized tool tip of the action. */
	var $_toolTip;

	/** @var string The name of an icon for the action. */
	var $_image;

	/**
	 * Constructor
	 * @param $id string
	 * @param $actionRequest LinkActionRequest The action to be taken when the link action is activated.
	 * @param $title string (optional) The localized title of the action.
	 * @param $image string (optional) The name of an icon for the
	 *  action.
	 * @param $toolTip string (optional) A localized tool tip to display when hovering over
	 *  the link action.
	 */
	function __construct($id, $actionRequest, $title = null, $image = null, $toolTip = null) {
		$this->_id = $id;
		assert(is_a($actionRequest, 'LinkActionRequest'));
		$this->_actionRequest = $actionRequest;
		$this->_title = $title;
		$this->_image = $image;
		$this->_toolTip = $toolTip;
		HookRegistry::call('LinkAction::construct', array($this));
	}


	//
	// Getters and Setters
	//
	/**
	 * Get the action id.
	 * @return string
	 */
	function getId() {
		return $this->_id;
	}

	/**
	 * Get the action handler.
	 * @return LinkActionRequest
	 */
	function getActionRequest() {
		return $this->_actionRequest;
	}

	/**
	 * Get the localized action title.
	 * @return string
	 */
	function getTitle() {
		return $this->_title;
	}

	/**
	 * Set the localized action title.
	 * @return string
	 */
	function setTitle($title) {
		$this->_title = $title;
	}

	/**
	 * Get the localized tool tip.
	 * @return string
	 */
	function getToolTip() {
		return $this->_toolTip;
	}

	/**
	 * Get the action image.
	 * @return string
	 */
	function getImage() {
		return $this->_image;
	}
}


