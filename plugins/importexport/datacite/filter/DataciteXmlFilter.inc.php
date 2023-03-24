<?php

/**
 * @file plugins/importexport/datacite/filter/DataciteXmlFilter.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class DataciteXmlFilter
 * @ingroup plugins_importexport_datacite
 *
 * @brief Class that converts an Issue to a DataCite XML document.
 */

// Title types
define('DATACITE_TITLETYPE_TRANSLATED', 'TranslatedTitle');
define('DATACITE_TITLETYPE_ALTERNATIVE', 'AlternativeTitle');

// Date types
define('DATACITE_DATE_AVAILABLE', 'Available');
define('DATACITE_DATE_ISSUED', 'Issued');
define('DATACITE_DATE_SUBMITTED', 'Submitted');
define('DATACITE_DATE_ACCEPTED', 'Accepted');
define('DATACITE_DATE_CREATED', 'Created');
define('DATACITE_DATE_UPDATED', 'Updated');

// Identifier types
define('DATACITE_IDTYPE_PROPRIETARY', 'publisherId');
define('DATACITE_IDTYPE_EISSN', 'EISSN');
define('DATACITE_IDTYPE_ISSN', 'ISSN');
define('DATACITE_IDTYPE_DOI', 'DOI');

// Relation types
define('DATACITE_RELTYPE_ISVARIANTFORMOF', 'IsVariantFormOf');
define('DATACITE_RELTYPE_HASPART', 'HasPart');
define('DATACITE_RELTYPE_ISPARTOF', 'IsPartOf');
define('DATACITE_RELTYPE_ISPREVIOUSVERSIONOF', 'IsPreviousVersionOf');
define('DATACITE_RELTYPE_ISNEWVERSIONOF', 'IsNewVersionOf');

// Description types
define('DATACITE_DESCTYPE_ABSTRACT', 'Abstract');
define('DATACITE_DESCTYPE_SERIESINFO', 'SeriesInformation');
define('DATACITE_DESCTYPE_TOC', 'TableOfContents');
define('DATACITE_DESCTYPE_OTHER', 'Other');

import('lib.pkp.plugins.importexport.native.filter.NativeExportFilter');


class DataciteXmlFilter extends NativeExportFilter {
	/**
	 * Constructor
	 * @param $filterGroup FilterGroup
	 */
	function __construct($filterGroup) {
		$this->setDisplayName('DataCite XML export');
		parent::__construct($filterGroup);
	}

	//
	// Implement template methods from PersistableFilter
	//
	/**
	 * @copydoc PersistableFilter::getClassName()
	 */
	function getClassName() {
		return 'plugins.importexport.datacite.filter.DataciteXmlFilter';
	}

