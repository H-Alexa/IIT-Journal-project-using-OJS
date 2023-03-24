<?php

/**
 * @file classes/xml/XMLParserDOMHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class XMLParserDOMHandler
 * @ingroup xml
 * @see PKPXMLParser
 *
 * @brief Default handler for PKPXMLParser returning a simple DOM-style object.
 * This handler parses an XML document into a tree structure of XMLNode objects.
 *
 */


import('lib.pkp.classes.xml.XMLNode');

class XMLParserDOMHandler extends XMLParserHandler {

	/** @var XMLNode reference to the root node */
	var $rootNode;

	/** @var XMLNode reference to the node currently being parsed */
	var $currentNode;

	/** @var reference to the current data */
	var $currentData;

	/**
	 * Constructor.
	 */
	function __construct() {
		$this->rootNodes = array();
		$this->currentNode = null;
	}

	function destroy() {
		unset($this->currentNode, $this->currentData, $this->rootNode);
	}

	/**
	 * Callback function to act as the start element handler.
	 * @param $parser PKPXMLParser
	 * @param $tag string
	 * @param $attributes array
	 */
	function startElement($parser, $tag, $attributes) {
		$this->currentData = null;
		$node = new XMLNode($tag);
		$node->setAttributes($attributes);

		if (isset($this->currentNode)) {
			$this->currentNode->addChild($node);
			$node->setParent($this->currentNode);

		} else {
			$this->rootNode =& $node;
		}

		$this->currentNode =& $node;
	}

	/**
	 * Callback function to act as the end element handler.
	 * @param $parser PKPXMLParser
	 * @param $tag string
	 */
	function endElement($parser, $tag) {
		$this->currentNode->setValue($this->currentData);
		$this->currentNode =& $this->currentNode->getParent();
		$this->currentData = null;
	}

	/**
	 * Callback function to act as the character data handler.
	 * @param $parser PKPXMLParser
	 * @param $data string
	 */
	function characterData($parser, $data) {
		$this->currentData .= $data;
	}

	/**
	 * Returns a reference to the root node of the tree representing the document.
	 * @return XMLNode
	 */
	function getResult() {
		return $this->rootNode;
	}
}