	//
	// Implement template methods from Filter
	//
	/**
	 * @see Filter::process()
	 * @param $pubObject Issue|Submission|ArticleGalley
	 * @return DOMDocument
	 */
	function &process(&$pubObject) {
		// Create the XML document
		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;
		$deployment = $this->getDeployment();
		$context = $deployment->getContext();
		$plugin = $deployment->getPlugin();
		$cache = $plugin->getCache();

		// Get all objects
		$issue = $article = $galley = $galleyFile = null;
		if (is_a($pubObject, 'Issue')) {
			$issue = $pubObject;
			if (!$cache->isCached('issues', $issue->getId())) {
				$cache->add($issue, null);
			}
		} elseif (is_a($pubObject, 'Submission')) {
			$article = $pubObject;
			if (!$cache->isCached('articles', $article->getId())) {
				$cache->add($article, null);
			}
		} elseif (is_a($pubObject, 'ArticleGalley')) {
			$galley = $pubObject;
			$galleyFile = $galley->getFile();
			$publication = Services::get('publication')->get($galley->getData('publicationId'));
			if ($cache->isCached('articles', $publication->getData('submissionId'))) {
				$article = $cache->get('articles', $publication->getData('submissionId'));
			} else {
				$article = Services::get('submission')->get($publication->getData('submissionId'));
				if ($article) $cache->add($article, null);
			}
			if ($cache->isCached('genres', $galleyFile->getData('genreId'))) {
				$genre = $cache->get('genres', $galleyFile->getData('genreId'));
			} else {
				$genre = DAORegistry::getDAO('GenreDAO')->getById($galleyFile->getData('genreId'));
				if ($genre) $cache->add($genre, null);
			}
		}
		if (!$issue) {
			$issueId = $article->getCurrentPublication()->getData('issueId');
			if ($cache->isCached('issues', $issueId)) {
				$issue = $cache->get('issues', $issueId);
			} else {
				$issueDao = DAORegistry::getDAO('IssueDAO'); /* @var $issueDao IssueDAO */
				$issue = $issueDao->getById($issueId, $context->getId());
				if ($issue) $cache->add($issue, null);
			}
		}

		// Get the most recently published version
		$publication = $article ? $article->getCurrentPublication() : null;

		// Identify the object locale.
		$objectLocalePrecedence = $this->getObjectLocalePrecedence($context, $article, $publication, $galley);
		// The publisher is required.
		// Use the journal title as DataCite recommends for now.
		$publisher = $this->getPrimaryTranslation($context->getData('name'), $objectLocalePrecedence);
		assert(!empty($publisher));
		// The publication date is required.
		if ($publication) {
			$publicationDate = $publication->getData('datePublished');
		}
		if (empty($publicationDate)) {
			$publicationDate = $issue->getDatePublished();
		}
		assert(!empty($publicationDate));

		// Create the root node
		$rootNode = $this->createRootNode($doc);
		$doc->appendChild($rootNode);
		// DOI (mandatory)
		$doi = $pubObject->getStoredPubId('doi');
		if ($plugin->isTestMode($context)) {
			$testDOIPrefix = $plugin->getSetting($context->getId(), 'testDOIPrefix');
			assert(!empty($testDOIPrefix));
			$doi = PKPString::regexp_replace('#^[^/]+/#', $testDOIPrefix . '/', $doi);
		}
		$rootNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'identifier', htmlspecialchars($doi, ENT_COMPAT, 'UTF-8')));
		$node->setAttribute('identifierType', DATACITE_IDTYPE_DOI);
		// Creators (mandatory)
		$rootNode->appendChild($this->createCreatorsNode($doc, $issue, $publication, $galley, $galleyFile, $publisher, $objectLocalePrecedence));
		// Title (mandatory)
		$rootNode->appendChild($this->createTitlesNode($doc, $issue, $publication, $galley, $galleyFile, $objectLocalePrecedence));
		// Publisher (mandatory)
		$rootNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'publisher', htmlspecialchars($publisher, ENT_COMPAT, 'UTF-8')));
		// Publication Year (mandatory)
		$rootNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'publicationYear', date('Y', strtotime($publicationDate))));
		// Subjects
		$subjects = [];
		if (!empty($galleyFile) && !empty($genre) && $genre->getSupplementary()) {
			$subjects = (array) $this->getPrimaryTranslation($galleyFile->getData('subject'), $objectLocalePrecedence);
		} elseif (!empty($article) && !empty($publication)) {
			$subjects = array_merge(
				$this->getPrimaryTranslation($publication->getData('keywords'), $objectLocalePrecedence),
				$this->getPrimaryTranslation($publication->getData('subjects'), $objectLocalePrecedence)
			);
		}
		if (!empty($subjects)) {
			$subjectsNode = $doc->createElementNS($deployment->getNamespace(), 'subjects');
			foreach ($subjects as $subject) {
				$subjectsNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'subject', htmlspecialchars($subject, ENT_COMPAT, 'UTF-8')));
			}
			$rootNode->appendChild($subjectsNode);
		}
		// Dates
		$rootNode->appendChild($this->createDatesNode($doc, $issue, $article, $publication, $galley, $galleyFile, $publicationDate));
		// Language
		$rootNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'language', AppLocale::getIso1FromLocale($objectLocalePrecedence[0])));
		// Resource Type
		$resourceTypeNode = $this->createResourceTypeNode($doc, $issue, $article, $galley, $galleyFile);
		if ($resourceTypeNode) $rootNode->appendChild($resourceTypeNode);
		// Alternate Identifiers
		$rootNode->appendChild($this->createAlternateIdentifiersNode($doc, $issue, $article, $galley));
		// Related Identifiers
		$relatedIdentifiersNode = $this->createRelatedIdentifiersNode($doc, $issue, $article, $publication, $galley);
		if ($relatedIdentifiersNode) $rootNode->appendChild($relatedIdentifiersNode);
		// Sizes
		$sizesNode = $this->createSizesNode($doc, $issue, $article, $publication, $galley, $galleyFile);
		if ($sizesNode) $rootNode->appendChild($sizesNode);
		// Formats
		if (!empty($galleyFile)) {
			$format = $galleyFile->getData('mimetype');
			if (!empty($format)) {
				$formatsNode = $doc->createElementNS($deployment->getNamespace(), 'formats');
				$formatsNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'format', htmlspecialchars($format, ENT_COMPAT, 'UTF-8')));
				$rootNode->appendChild($formatsNode);
			}
		}
		// Rights
		$rightsURL = $publication ? $publication->getData('licenseUrl') : $context->getData('licenseUrl');
		if(!empty($rightsURL)) {
			$rightsNode = $doc->createElementNS($deployment->getNamespace(), 'rightsList');
			$rightsNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'rights', htmlspecialchars(strip_tags(Application::get()->getCCLicenseBadge($rightsURL)), ENT_COMPAT, 'UTF-8')));
			$node->setAttribute('rightsURI', $rightsURL);
			$rootNode->appendChild($rightsNode);
		}
		// Descriptions
		$descriptionsNode = $this->createDescriptionsNode($doc, $issue, $article, $publication, $galley, $galleyFile, $objectLocalePrecedence);
		if ($descriptionsNode) $rootNode->appendChild($descriptionsNode);

		return $doc;
	}

	//
	// Conversion functions
	//
	/**
	 * Create and return the root node.
	 * @param $doc DOMDocument
	 * @return DOMElement
	 */
	function createRootNode($doc) {
		$deployment = $this->getDeployment();
		$rootNode = $doc->createElementNS($deployment->getNamespace(), $deployment->getRootElementName());
		$rootNode->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', $deployment->getXmlSchemaInstance());
		$rootNode->setAttribute('xsi:schemaLocation', $deployment->getNamespace() . ' ' . $deployment->getSchemaFilename());
		return $rootNode;
	}

	/**
	 * Create creators node.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $publication Publication
	 * @param $galley ArticleGalley
	 * @param $galleyFile SubmissionFile
	 * @param $publisher string
	 * @param $objectLocalePrecedence array
	 * @return DOMElement
	 */
	function createCreatorsNode($doc, $issue, $publication, $galley, $galleyFile, $publisher, $objectLocalePrecedence) {
		$deployment = $this->getDeployment();
		$creators = array();
		switch (true) {
			case (isset($galleyFile) && ($genre = $this->getDeployment()->getPlugin()->getCache()->get('genres', $galleyFile->getData('genreId'))) && $genre->getSupplementary()):
				// Check whether we have a supp file creator set...
				$creator = $this->getPrimaryTranslation($galleyFile->getData('creator'), $objectLocalePrecedence);
				if (!empty($creator)) {
					$creators[] = $creator;
					break;
				}
				// ...if not then go on by retrieving the publication
				// authors.
			case isset($publication):
				// Retrieve the publication authors.
				$authors = $publication->getData('authors');
				assert(!empty($authors));
				foreach ($authors as $author) { /* @var $author Author */
					$creators[] = $author->getFullName(false, true);
				}
				break;
			case isset($issue):
				$creators[] = $publisher;
				break;
		}
		assert(count($creators) >= 1);
		$creatorsNode = $doc->createElementNS($deployment->getNamespace(), 'creators');
		foreach ($creators as $creator) {
			$creatorNode = $doc->createElementNS($deployment->getNamespace(), 'creator');
			$creatorNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'creatorName', htmlspecialchars($creator, ENT_COMPAT, 'UTF-8')));
			$creatorsNode->appendChild($creatorNode);
		}
		return $creatorsNode;
	}

	/**
	 * Create titles node.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $publication Publication
	 * @param $galley ArticleGalley
	 * @param $galleyFile SubmissionFile
	 * @param $objectLocalePrecedence array
	 * @return DOMElement
	 */
	function createTitlesNode($doc, $issue, $publication, $galley, $galleyFile, $objectLocalePrecedence) {
		$deployment = $this->getDeployment();
		// Get an array of localized titles.
		$alternativeTitle = null;
		switch (true) {
			case (isset($galleyFile) && ($genre = $this->getDeployment()->getPlugin()->getCache()->get('genres', $galleyFile->getData('genreId'))) && $genre->getSupplementary()):
				$titles = $galleyFile->getData('name');
				break;
			case isset($publication):
				$titles = $publication->getData('title');
				break;
			case isset($issue):
				$titles = $this->getIssueInformation($issue);
				$alternativeTitle = $this->getPrimaryTranslation($issue->getTitle(null), $objectLocalePrecedence);
				break;
		}
		// Order titles by locale precedence.
		$titles = $this->getTranslationsByPrecedence($titles, $objectLocalePrecedence);
		// We expect at least one title.
		assert(count($titles)>=1);
		$titlesNode = $doc->createElementNS($deployment->getNamespace(), 'titles');
		// Start with the primary object locale.
		$primaryTitle = array_shift($titles);
		$titlesNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'title', htmlspecialchars(PKPString::html2text($primaryTitle), ENT_COMPAT, 'UTF-8')));
		// Then let the translated titles follow.
		foreach($titles as $locale => $title) {
			$titlesNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'title', htmlspecialchars(PKPString::html2text($title), ENT_COMPAT, 'UTF-8')));
			$node->setAttribute('titleType', DATACITE_TITLETYPE_TRANSLATED);
		}
		// And finally the alternative title.
		if (!empty($alternativeTitle)) {
			$titlesNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'title', htmlspecialchars(PKPString::html2text($alternativeTitle), ENT_COMPAT, 'UTF-8')));
			$node->setAttribute('titleType', DATACITE_TITLETYPE_ALTERNATIVE);
		}
		return $titlesNode;
	}

	/**
	 * Create a date node list.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $article Submission
	 * @param $publication Publication
	 * @param $galley ArticleGalley
	 * @param $galleyFile SubmissionFile
	 * @param $publicationDate string
	 * @return DOMElement
	 */
	function createDatesNode($doc, $issue, $article, $publication, $galley, $galleyFile, $publicationDate) {
		$deployment = $this->getDeployment();
		$dates = array();
		switch (true) {
			case isset($galleyFile):
				$genre = $this->getDeployment()->getPlugin()->getCache()->get('genres', $galleyFile->getData('genreId'));
				if ($genre->getSupplementary()) {
					// Created date (for supp files only): supp file date created.
					$createdDate = $galleyFile->getData('dateCreated');
					if (!empty($createdDate)) {
						$dates[DATACITE_DATE_CREATED] = $createdDate;
					}
				}
				// Accepted date (for galleys files): file uploaded.
				$acceptedDate = $galleyFile->getData('createdAt');
				if (!empty($acceptedDate)) {
					$dates[DATACITE_DATE_ACCEPTED] = $acceptedDate;
				}
				// Last modified date (for galley files): file modified date.
				$lastModified = $galleyFile->getData('updatedAt');
				if (!empty($lastModified)) {
					$dates[DATACITE_DATE_UPDATED] = $lastModified;
				}
				break;
			case isset($article):
				// Submitted date (for articles): article date submitted.
				$submittedDate = $article->getData('dateSubmitted');
				if (!empty($submittedDate)) {
					$dates[DATACITE_DATE_SUBMITTED] = $submittedDate;
				}
				// Accepted date: the last editor accept decision date
				$editDecisionDao = DAORegistry::getDAO('EditDecisionDAO'); /* @var $editDecisionDao EditDecisionDAO */
				$editDecisions = $editDecisionDao->getEditorDecisions($article->getId());
				foreach (array_reverse($editDecisions) as $editDecision) {
					if ($editDecision['decision'] == SUBMISSION_EDITOR_DECISION_ACCEPT) {
						$dates[DATACITE_DATE_ACCEPTED] = $editDecision['dateDecided'];
					}
				}
				// Last modified date (for articles): last modified date.
				$lastModified = $publication->getData('lastModified');
				if (!empty($lastModified)) {
					$dates[DATACITE_DATE_UPDATED] = $lastModified;
				}
				break;
			case isset($issue):
				// Last modified date (for issues): last modified date.
				$lastModified = $issue->getLastModified();
				if (!empty($lastModified)) {
					$dates[DATACITE_DATE_UPDATED] = $issue->getLastModified();
				}
				break;
		}
		$datesNode = $doc->createElementNS($deployment->getNamespace(), 'dates');
		// Issued date: publication date.
		$dates[DATACITE_DATE_ISSUED] = $publicationDate;
		// Available date: issue open access date.
		$availableDate = $issue->getOpenAccessDate();
		if (!empty($availableDate)) {
			$dates[DATACITE_DATE_AVAILABLE] = $availableDate;
		}
		// Create the date elements for all dates.
		foreach($dates as $dateType => $date) {
			// Format the date.
			$date = date('Y-m-d', strtotime($date));
			$datesNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'date', $date));
			$node->setAttribute('dateType', $dateType);
		}
		return $datesNode;
	}

	/**
	 * Create a resource type node.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $article Submission
	 * @param $galley ArticleGalley
	 * @param $galleyFile SubmissionFile
	 * @return DOMElement
	 */
	function createResourceTypeNode($doc, $issue, $article, $galley, $galleyFile) {
		$deployment = $this->getDeployment();
		$resourceTypeNode = null;
		switch (true) {
			case isset($galley):
				if (!$galley->getRemoteURL()) {
					$genre = $this->getDeployment()->getPlugin()->getCache()->get('genres', $galleyFile->getData('genreId'));
					if ($genre->getCategory() == GENRE_CATEGORY_DOCUMENT && !$genre->getSupplementary() && !$genre->getDependent()) {
						$resourceType = 'Article';
					}
				} else {
					$resourceType = 'Article';
				}
				break;
			case isset($article):
				$resourceType = 'Article';
				break;
			case isset($issue):
				$resourceType = 'Journal Issue';
				break;
			default:
				assert(false);
		}
		if (!empty($resourceType)) {
			// Create the resourceType element.
			$resourceTypeNode = $doc->createElementNS($deployment->getNamespace(), 'resourceType', $resourceType);
			$resourceTypeNode->setAttribute('resourceTypeGeneral', 'Text');
		} else {
			// It is a supplementary file
			$resourceTypeNode = $doc->createElementNS($deployment->getNamespace(), 'resourceType');
			$resourceTypeNode->setAttribute('resourceTypeGeneral', 'Dataset');
		}
		return $resourceTypeNode;
	}

	/**
	 * Generate alternate identifiers node list.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $article Submission
	 * @param $galley ArticleGalley
	 * @return DOMElement
	 */
	function createAlternateIdentifiersNode($doc, $issue, $article, $galley) {
		$deployment = $this->getDeployment();
		$context = $deployment->getContext();
		$alternateIdentifiersNode = $doc->createElementNS($deployment->getNamespace(), 'alternateIdentifiers');
		// Proprietary ID
		$proprietaryId = $context->getId();
		if ($issue) $proprietaryId .= '-' . $issue->getId();
		if ($article) $proprietaryId .= '-' . $article->getId();
		if ($galley) $proprietaryId .= '-g' . $galley->getId();
		$alternateIdentifiersNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'alternateIdentifier', $proprietaryId));
		$node->setAttribute('alternateIdentifierType', DATACITE_IDTYPE_PROPRIETARY);
		// ISSN - for issues only.
		if (!isset($article) && !isset($galley)) {
			$onlineIssn = $context->getData('onlineIssn');
			if (!empty($onlineIssn)) {
				$alternateIdentifiersNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'alternateIdentifier', $onlineIssn));
				$node->setAttribute('alternateIdentifierType', DATACITE_IDTYPE_EISSN);
			}
			$printIssn = $context->getData('printIssn');
			if (!empty($printIssn)) {
				$alternateIdentifiersNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'alternateIdentifier', $printIssn));
				$node->setAttribute('alternateIdentifierType', DATACITE_IDTYPE_ISSN);
			}
		}
		return $alternateIdentifiersNode;
	}

	/**
	 * Generate related identifiers node list.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $article Submission
	 * @param $publication Publication
	 * @param $galley ArticleGalley
	 * @return DOMElement|null
	 */
	function createRelatedIdentifiersNode($doc, $issue, $article, $publication, $galley) {
		$deployment = $this->getDeployment();
		$relatedIdentifiersNode = $doc->createElementNS($deployment->getNamespace(), 'relatedIdentifiers');
		switch (true) {
			case isset($galley):
				// Part of: article.
				assert(isset($article));
				$doi = $article->getStoredPubId('doi');
				if (!empty($doi)) {
					$relatedIdentifiersNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'relatedIdentifier', htmlspecialchars($doi, ENT_COMPAT, 'UTF-8')));
					$node->setAttribute('relatedIdentifierType', DATACITE_IDTYPE_DOI);
					$node->setAttribute('relationType', DATACITE_RELTYPE_ISPARTOF);
				}
				break;
			case isset($article):
				// Part of: issue.
				assert(isset($issue));
				$doi = $issue->getStoredPubId('doi');
				if (!empty($doi)) {
					$relatedIdentifiersNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'relatedIdentifier', htmlspecialchars($doi, ENT_COMPAT, 'UTF-8')));
					$node->setAttribute('relatedIdentifierType', DATACITE_IDTYPE_DOI);
					$node->setAttribute('relationType', DATACITE_RELTYPE_ISPARTOF);
				}
				unset($doi);
				// Parts: galleys.
				$galleysByArticle = $publication->getData('galleys');
				foreach ($galleysByArticle as $relatedGalley) {
					$doi = $relatedGalley->getStoredPubId('doi');
					if (!empty($doi)) {
						$relatedIdentifiersNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'relatedIdentifier', htmlspecialchars($doi, ENT_COMPAT, 'UTF-8')));
						$node->setAttribute('relatedIdentifierType', DATACITE_IDTYPE_DOI);
						$node->setAttribute('relationType', DATACITE_RELTYPE_HASPART);
					}
					unset($relatedGalley, $doi);
				}
				break;
			case isset($issue):
				// Parts: articles in this issue.
				$submissionsIterator = Services::get('submission')->getMany([
					'contextId' => $issue->getJournalId(),
					'issueIds' => $issue->getId(),
				]);
				foreach ($submissionsIterator as $relatedArticle) {
					$doi = $relatedArticle->getStoredPubId('doi');
					if (!empty($doi)) {
						$relatedIdentifiersNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'relatedIdentifier', htmlspecialchars($doi, ENT_COMPAT, 'UTF-8')));
						$node->setAttribute('relatedIdentifierType', DATACITE_IDTYPE_DOI);
						$node->setAttribute('relationType', DATACITE_RELTYPE_HASPART);
					}
					unset($relatedArticle, $doi);
				}
				break;
		}
		if ($relatedIdentifiersNode->hasChildNodes()) return $relatedIdentifiersNode;
		else return null;
	}

	/**
	 * Create a sizes node list.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $article Submission
	 * @param $publication Publication
	 * @param $galley ArticleGalley
	 * @param $galleyFile SubmissionFile
	 * @return DOMElement|null Can be null if a size
	 *  cannot be identified for the given object.
	 */
	function createSizesNode($doc, $issue, $article, $publication, $galley, $galleyFile) {
		$deployment = $this->getDeployment();
		$sizes = [];
		switch (true) {
			case isset($galley):
				// The galley represents the article.
				$pages = $publication->getData('pages');
				$path = $galleyFile->getData('path');
				$size = Services::get('file')->fs->getSize($path);
				$sizes[] = Services::get('file')->getNiceFileSize($size);
				break;
			case isset($article):
				$pages = $publication->getData('pages');
				break;
			case isset($issue):
				$issueGalleyDao = DAORegistry::getDAO('IssueGalleyDAO'); /* @var $issueGalleyDao IssueGalleyDAO */
				$issueGalleyFiles = $issueGalleyDao->getByIssueId($issue->getId());
				foreach($issueGalleyFiles as $issueGalleyFile) {
					if ($issueGalleyFile) {
						$sizes[] = $issueGalleyFile->getNiceFileSize();
					}
				}
				break;
			default:
				assert(false);
		}
		if (!empty($pages)) {
			AppLocale::requireComponents(array(LOCALE_COMPONENT_APP_EDITOR));
			$sizes[] = $pages . ' ' . __('editor.issues.pages');
		}
		$sizesNode = null;
		if (!empty($sizes)) {
			$sizesNode = $doc->createElementNS($deployment->getNamespace(), 'sizes');
			foreach($sizes as $size) {
				$sizesNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'size', htmlspecialchars($size, ENT_COMPAT, 'UTF-8')));
			}
		}
		return $sizesNode;
	}

	/**
	 * Create descriptions node list.
	 * @param $doc DOMDocument
	 * @param $issue Issue
	 * @param $article Submission
	 * @param $publication Publication
	 * @param $galley Alley
	 * @param $galleyFile SubmissionFile
	 * @param $objectLocalePrecedence array
	 * @return DOMElement|null Can be null if a size
	 *  cannot be identified for the given object.
	 */
	function createDescriptionsNode($doc, $issue, $article, $publication, $galley, $galleyFile, $objectLocalePrecedence) {
		$deployment = $this->getDeployment();
		$descriptions = array();
		switch (true) {
			case isset($galley):
				$genre = $this->getDeployment()->getPlugin()->getCache()->get('genres', $galleyFile->getData('genreId'));
				if ($genre->getSupplementary()) {
					$suppFileDesc = $this->getPrimaryTranslation($galleyFile->getData('description'), $objectLocalePrecedence);
					if (!empty($suppFileDesc)) $descriptions[DATACITE_DESCTYPE_OTHER] = $suppFileDesc;
				}
				break;
			case isset($article):
				$articleAbstract = $this->getPrimaryTranslation($publication->getData('abstract'), $objectLocalePrecedence);
				if (!empty($articleAbstract)) $descriptions[DATACITE_DESCTYPE_ABSTRACT] = $articleAbstract;
				break;
			case isset($issue):
				$issueDesc = $this->getPrimaryTranslation($issue->getDescription(null), $objectLocalePrecedence);
				if (!empty($issueDesc)) $descriptions[DATACITE_DESCTYPE_OTHER] = $issueDesc;
				$descriptions[DATACITE_DESCTYPE_TOC] = $this->getIssueToc($issue, $objectLocalePrecedence);
				break;
			default:
				assert(false);
		}
		if (isset($article)) {
			// Articles and galleys.
			$descriptions[DATACITE_DESCTYPE_SERIESINFO] = $this->getIssueInformation($issue, $objectLocalePrecedence);
		}
		$descriptionsNode = null;
		if (!empty($descriptions)) {
			$descriptionsNode = $doc->createElementNS($deployment->getNamespace(), 'descriptions');
			foreach($descriptions as $descType => $description) {
				$descriptionsNode->appendChild($node = $doc->createElementNS($deployment->getNamespace(), 'description', htmlspecialchars(PKPString::html2text($description), ENT_COMPAT, 'UTF-8')));
				$node->setAttribute('descriptionType', $descType);
			}
		}
		return $descriptionsNode;
	}


	//
	// Helper functions
	//
	/**
	 * Identify the locale precedence for this export.
	 * @param $context Context
	 * @param $article Submission
	 * @param $publication Publication
	 * @param $galley ArticleGalley
	 * @return array A list of valid PKP locales in descending
	 *  order of priority.
	 */
	function getObjectLocalePrecedence($context, $article, $publication, $galley) {
		$locales = array();
		if (is_a($galley, 'ArticleGalley') && AppLocale::isLocaleValid($galley->getLocale())) {
			$locales[] = $galley->getLocale();
		}
		if (is_a($article, 'Submission')) {
			if (!is_null($publication->getData('locale'))) {
				$locales[] = $publication->getData('locale');
			}
		}
		// Use the journal locale as fallback.
		$locales[] = $context->getPrimaryLocale();
		// Use form locales as fallback.
		$formLocales = array_keys($context->getSupportedFormLocaleNames());
		// Sort form locales alphabetically so that
		// we get a well-defined order.
		sort($formLocales);
		foreach($formLocales as $formLocale) {
			if (!in_array($formLocale, $locales)) $locales[] = $formLocale;
		}
		assert(!empty($locales));
		return $locales;
	}

	/**
	 * Try to translate an ISO language code to an OJS locale.
	 * @param $language string 2- or 3-letter ISO language code
	 * @return string|null An OJS locale or null if no matching
	 *  locale could be found.
	 */
	function translateLanguageToLocale($language) {
		$locale = null;
		if (strlen($language) == 2) {
			$language = AppLocale::get3LetterFrom2LetterIsoLanguage($language);
		}
		if (strlen($language) == 3) {
			$language = AppLocale::getLocaleFrom3LetterIso($language);
		}
		if (AppLocale::isLocaleValid($language)) {
			$locale = $language;
		}
		return $locale;
	}

	/**
	 * Identify the primary translation from an array of
	 * localized data.
	 * @param $localizedData array An array of localized
	 *  data (key: locale, value: localized data).
	 * @param $localePrecedence array An array of locales
	 *  by descending priority.
	 * @return mixed|null The value of the primary locale
	 *  or null if no primary translation could be found.
	 */
	function getPrimaryTranslation($localizedData, $localePrecedence) {
		// Check whether we have localized data at all.
		if (!is_array($localizedData) || empty($localizedData)) return null;
		// Try all locales from the precedence list first.
		foreach($localePrecedence as $locale) {
			if (isset($localizedData[$locale]) && !empty($localizedData[$locale])) {
				return $localizedData[$locale];
			}
		}
		// As a fallback: use any translation by alphabetical
		// order of locales.
		ksort($localizedData);
		foreach($localizedData as $locale => $value) {
			if (!empty($value)) return $value;
		}
		// If we found nothing (how that?) return null.
		return null;
	}

	/**
	 * Re-order localized data by locale precedence.
	 * @param $localizedData array An array of localized
	 *  data (key: locale, value: localized data).
	 * @param $localePrecedence array An array of locales
	 *  by descending priority.
	 * @return array Re-ordered localized data.
	 */
	function getTranslationsByPrecedence($localizedData, $localePrecedence) {
		$reorderedLocalizedData = array();

		// Check whether we have localized data at all.
		if (!is_array($localizedData) || empty($localizedData)) return $reorderedLocalizedData;

		// Order by explicit locale precedence first.
		foreach($localePrecedence as $locale) {
			if (isset($localizedData[$locale]) && !empty($localizedData[$locale])) {
				$reorderedLocalizedData[$locale] = $localizedData[$locale];
			}
			unset($localizedData[$locale]);
		}

		// Order any remaining values alphabetically by locale
		// and amend the re-ordered array.
		ksort($localizedData);
		$reorderedLocalizedData = array_merge($reorderedLocalizedData, $localizedData);

		return $reorderedLocalizedData;
	}

	/**
	 * Construct an issue title from the journal title
	 * and the issue identification.
	 * @param $issue Issue
	 * @param $objectLocalePrecedence array
	 * @return array|string An array of localized issue titles
	 *  or a string if a locale has been given.
	 */
	function getIssueInformation($issue, $objectLocalePrecedence = null) {
		$deployment = $this->getDeployment();
		$context = $deployment->getContext();
		$issueIdentification = $issue->getIssueIdentification();
		assert(!empty($issueIdentification));
		if (is_null($objectLocalePrecedence)) {
			$issueInfo = array();
			foreach ($context->getName(null) as $locale => $contextName) {
				$issueInfo[$locale] = "$contextName, $issueIdentification";
			}
		} else {
			$issueInfo = $this->getPrimaryTranslation($context->getName(null), $objectLocalePrecedence);
			if (!empty($issueInfo)) {
				$issueInfo .= ', ';
			}
			$issueInfo .= $issueIdentification;
		}
		return $issueInfo;
	}

	/**
	 * Construct a table of content for an issue.
	 * @param $issue Issue
	 * @param $objectLocalePrecedence array
	 * @return string
	 */
	function getIssueToc($issue, $objectLocalePrecedence) {
		$submissionsIterator = Services::get('submission')->getMany([
			'contextId' => $issue->getJournalId(),
			'issueIds' => $issue->getId(),
		]);
		$toc = '';
		foreach ($submissionsIterator as $submissionInIssue) {
			$currentEntry = $this->getPrimaryTranslation($submissionInIssue->getTitle(null), $objectLocalePrecedence);
			assert(!empty($currentEntry));
			$pages = $submissionInIssue->getPages();
			if (!empty($pages)) {
				$currentEntry .= '...' . $pages;
			}
			$toc .= $currentEntry . "<br />";
			unset($submissionInIssue);
		}
		return $toc;
	}
}


